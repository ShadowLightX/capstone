CREATE TABLE user (
    -- AUTO_INCREMENT automatically assigns userId {1, 2, 3, ...}
    userId INT UNSIGNED AUTO_INCREMENT NOT NULL,
    role TINYINT UNSIGNED NOT NULL,
    name VARCHAR(64) NOT NULL,
    email VARCHAR(64) NOT NULL,
    articleId INT UNSIGNED AUTO_INCREMENT NOT NULL,
    PRIMARY KEY(userId),
    -- UNIQUE() is an index that requires the field have at most one entry per table
    UNIQUE(email)
);