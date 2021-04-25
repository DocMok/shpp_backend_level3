CREATE TABLE IF NOT EXISTS `authors`
(
    `id`          INT(11) NOT NULL AUTO_INCREMENT,
    `authors`     TEXT         NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

INSERT INTO `authors` (`authors`) SELECT `authors` FROM `books`;