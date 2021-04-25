<?php
require_once 'Database.php';

class Model
{
    private Database $db;

    function __construct()
    {
        $this->db = new Database();
    }

    /**
     * Returns array with book data. Book determines with its ID.
     * @param $id - book ID
     * @return array - book data
     */
    public function getBook($id): array
    {
        $query = "SELECT * FROM id_pairs JOIN books ON id_pairs.book_id = books.id JOIN authors ON id_pairs.authors_id = authors.id  WHERE book_id=?";
        $params = [$id];
        return $this->db->execute($query, $params);
    }


    /**
     * Puts the new book data into database.
     * @param $title - book title
     * @param $authors - book authors
     * @param $year - the year the book was published
     * @param $description - book description
     * @param $filename - book cover filename
     */
    public function addBook($title, $authors, $year, $description, $filename)
    {
        //check authors in authors table and add authors if doesn't exists
        $query = "SELECT COUNT(*) FROM authors WHERE authors = ?";
        $params = [implode(', ', $authors)];
        $result = $this->db->execute($query, $params);
        if ($result[0][0] == 0) {
            $query = "INSERT INTO authors (`authors`) VALUES (?)";
            $this->db->execute($query, $params);
            $result = $this->db->execute("SELECT @@IDENTITY");
        } else {
            $query = "SELECT id FROM authors WHERE authors = ?";
            $result = $this->db->execute($query, $params);
        }
        $authors_id = $result[0][0];

        //add book to books table
        $query = "INSERT INTO books (`title`, `year`, `description`,`cover`) VALUES (?, ?, ?, ?)";
        $params = [$title, $year, $description, $filename];
        $this->db->execute($query, $params);
        $result = $this->db->execute("SELECT @@IDENTITY");
        $book_id = $result[0][0];

        //add pair book_id-authors_id into pairs table
        $query = "INSERT INTO id_pairs (`book_id`, `authors_id`) VALUES (?, ?)";
        $params = [$book_id, $authors_id];
        $this->db->execute($query, $params);
    }

    /**
     * Removes book via its ID
     * @param $id - book id
     */
    public function deleteBook($id)
    {
        $query = "UPDATE books SET deleted=? WHERE id=?";
        $params = [time(), $id];
        $this->db->execute($query, $params);
    }

    /**
     * Increases book's view field number by 1
     * @param $id - book ID
     */
    public function increaseViewsCounter($id)
    {
        $query = "UPDATE books SET views=views+1 WHERE id=?";
        $params = [$id];
        $this->db->execute($query, $params);
    }

    /**
     * Gets the books selection using class $limit and function $page parameters
     * @param int $page - page number
     * @param int $limit - books per page
     * @return array - books selection from [($page - 1) * $limit] to [($page - 1) * $limit + $limit]
     */
    public function getBooksSelection(int $page, int $limit): array
    {
        $start = ($page - 1) * $limit;
        $query = "SELECT * FROM id_pairs JOIN books ON id_pairs.book_id = books.id JOIN authors ON id_pairs.authors_id = authors.id WHERE deleted IS NULL LIMIT " . $start . ", " . $limit;
        return $this->db->execute($query);
    }

    /**
     * Returns total books count number
     * @return int - count number
     */
    public function getRecordsCount(): int
    {
        $query = "SELECT COUNT(*) FROM books WHERE deleted IS NULL";
        return (int)$this->db->execute($query)[0][0];
    }

    /**
     * Returns search results from database
     * @param string $searchQuery - users search string
     * @return array - search results
     */
    public function findBook(string $searchQuery): array
    {
        $query = "SELECT * FROM id_pairs JOIN books ON id_pairs.book_id = books.id JOIN authors ON id_pairs.authors_id = authors.id WHERE books.title LIKE ?";
        $params = ['%' . $searchQuery . '%'];
        return $this->db->execute($query, $params);
    }
}