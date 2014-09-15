<?php
/**
 *class representing a users in Net-Neutrality website
 *
 *this is a container for user information
 *
 *@author Charlie Goodan <cgoodan@gmail.com>
 **/
class User {
    //first, start with the member (state) variables - documenting each in a block
    /**
     *integer of user ID
     **/
    private $userId;
    
    /**
     *integer of article ID
     **/
    private $articleId;
    
    /**
     *string of roles
     **/
    private $role;
    
    /**
     *string of names
     **/
    private $name;
    
    /**
     *string of email addresses
     **/
    private $email;
    
    /**
     *constructor for user information
     *
     *@param integer new user ID
     *@param integer new article ID
     *@param string new role
     *@param string new names
     *@param string new emails
     **/
    public function __construct($newUserId, $newArticleId, $newRole, $newName, $newEmail) {
        try{
            //use our mutator methods to sanitize inputs
            $this->setKeys($newUserID); 
            $this->setType($newArticleId);
            $this->setType($newRole; 
            $this->setType($newName); 
            $this->setType($newEmail);         
        }
        /**
         *----------------------------
        catch(UnexpectedValueException $error) {
            //rethrow the exception to the code that tried to create the object
            throw(new UnexpectedValueException("unable to create piano", 0, $error));
        }
    }
    *-------------------------------------
    **/
    
    /**
     *gets the value of the user's ID
     *
     *@return integer value of userId
     **/
    public function getUserId() {
        return($this->userId);
    }
    
    /**
     *sets the value of the user's ID
     *
     *@param integer of userId
     *@throws UnexpectedValueException if the input is not an integer
     **/
    public function setUserId($newUserId) {
        
        //verify the value of each user ID is on the interval [1 - 200,000,000]
        foreach($newUserId as $userId) {
            if($newUserId < 1 || $newUserId > 200000000) {
                throw(new RangeException("$newUserId is not an acceptable."));
            }
        }
        
        //if the integer got here, it's passed all our tests - assign it!
        $this->userId = $newUserId;
    }
    
    /**
     *gets the value of the article's ID
     *
     *@return integer value of articleId
     **/
    public function getArticleId() {
        return($this->articleId);
    }
    
    /**
     *sets the value of the article's ID
     *
     *@param integer of articleId
     *@throws UnexpectedValueException if the input is not an integer
     **/
    public function setArticleId($newArticleId) {
        
        //verify the value of each article ID is on the interval [1 - 200,000,000]
        foreach($newArticleId as $articleId) {
            if($newArticleId < 1 || $newArticleId > 200000000) {
                throw(new RangeException("$newArticleId is not an acceptable."));
            }
        }
        
        //if the integer got here, it's passed all our tests - assign it!
        $this->articleId = $newArticleId;
    }
    
    
    /**
     *gets the role of the user (admin or user)
     *
     *@return string of role
     **/
    public function getRole() {
        return($this->role);
    }
    
    /**
     *sets the role of the user (admin or user)
     *
     *@param string of role
     **/
    public function setRole($newRole) {
        //sanitize the string
        $newRole = filter_var($newRole, FILTER_SANITIZE_STRING);
        
        //if the string got here, it's passed all our tests - assign it!
        $this->role = $newRole;
    }
    
    /**
     *gets the name of the user
     *
     *@return string of name
     **/
    public function getName() {
        return($this->name);
    }
    
    /**
     *sets the name of the user
     *
     *@param string of name
     **/
    public function setName($newName) {
        //sanitize the string
        $newName = filter_var($newName, FILTER_SANITIZE_STRING);
        
        //if the string got here, it's passed all our tests - assign it!
        $this->name = $newName;
    }
    
    /**
     *gets the Email of the user
     *
     *@return string of email
     **/
    public function getEmail() {
        return($this->email);
    }
    
    /**
     *sets the Email of the user
     *
     *@param string of email
     **/
    public function setEmail($newEmail) {
        //sanitize the string
        $newEmail = filter_var($newEmail, FILTER_SANITIZE_STRING);
        
        //if the string got here, it's passed all our tests - assign it!
        $this->email = $newEmail;
    }
    
?>