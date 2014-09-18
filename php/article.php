<?php
/**
 *The Article class deals with articles and allows the adding and retrival of articles
 *
 *@author Nicholas Bowling <nbowling505@gmail.com>
 *@version 0.1.2
 **/

class Article{
    /**
     *automatically generated id for an article and is null if not given
     **/
    private $articleId
    
    /**
     *the string title of the article
     **/
    private $title
    
    /**
     *the string author of the article
     **/
    private $author
    
    /**
     *the datetime the article was published
     **/
    private $datePublished
    
    /**
     *the large string text inside the article
     **/
    private $text
    
    /**
     *the string publisher of the article
     **/
    private $publisher
    
    /**
     *the string url the article was found at
     **/
    private $url
    
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
    public function setArticleID($newArticleId){
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
        
        $this->datePublished = $newDatePublished;
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
            throw(new RangeException("The article text is not set please tryu again."));
        }
        
        $this->title = $newText;
    }
    
    
    
}
?>