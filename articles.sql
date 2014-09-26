-- always start with these statements
-- drop the tables in REVERSE order in which they appear below
-- NEVER, EVER, BLOODY *EVER* use this on live data!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
DROP TABLE IF EXISTS articles;

CREATE TABLE articles (
    -- AUTO_INCREMENT automatically assigns userId {1, 2, 3, ...}
    articleId INT UNSIGNED AUTO_INCREMENT NOT NULL,
    title VARCHAR(64) NOT NULL,
    url CHAR(128) NOT NULL,
    author CHAR(64) NOT NULL,
    datepub TIMESTAMP DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY(articleId),
    imageurl CHAR(128),
    articleAvail INT
);

 INSERT INTO articles(title, url, author, imageurl , articleAvail) VALUES( "stemulus news", "http://www.kob.com/article/stories/S3568196.shtml#.VCDSFCtdWps", "kob", "http://www.kob.com/article/stories/S3568196.shtml#.VCDSFCtdWps", 1)
SELECT title, url, datepub FROM articles ORDER BY datepub desc LIMIT 3;
