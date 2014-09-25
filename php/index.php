<?php
    // connect to database
    public static function getLatestArticles(&$mysqli) {
        // handle degenerate cases
        if(gettype($mysqli) !== "object" || get_class($mysqli) !== "mysqli") {
            throw(new mysqli_sql_exception("input is not a mysqli object"));
        }
        
        
        // create the query template
        $query     = "SELECT title, url, FROM article ORDER BY datePublished desc LIMIT = 3";
        $statement = $mysqli->prepare($query);
        if($statement === false) {
            throw(new mysqli_sql_exception("unable to prepare statement"));
        }
        
        // execute the statement
        if($statement->execute() === false) {
            throw(new mysqli_sql_exception("unable to execute mySQL statement"));
        }
        
        // get results from the SELECT query *pounds fist and shouts "GIVE ME RESULTS, NOW PEON!!"*
        $result = $statement->get_result();
        if($result === false) {
            throw(new mysqli_sql_exception("unable to get result set"));
        }
        
        // since this is a unique field, this will only return 0 or 1 results. so...
        // 1) if there's a result, we can make it into a article object normally
        // 2) if there's no result, we can just return null
        $row = $result->fetch_assoc(); // fetch_assoc() returns a row as an associative array
        
        // convert the associative array to a Article
        if($row !== null) {
            try {
                $article = new Article($row["title"], $row["url"]);
            }
            catch(Exception $exception) {
                // if the row couldn't be converted, rethrow it
                throw(new mysqli_sql_exception("Unable to convert row to article, 0, $exception"));
            }
            
            // if we got here, the article is good - return it
            return($article);
        } else {
            // 404 Article not found - return null instead
            return(null);
        }
    // query articles
    $query = file_get_contents("article.sql");
    
    // build html to show articles
    "<a href = '$article'>articles url</a>"
    
?>