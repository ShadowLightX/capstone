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

 INSERT INTO articles(title, url, author, imageurl , articleAvail) VALUES( "InfoWorld.com/net-neutrality", "http://www.infoworld.com/t/net-neutrality/comcast-marxism-and-net-neutrality-twisted-words-shameless-hypocrisy-249411", 1)
  INSERT INTO articles(title, url, author, imageurl , articleAvail) VALUES( "savetheinternet.com/net-neutrality", "http://www.savetheinternet.com/net-neutrality", 1)
   INSERT INTO articles(title, url, author, imageurl , articleAvail) VALUES( "eff.org/issues/net-neutrality", "https://www.eff.org/issues/net-neutrality", 1)
 
SELECT title, url, datepub FROM articles ORDER BY datepub desc LIMIT 3;
