<?php
/**
 *The Article class deals with articles and allows the adding, retrival, and update of articles
 *
 *@author Nicholas Bowling <nbowling505@gmail.com>
 *@version 0.3.8
 **/

class Article{
    /**
     *automatically generated id for an article and is null if not given
     **/
    private $articleId;
    
    /**
     *the userId foreign key of the person that created the article
     **/
    private $userId;
    
    /**
     *the string title of the article
     **/
    private $title;
    
    /**
     *the string author of the article
     **/
    private $author;
    
    /**
     *the datetime the article was published
     **/
    private $datePublished;
    
    /**
     *article has an image
     **/
    private $imageAvaliable;
    
    /**
     *the large string text inside the article
     **/
    private $articleText;
    
    /**
     *the string publisher of the article
     **/
    private $publisher;
    
    /**
     *the string url the article was found at
     **/
    private $url;
    
    /**
     *constructor for a article
     *
     *@param mixed $newArticleId the id in the database
     *@param int $newUserId the id of the user that created this
     *@param string $title the article title
     *@param string $author author of the article 
     *@param string $newDatePublished The date the article was published
     *@param integer $newImageAvailable The determination if there is an image true 0 or false 1
     *@param string $newArticleText The text in the article
     *@param string $newPublisher The publisher of an article
     *@param string $newUrl The URL the article came from
     *@throws UnexceptedValueException if inputs are of the incorrect types or urls
     *@throws RangesException if the inputs contain invalid values
     **/
    
    public function __construct($newArticleId,$newUserId, $newTitle,$newAuthor,$newDatePublished,$newImageAvailable, $newArticleText,$newPublisher,$newUrl){
        try{
            $this->setArticleId($newArticleId);
            $this->setUserId($newUserId);
            $this->setTitle($newTitle);
            $this->setAuthor($newAuthor);
            $this->setDatePublished($newDatePublished);
            $this->setImageAvailable($newImageAvailable);
            $this->setArticleText($newArticleText);
            $this->setPublisher($newPublisher);
            $this->setUrl($newUrl);
        }
        catch(UnexpectedValueException $error){
            //rethrow the exception passed when the object was created the object
            throw(new UnexpectedValueException("unable to create article $error", 0, $error));
        }
        catch(RangeException $error){
            //rethrow the exception passed from the object was created
            throw(new RangeException("unable to create article $error", 0, $error));
        }
    }
    
    /**
     *get the ArticleId for an article
     *
     *@return integer ArticleId
     **/
    public function getArticleId(){
        return $this->articleId;    
    }
    
    /**
     *set value of Article Id
     *@param mixed $newArticleId the ID that the article has
     *@throws RangeException for anything that is not null, string, or int
     **/
    public function setArticleId($newArticleId){
        if ($newArticleId === null) {
            $this->articleId = null;
            return;
        }
 /*        // first, trim the input
    $newArticleId = trim($newArticleId);
    
    // second, check if article id is an integer
    if((filter_var($newArticleId, FILTER_VALIDATE_INT)) === false) {
        throw(UnexpectedValueException("resource id $newArticleId is not a number"));
    }
    
    // third, convert article id to an integer and ensure it's positive
    $newArticleId = intval($newArticleId);
    if($newArticleId<= 0) {
        throw(new RangeException("resource id $newArticleId must be a positive number"));
    }
    
    // finally, the article id is clean and can be taken out of quarantine
    $this->articleId = $newArticleId;
}*/
        
        //tests for string
        if (gettype($newArticleId) === "string"){
            $newArticleId = trim($newArticleId);
        
            $newArticleId = filter_var($newArticleId, FILTER_SANITIZE_NUMBER_INT);
            
            if(strlen($newArticleId)<1){
                throw(new RangeException("$newArticleId has no length please try again"));
            }
        
            //converts to integer    
            $newArticleId = intval($newArticleId); 
        }
        
        
        if (gettype($newArticleId) !== "integer" || $newArticleId < 0)
        {
            throw(new RangeException("$newArticleId is not a number in the correct range"));
        }
        
        $this->articleId = $newArticleId;
    }

    
    /**
     *get userId of person that created the article or added it to the database
     **/
    public function getUserId(){
        return $this->userId;
    }
    
    /**
     *set the userId of the person that created the article or added it to the database
     *@param int $newUserId the id of the user to use
     *@throws UnexceptedValueException if number is not an integer
     *@throws RangeException if the number is not in the correct range of exceptation
     **/
    public function setUserId($newUserId){
        if (gettype($newUserId) !== "integer") {
            throw (new UnexpectedValueException("$newUserId is not a number"));
        }
        
            
        if ($newUserId < 0|| $newUserId > 20000000){
            throw(new RangeException("$newUserId is not a number in the correct range"));
        }
        
        $this->userId = $newUserId;
    }
    
    /**
     *get the value of the article title
     *
     *@return string the name(title) of the article
     **/       
    public function getTitle(){
        return $this->title;
    }    
    
    /**
     *set the value of the article title
     *
     *@param string $newTitle the name(title) of the article
     *@throws UnexceptedValueException if input is not a string
     *@throws RangeException if the title is a empty string and longer than 70 characters
     **/
    public function setTitle($newTitle){
        if (gettype($newTitle)!== "string"){
            throw(new UnexpectedValueException("Please use a phrase to describe an article"));
        }
        
        if (strlen($newTitle)<1 || strlen($newTitle)> 70){
            throw(new RangeException("The article title is not set or too long please try again."));
        }
        
        $newTitle = filter_var($newTitle,FILTER_SANITIZE_STRING);
        
        $this->title = $newTitle;
    }
    

    /**
     *get the name of the article author
     *
     *@return string the name of the full name of the article
     **/       
    public function getAuthor(){
        return $this->author;
    }
    
    /**
     *set the name of the author
     *
     *@param string $newAuthor the name of the author
     *@throws UnexceptedValueException if input is not a string
     *@throws RangeException if the author is an empty string and longer than 100 characters
     **/
    public function setAuthor($newAuthor){
        if (gettype($newAuthor)!== "string"){
            throw(new UnexpectedValueException("Please use the name of the author"));
        }
        
        if (strlen($newAuthor)<1 || strlen($newAuthor)> 100){
            throw(new RangeException("The author is not set or it is longer then permitted please try again."));
        }
        
        $newAuthor = filter_var($newAuthor, FILTER_SANITIZE_STRING);
        
        $this->author = $newAuthor;
    }
    
    /**
     *get the date the article was published
     *
     *@return string formatted sql blessed date
     **/
    public function getDatePublished()
    {
        return $this->datePublished;
    }
    
    /**
     *set the date the article was published
     *
     *@param string $newDatePublished the name of the datePublished
     *@throws UnexceptedValueException if input is not a string
     *@throws RangeException if the datePublished is not in the correct format
     **/
    public function setDatePublished($newDatePublished){
        if (gettype($newDatePublished) !== "string"){
            throw(new UnexpectedValueException("$newDatePublished is not the expected type"));
        }
        
        $dateTime = date_create_from_format("Y-m-d H:i:s",$newDatePublished);
        
        $wrong = date_get_last_errors();
        if($wrong['warning_count']>=1||$wrong['error_count']>=1)
        {
            throw(new RangeException("$newDatePublished is not in the correct format of YYYY-MM-DD 00:00:00"));
        }
        
        $this->datePublished = $newDatePublished;
    }
    
    /**
     *gets the value in an image 0(false) or 1(true) an image is avaliable
     *
     *@return int an image exists in a article
     **/
    public function getImageAvailable(){
        return $this->imageAvaliable;
    }
        
    /**
     *set if an image is available for an article
     *
     *@param integer $newImageAvailable the fact that an image is in the article
     *@throws UnexpectedValueException when the type passed is not what is expected
     *@throws RangeException when the integer is not one or zero
     **/
    public function setImageAvailable($newImageAvailable){
        if (gettype($newImageAvailable) !== "integer"){
            throw(new UnexpectedValueException("$newDatePublished is not the expected type"));
        }
        
        if ($newImageAvailable !== 0 && $newImageAvailable !== 1)
        {
            throw(new RangeException("$newImageAvailable is not 0 or 1"));
        }
        $this->imageAvaliable = $newImageAvailable;
    }
    
    /**
     *get the text in article
     *
     *@return string text of the article in question
     **/
    public function getArticleText(){
        return $this->articleText;
    }
    
    /**
     *set the text in an article
     *
     *@param string $newArticleText article text
     *@throws UnexpectedValueException if the text is not a string
     *@throws RangeException if the text does not have any length
     **/
    
    public function setArticleText($newArticleText){
        if (gettype($newArticleText)!== "string"){
            throw(new UnexpectedValueException("Please use text in the article"));
        }
        
        if (strlen($newArticleText)<1){
            throw(new RangeException("The article text is not set please try again."));
        }
        
        $newArticleText = filter_var($newArticleText,FILTER_SANITIZE_STRING);
        
        $this->articleText = $newArticleText;
    }
    
    /**
     *get the publisher of the article
     *
     *@return string publisher of the article
     **/
    public function getPublisher(){
        return $this->publisher;
    }
    
    /**
     *set the publisher of the article
     *
     *@param string article publisher
     *@throws UnexpectedValueException if the publisher is not a string
     *@throws RangeException if the publisher does not have any length or is longer than 70
     **/
    public function setPublisher($newPublisher){
        if (gettype($newPublisher)!== "string"){
            throw(new UnexpectedValueException("Please use a publisher of the article"));
        }
        
        if (strlen($newPublisher)<1 || strlen($newPublisher)>70){
            throw(new RangeException("The article publisher is not set or too long please try again."));
        }
        
        $newPublisher = filter_var($newPublisher,FILTER_SANITIZE_STRING);
        
        $this->publisher = $newPublisher;
    }
    
    /**
     *get the url of the article
     *
     *@returns string url
     **/
    public function getUrl(){
        return $this->url;
    }
    
    /**
     *set the url the article was found at
     *
     *@param string $newUrl url of the article
     *@throws UnexpectedValueException if the url is not a string, not a valid url, or http or https link
    **/
    public function setUrl($newUrl){
        if (gettype($newUrl)!== "string"){
            throw(new UnexpectedValueException("Please use a url string of the article"));
        }
        
        //check that string is a valid url
        if (filter_var($newUrl,FILTER_VALIDATE_URL)===false){
            throw(new UnexpectedValueException("Please use a valid url link"));
        }
        
        $splitUrl = explode ("://",$newUrl);
        if (strtolower($splitUrl[0]) !== "http" && strtolower($splitUrl[0]) !== "https"){
            throw(new UnexpectedValueException("Please use only Http and Https"));
        }
        
        $splitUrl[1] = filter_var($splitUrl[1],FILTER_SANITIZE_STRING);
        
        $this->url = implode("://",$splitUrl);        
    }
    
    /**
     * inserts this article to mySQL
     *
     * @param resource $mysqli pointer to mySQL connection, by reference
     * @throws mysqli_sql_exception when mySQL related errors occur
     **/
    public function insert(&$mysqli) {
        // handle degenerate cases
        if(gettype($mysqli) !== "object" || get_class($mysqli) !== "mysqli") {
            throw(new mysqli_sql_exception("input is not a mysqli object"));
        }
        
        // enforce the articleId is null (i.e., don't insert an article that already exists)
        if($this->articleId !== null) {
            throw(new mysqli_sql_exception("not a new article"));
        }
        
        // create query template
        $query     = "INSERT INTO article(userId, title, author, datePublished, imageAvailable, articleText, publisher, url)
                        VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
        $statement = $mysqli->prepare($query);
        if($statement === false) {
            throw(new mysqli_sql_exception("Unable to prepare statement"));
        }
        // bind the member variables to the place holders in the template
        $wasClean = $statement->bind_param("isssisss", $this->userId, $this->title, $this->author,
                                                   $this->datePublished,  $this->imageAvaliable,
                                                   $this->articleText, $this->publisher, $this->url);
        if($wasClean === false) {
            throw(new mysqli_sql_exception("Unable to bind parameters"));
        }
        
        // execute the statement
        if($statement->execute() === false) {
            throw(new mysqli_sql_exception("Unable to execute mySQL statement"));
        }
        
        // update the null userId with what mySQL just gave us
        $this->articleId = $mysqli->insert_id;
    }
    
     /**
     * deletes this Resource from mySQL
     *
     * @param resource $mysqli pointer to mySQL connection, by reference
     * @throws mysqli_sql_exception when mySQL related errors occur
     **/
    public function delete(&$mysqli) {
        // handle degenerate cases
        if(gettype($mysqli) !== "object" || get_class($mysqli) !== "mysqli") {
            throw(new mysqli_sql_exception("input is not a mysqli object"));
        }
        
        // enforce the articleId is not null (i.e., don't delete a article that hasn't been inserted)
        if($this->articleId === null) {
            throw(new mysqli_sql_exception("Unable to delete an article"));
        }
        
        // create query template
        $query     = "DELETE FROM article WHERE articleId = ?";
        $statement = $mysqli->prepare($query);
        if($statement === false) {
            throw(new mysqli_sql_exception("Unable to prepare statement"));
        }
        
        // bind the member variables to the place holder in the template
        $wasClean = $statement->bind_param("i", $this->articleId);
        if($wasClean === false) {
            throw(new mysqli_sql_exception("Unable to bind parameters"));
        }
        
        // execute the statement
        if($statement->execute() === false) {
            throw(new mysqli_sql_exception("Unable to execute mySQL statement"));
        }
    }
    
    /**
     * updates the text, date it was published, author, and title of the article
     *
     *
     * @param article $mysqli pointer to mySQL connection, by reference
     * @throws mysqli_sql_exception when mySQL related errors occur
     **/
    public function update(&$mysqli) {
        // handle degenerate cases
        if(gettype($mysqli) !== "object" || get_class($mysqli) !== "mysqli") {
            throw(new mysqli_sql_exception("input is not a mysqli object"));
        }
        
        // enforce the userId is not null (i.e., don't update a user that hasn't been inserted)
        if($this->userId === null) {
            throw(new mysqli_sql_exception("Unable to update a user that does not exist"));
        }
        
        // create query template
        $query     = "UPDATE article SET userId = ?, title = ?, author= ? , articleText= ?, datePublished = ?, imageAvailable = ?, publisher = ?, url = ? WHERE articleId = ?";
        $statement = $mysqli->prepare($query);
        if($statement === false) {
            throw(new mysqli_sql_exception("Unable to prepare statement"));
        }
        
        // bind the member variables to the place holders in the template
        $wasClean = $statement->bind_param("issssissi", $this->userId, $this->title, $this->author,
                                                   $this->articleText, $this->datePublished,  $this->imageAvaliable,
                                                    $this->publisher, $this->url, $this->articleId);
        if($wasClean === false) {
            throw(new mysqli_sql_exception("Unable to bind parameters"));
        }
        
        // execute the statement
        if($statement->execute() === false) {
            throw(new mysqli_sql_exception("Unable to execute mySQL statement"));
        }
    }
    
    /**
     * gets the Article by ArticleId in the database
     *
     * @param arser found or null if not found
     * @throws mysqli_sql_exception when mySQL related errors occur
     **/
    public static function getArticleByArticleId(&$mysqli, $articleId) {
        // handle degenerate cases
        if(gettype($mysqli) !== "object" || get_class($mysqli) !== "mysqli") {
            throw(new mysqli_sql_exception("input is not a mysqli object"));
        }
        // enforce the articleId is not null (i.e., don't update an article that hasn't been inserted)
        //if($this->articleId === null) {
        //    throw(new mysqli_sql_exception("Unable to update an article that does not exist"));
        //}
        
        // sanitize the articleId by by seting it
        //$this->setArticleId($articleId);
        //$articleId = $this->getArticleId();
        
        // create query template
        $query     = "SELECT userId, title, author, datePublished, imageAvailable,
                    articleText, publisher, url FROM article WHERE articleId = ?";
        
        $statement = $mysqli->prepare($query);
        if($statement === false) {
            throw(new mysqli_sql_exception("Unable to prepare statement"));
        }
        
        // bind the email to the place holder in the template
        $wasClean = $statement->bind_param("i", $articleId);
        if($wasClean === false) {
            throw(new mysqli_sql_exception("Unable to bind parameters"));
        }
        
        // execute the statement
        if($statement->execute() === false) {
            throw(new mysqli_sql_exception("Unable to execute mySQL statement"));
        }
        
        // get result from the SELECT query 
        $result = $statement->get_result();
        if($result === false) {
            throw(new mysqli_sql_exception("Unable to get result set"));
        }
        
        // since this is a unique field, this will only return 0 or 1 results. So...
        // 1) if there's a result, make it into a article object normally
        // 2) if there's no result, return null
        $row = $result->fetch_assoc(); // fetch_assoc() returns a row as an associative array
        
        // convert the associative array to a User
        if($row !== null) {
            try {
                $article = new Article($articleId, $row["userId"], $row["title"], $row["author"], $row["datePublished"], $row["imageAvailable"],
                                       $row["articleText"], $row["publisher"], $row["url"]);
            }
            catch(Exception $exception) {
                // if the row couldn't be converted, rethrow it
                throw(new mysqli_sql_exception("Unable to convert row to Article $exception", 0, $exception));
            }
            
            return($article);
        } else {
            // 404 Article not found - return null instead
            return(null);
        }
    }
    
    /**
     * gets the three most recent Articles in order of date in the database
     *
     * @param resource $mysqli pointer to mySQL connection, by reference
     * @return array of objects of the three most recent articles found
     * @throws mysqli_sql_exception when mySQL related errors occur
     **/
    public static function getArticlesDateInOrderBy(&$mysqli){
        // handle degenerate cases
        if(gettype($mysqli) !== "object" || get_class($mysqli) !== "mysqli") {
            throw(new mysqli_sql_exception("input is not a mysqli object"));
        }
        
        // create query template
        $query   = "SELECT articleId, userId, title, datePublished, imageAvaliable, articleText, publisher, url
            FROM article ORDER BY datePublished DESC LIMIT 3";
        
        $statement = $mysqli->prepare($query);
        if($statement === false) {
            throw(new mysqli_sql_exception("Unable to prepare statement"));
        }
        
        // execute the statement
        if($statement->execute() === false) {
            throw(new mysqli_sql_exception("Unable to execute mySQL statement"));
        }
        
        $resultRows = array();
        while(($row = $result->fetch_assoc()) !== null) { // fetch_assoc() returns a row as an associative array
            // create an object using the constructor
            $article = new Article ($row["articleId"], $row["userId"], $row["title"], $row["datePublished"], $row["imageAvailable"],
                                    $row["articleText"], $row["publisher"], $row["url"]);
            // add the object to the array
            $resultRows[] = $article;
        }
        
        return $resultRows;
    }
}
?>