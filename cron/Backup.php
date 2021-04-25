<?php
require_once 'Config.php';

Backup::run();
/**
 * Backups the database using mysqldump application.
 */
class Backup implements Config
{
    private static string $backupPath = 'D:/db_backup/';

    public static function run()
    {
        exec("mysqldump --user=" . self::DB_USER . " --password=" . self::DB_PASS . " --host=" . self::DB_HOST . " " . self::DB_NAME . " > " . self::$backupPath . date('Y-m-d') . '.sql');
    }
}
?>
