<?php
/**
 *The Article class deals with articles and allows the adding and retrival of articles
 *
 *@author Nicholas Bowling <nbowling505@gmail.com>
 *@version 0.1
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
    private $datepublished
    
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
        
        
        if (gettype($newArticleId !== "int")&& ($newArticleId < 0|| $newArticleId > 20000000))
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
}
?>