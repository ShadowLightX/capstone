-- creating database for net neutrality
-- beginning with the login class

DROP TABLE IF EXISTS resource;
DROP TABLE IF EXISTS article;
DROP TABLE IF EXISTS login;
DROP TABLE IF EXISTS user;


CREATE TABLE user (
    userId INT UNSIGNED AUTO_INCREMENT NOT NULL,
    email VARCHAR(64) NOT NULL,
    firstName VARCHAR(70),
    lastName VARCHAR(70),
    role VARCHAR(20), 
    PRIMARY KEY(userId),
    UNIQUE(email)
);
CREATE TABLE login (
    loginId INT UNSIGNED AUTO_INCREMENT NOT NULL,
    userId INT UNSIGNED NOT NULL, 
    authToken CHAR(32),
    password CHAR(128) NOT NULL,
    salt CHAR(64) NOT NULL,
    userName VARCHAR(32), 
    PRIMARY KEY(loginId),
    UNIQUE(userName),
    FOREIGN KEY(userId) REFERENCES user(userId)
);
CREATE TABLE article (
    articleId INT UNSIGNED AUTO_INCREMENT NOT NULL,
    userId INT UNSIGNED NOT NULL,
    author VARCHAR(80),
    datePublished DATETIME,
    imageAvailable TINYINT UNSIGNED,
    title VARCHAR(64) NOT NULL,
    articleText TEXT,
    publisher VARCHAR(70),
    url VARCHAR(2000),
    PRIMARY KEY(articleId),
    FOREIGN KEY(userId) REFERENCES user(userId),
    INDEX (datePublished)
);
CREATE TABLE resource(
    resourceId INT UNSIGNED AUTO_INCREMENT NOT NULL,
    userId INT UNSIGNED NOT NULL,
    resourceName VARCHAR(64),
    resourceLink VARCHAR(2000),
    PRIMARY KEY(resourceId),
    FOREIGN KEY(userId) REFERENCES user(userId)
);
    
