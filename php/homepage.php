<?php
   // require_once("article.php");    
    // connect to database
    $mysqli = new mysqli("localhost", "store_mcall", "aliceblue", "store_mcall");        // handle degenerate cases
        if(gettype($mysqli) !== "object" || get_class($mysqli) !== "mysqli") {
            throw(new mysqli_sql_exception("input is not a mysqli object"));
        }
        
        
        // create the query template
        $query     = "SELECT title, url, datepub FROM articles ORDER BY datepub desc LIMIT 3";
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
        while ($row = $result->fetch_assoc()) {
            
        
        
        // convert the associative array to a Article
        if($row !== null) {
            try {
              //  $article = new Article($row["title"], $row["url"], $row["datepub"]);
            }
            catch(Exception $exception) {
                // if the row couldn't be converted, rethrow it
                throw(new mysqli_sql_exception("Unable to convert row to article, 0, $exception"));
            }
            
            // if we got here, the article is good - return it
            // return($article);
        } else {
            // 404 Article not found - return null instead
            return(null);
        }
    // query articles
   // $query = file_get_contents("article.sql");
    
    // build html to show articles
      $linkurl= $row['url'];
      $articleTitle = $row['title'];
     $link = "<a href=$linkurl\>$articleTitle</a></br >";
     //https://www.eff.org/issues/net-neutrality
     //http://www.infoworld.com/article/2608809/net-neutrality/net-neutrality-comcast-marxism-and-net-neutrality-twisted-words-shameless-hypocrisy.html
     
     echo $link;
        }
?>