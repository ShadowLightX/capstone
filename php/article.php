<?php
/**
 *The Article class deals with articles and allows the adding and retrival of articles
 *
 *@author Nicholas Bowling <nbowling505@gmail.com>
 *@version 0.1.6
 **/

class Article{
    /**
     *automatically generated id for an article and is null if not given
     **/
    private $articleId;
    
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
    private $text;
    
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
     *@param mixed Article ID for the article
     *@param string Title for the article
     *@param string Author of the article
     *@param string The date the article was published
     *@param string The text in the article
     *@param string The publisher of an article
     *@param string The URL the article came from
     *@throws UnexceptedValueException if inputs are of the incorrect types or urls
     *@throws RangesException if the inputs contain invalid values
     **/
    
    public function __construct($newArticleId,$newTitle,$newAuthor,$newDatePublished,$newText,$newPublisher,$newUrl){
        try{
            $this->setArticleId($newArticleId);
            $this->setTitle($newTitle);
            $this->setAuthor($newAuthor);
            $this->setDatePublished($newDatePublished);
            $this->setText($newText);
            $this->setPublisher($newPublisher);
            $this->setUrl($newUrl);
        }
        catch(UnexpectedValueException $error){
            //rethrow the exception passed when the object was created the object
            throw(new UnexpectedValueException("unable to create article", 0, $error));
        }
        catch(RangeException $error){
            //rethrow the exception passed from the object was created
            throw(new RangeException("unable to create article", 0, $error));
        }
    }
    
    /**
     *get the Article ID number
     *
     *@return integer Article ID
     **/
    public function getArticleId(){
        return $this->articleId;    
    }
    
    /**
     *set value of Article ID
     *@param mixed the ID that the article has
     *@throws RangeException for anything that is not null, string, or int
     **/
    public function setArticleId($newArticleId){
        if ($newArticleId == null)
        {
            $this->articleId = null;
            return;
        }
        
        //tests for string
        if (gettype($newArticleId) === "string"){
            $newArticleId = trim($newArticleId);
        
            $newArticleId = filter_var($newArticleId, FILTER_SANITIZE_NUMBER_INT);
        
            //converts to integer    
            $newArticleId = intval($newArticleID); 
        }
        
        
        if (gettype($newArticleId) !== "int"&& ($newArticleId < 0|| $newArticleId > 20000000))
        {
            throw(new RangeException("$newArticleID is not a number in the correct range"));
        }
        
        $this->articleId = $newArticleId;
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
     *@param string the name(title) of the article
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
        return $this->title;
    }
    
    /**
     *set the name of the author
     *
     *@param string the name of the author
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
        
        $this->title = $newTitle;
    }
    
    /**
     *get the date the article was published
     *
     *@return string formatted sql blessed date
     **/
    public function getDatePublished()
    {
        $this->datePublished;
    }
    
    /**
     *set the date the article was published
     *
     *@param string the name of the datePublished
     *@throws UnexceptedValueException if input is not a string
     *@throws RangeException if the datePublished is not in the correct format
     **/
    public function setDatePublished($newDatePublished){
        if (gettype !== "string"){
            throw(new UnexpectedValueException("$newDatePublished is not the expected type"));
        }
        
        $dateTime = date_create_from_format("Y/m/d H:i:s",$newDatePublished);
        
        if(date_get_last_errors['warning_count']>=1||date_get_last_errors['error_count']>=1)
        {
            throw(new RangeException("$newDatePublished is not in the correct format of YYYY/MM/DD 00:00:00"));
        }
        
        $this->datePublished = $dateTime;
    }
    
    /**
     *get 0(false) or 1(true) an image is avaliable
     *
     *@return int an image exists in a article
     **/
    public function getImageAvailable(){
        $return $this->imageAvailable;
    }
        
    /**
     *set if an image is available for an article
     *
     *@param boolean $newImageAvailable the fact that an image is in the article
     *@throws UnexpectedValueException when the type passed is not what is expected
     **/
    public function setImageAvailbable($newimageAvailable){
        if (gettype !== "boolean"){
            throw(new UnexpectedValueException("$newDatePublished is not the expected type"));
        }
        
        if ($newImageAvailable)
        {
            $this->imageAvailable = 1;
        }
        else
        {
            $this->imageAvailable = 0;
        }
    }
    
    /**
     *get the text in article
     *
     *@return string text of the article in question
     **/
    public function getText(){
        $this->text;
    }
    
    /**
     *set the text in an article
     *
     *@param string article text
     *@throws UnexpectedValueException if the text is not a string
     *@throws RangeException if the text does not have any length
     **/
    
    public function setText($newText){
        if (gettype($newText)!== "string"){
            throw(new UnexpectedValueException("Please use text in the article"));
        }
        
        if (strlen($newText)<1){
            throw(new RangeException("The article text is not set please try again."));
        }
        
        $newText = filter_var($newText,FILTER_SANITIZE_STRING);
        
        $this->title = $newText;
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
     *@param string url of the article
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
        if (strtolower($splitUrl[0]) !== "http" || strtolower($splitUrl[0]) !== "https"){
            throw(new UnexpectedValueException("Please use only Http and Https"));
        }
        
        $splitUrl[1] = filter_var($splitUrl[1],FILTER_SANITIZE_STRING);
        
        $this->url = implode("://",$splitUrl);        
    }
}
?>