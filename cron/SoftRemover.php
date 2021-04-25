<?php
require_once 'Database.php';

SoftRemover::run();

/**
 * Removes records from database that was checked as deleted more than one week ago.
 */
class SoftRemover
{

    private static Database $db;
    private static string $uploadsPath = 'D:\vhosts\level3.local\uploads\\';
    private static int $removingPeriod = 168; // one week (in hours)

    public static function run()
    {
        self::$db = new Database();
        $deletedBooks = self::getRemovedBooks();
        foreach ($deletedBooks as $book) {
            $deletionTime = self::getDeletionTime($book['id']);
            if (time() - $deletionTime >= self::$removingPeriod * 3600) {
                self::removeCoverFile($book['cover']);
                self::removeAuthorIfUnused($book['id']);
                self::removePair($book['id']);
                self::removeBook($book['id']);
            }
        }
    }

    /**
     * Returns array with books that was checked as removed.
     * @return array - removed books.
     */
    public static function getRemovedBooks(): array
    {
        $query = "SELECT * FROM books WHERE deleted IS NOT NULL";
        return self::$db->execute($query);
    }

    /**
     * Removes the cover file from $uploadsPath if it exists
     * @param string $coverFileName - filename to remove
     */
    private static function removeCoverFile(string $coverFileName)
    {
        if (file_exists(self::$uploadsPath . $coverFileName)) {
            unlink(self::$uploadsPath . $coverFileName);
        }
    }

    /**
     * Checks author's id using by other books and removes it otherwise
     * @param int $bookID - book ID
     */
    private static function removeAuthorIfUnused(int $bookID)
    {
        //get authors id
        $query = "SELECT authors_id FROM id_pairs WHERE book_id=?";
        $params = [$bookID];
        $authors_id = self::$db->execute($query, $params)[0]['authors_id'];

        //check authors id using
        $query = "SELECT COUNT(*) AS counter FROM id_pairs WHERE authors_id=?";
        $params = [$authors_id];
        $result = self::$db->execute($query, $params)[0];

        if ($result['counter'] == 1) {
            //remove author
            $query = "DELETE FROM authors WHERE id=?";
            $params = [$authors_id];
            self::$db->execute($query, $params);
        }
    }

    /**
     * Removes id pair from pairs table
     * @param $bookID - book id
     */
    private static function removePair($bookID)
    {
        $query = "DELETE FROM id_pairs WHERE book_id = ?";
        $params = [$bookID];
        self::$db->execute($query, $params);
    }

    /**
     * Removes book from books table
     * @param $bookID - book id
     */
    private static function removeBook($bookID)
    {
        $query = "DELETE FROM books WHERE id = ?";
        $params = [$bookID];
        self::$db->execute($query, $params);
    }

    /**
     * Returns books deletion timestamp
     * @param $bookID - book id
     * @return int - deletion timestamp
     */
    private static function getDeletionTime($bookID): int
    {
        $query = "SELECT deleted FROM books WHERE id = ?";
        $params = [$bookID];
        $result = self::$db->execute($query, $params);
        return (int)$result[0]['deleted'];
    }
}

