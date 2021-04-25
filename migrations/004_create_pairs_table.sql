CREATE TABLE IF NOT EXISTS `id_pairs`
(
    `book_id`     INT NOT NULL,
    `authors_id`  INT NOT NULL
) ENGINE = InnoDB;

INSERT INTO `id_pairs` (`book_id`, `authors_id`)
SELECT books.id, authors.id
FROM `books` LEFT JOIN `authors` ON books.authors=authors.authors;

ALTER TABLE `books` DROP `authors`;