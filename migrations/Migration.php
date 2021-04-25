<?php
require_once 'MigrationConfig.php';


class Migration implements MigrationConfig {

    private PDO $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host=".self::DB_HOST.";dbname=".self::DB_NAME.";", self::DB_USER, self::DB_PASS);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    /**
     * Main function that applies the migrations from current directory. Migrations file name pattern: xxx_name.sql where
     * xxx is three-digit natural sequential integer from 000 to 999.
     * First migration is default migration with name begins with 000. This migration creates migration table to account
     * for applied migrations.
     */
    public function applyMigrations() {
        $migrations = $this->getNotAppliedMigrations();
        if (sizeof($migrations) > 0) {
            foreach ($migrations as $migration) {
                $queries = $this->getQueriesArray(file_get_contents($migration));
                $this->applyMigration($queries, $migration);
            }
        }
    }

    /**
     * @return array - the list of not applied migrations
     */
    private function getNotAppliedMigrations(): array {
        //create
        $files = $this->getMigrationsArray();
        if (!preg_match('/000\w{0,}/', $files[0])) {
            return [];
        } else {
            $queries = array_slice(explode(';', file_get_contents($files[0])), 0, -1);

            foreach ($queries as $query) {
                $this->execute($query);
            }
            $appliedMigrations = $this->getAppliedMigrationsArray();
            return array_slice(array_diff($files, $appliedMigrations), 1);
        }
    }

    /**
     * @return array - the list of all migration files in current directory.
     */
    private function getMigrationsArray(): array
    {
        $allFiles = scandir(__DIR__);
        $migrationFiles = [];

        foreach ($allFiles as $filename) {
            if (preg_match('/[0-9]{3}_\w{0,}.sql$/', $filename)) {
                $migrationFiles[] = $filename;
            }
        }
        return $migrationFiles;
    }

    /**
     * @return array - the list with the applied array from migrations table
     */
    private function getAppliedMigrationsArray(): array
    {
        $query = 'SELECT `name` FROM `migrations`';
        $queryResult = $this->execute($query);
        $result = [];
        foreach($queryResult as $item) {
            $result[] = $item['name'];
        }
        return $result;
    }

    /**
     * Executes all migration queries and checks this migration as applied in database
     * @param array $queries - queries from migration file
     * @param $migrationName - migration's file name
     */
    private function applyMigration(array $queries, $migrationName) {
        foreach ($queries as $query) {
            $this->execute($query);
        }

        $query = "INSERT INTO `migrations` (`name`) VALUES (?)";
        $params = [$migrationName];
        $this->execute($query, $params);
    }

    /**
     * Creates queries array from the file content string.
     * @param $content - file content with queries
     * @return array - the list of queries
     */
    private function getQueriesArray($content): array
    {
        return array_slice(explode(';', $content), 0, -1);
    }

    /**
     * Prepares and executes the sql query using additional parameters
     */
    private function execute($query, $params = []): array
    {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_BOTH);
    }
}