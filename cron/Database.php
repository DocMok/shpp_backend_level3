<?php
require_once 'Config.php';

class Database implements Config
{
    private PDO $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new PDO("mysql:host=".self::DB_HOST.";dbname=".self::DB_NAME.";", self::DB_USER, self::DB_PASS);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    /**
     * Prepares and executes the sql query using additional parameters
     */
    public function execute($query, $params = []): array
    {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_BOTH);
    }
}