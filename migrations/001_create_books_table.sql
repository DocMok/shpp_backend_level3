USE library;
CREATE TABLE IF NOT EXISTS books
(
    `id`          INT(11) NOT NULL AUTO_INCREMENT,
    `title`       VARCHAR(255) NOT NULL,
    `authors`     TEXT         NOT NULL,
    `year`        INT(4) NOT NULL,
    `description` TEXT         NOT NULL,
    `views`       INT(11) NOT NULL,
    `cover`       VARCHAR(255) NOT NULL,
    `deleted`     TEXT  NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;