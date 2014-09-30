-- creating database for net neutrality
-- beginning with the login class
CREATE TABLE login (
    loginId INT UNSIGNED AUTO_INCREMENT NOT NULL,
    userId INT UNSIGNED NOT NULL, 
    authtToken CHAR(32),
    password CHAR(128) NOT NULL,
    salt CHAR(64) NOT NULL,
    userName VARCHAR(32), 
    PRIMARY KEY(loginId),
    UNIQUE(userName),
    FOREIGN KEY(user_id) REFERENCES user(user_id)
);
CREATE TABLE user (
    userId INT UNSIGNED AUTO_INCREMENT NOT NULL,
    email VARCHAR(64) NOT NULL,
    firstName VARCHAR(70),
    lastName VARCHAR(70)
    role VARCHAR(20), 
    PRIMARY KEY(userId),
    UNIQUE(email)
);     
CREATE TABLE articles (
    articleId UNSIGNED AUTO_INCREMENT NOT NULL,
    userId UNSIGNED INT NOT NULL,
    author VARCHAR(80),
    datePublished DATETIME,
    imageAvalable UNSIGNED TINY INT,
    title VARCHAR(64) NOT NULL,
    articleText TEXT,
    publisher VARCHAR(70),
    url VARCHAR(2000),
    PRIMARY KEY(articlesId),
    FOREIGN KEY(userId) REFERENCES user(user_id),
    INDEX (datePublished)
);
CREATE TABLE resource(
    resourcesId INT UNSIGNED AUTO_INCREMENT NOT NULL,
    userId INT NOT NULL,
    resourceName VARCHAR(64),
    resourceLink VARCHAR(2000),
    PRIMARY KEY(resourcesId)
    
);
    
