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
     *@param mixed user ID
     *@param integer role
     *@param string names
     *@param string email
     **/
    public function __construct($newUserId, $newArticleId, $newProfileId, $newRole, $newName, $newEmail) {
        try{
            //use our mutator methods to sanitize inputs
            $this->setUserId($newUserId);
            $this->setRole($newRole);
            $this->setName($newName); 
            $this->setEmail($newEmail);
        } catch(UnexpectedValueException $unexpectedValue) {
            //rethrow to the caller
            throw(new UnexpectedValueException("unable to construct user", 0, $unexpectedValue));
        } catch(RangeException $range) {
            //rethrow to the caller
            throw(new RangeException("Unable to construct user", 0, $range));
        }
    }
    
    /**
     *accessor method for user ID
     *
     *@return integer value of user ID
     **/
    public function getUserId() {
        return($this->userId);
    }
    
    /**
     *mutator method for user ID
     *
     *@param mixed new value of user id or null if a new object
     *@throws UnexpectedValueException if the user ID is not an integer
     *@throws RangeException if the user ID is not positive
     **/
    public function setUserId($newUserId) {
        //zeroth, allow a null if this is a new object
        if($newUserId === null) {
            $this->userId = null;
            return;
        }
        
        //first, trim the input of excess whitespace
        $newUserId = trim($newUserId);
        
        //second, verify this is an integer
        if((filter_var($newUserId, FILTER_VALIDATE_INT)) === false) {
            throw(new UnexpectedValueException("user id $newUserId is not an integer"));
        }
        
        //third, convert the id to an integer and ensure it's positive
        $newUserId = intval($newUserId);
        if($newUserId <= 0) {
            throw(new RangeException("user id $newUserId is not positive"));
        }
        
        //finally, the user id is clean and can be taken out of quarantine
        $this->userId = $newUserId;
    }
  
    /**
     *accessor method for role
     *
     *@return integer value of role
     **/
    public function getRole() {
        return($this->role);
    }
    
    /**
     *mutator method for role
     *
     *@param integer new value of role
     *@throws UnexpectedValueException if the role is not an integer
     *@throws RangeException if the role is not {0,1,2}
     **/
    public function setProfileId($newRole) {
        //first, trim the input of excess whitespace
        $newRole = trim($newRole);
        
        //second, verify this is an integer
        if((filter_var($newRole, FILTER_VALIDATE_INT)) === false) {
            throw(new UnexpectedValueException("role $newRole is not an integer"));
        }
        
        //third, convert the role to an integer and ensure it's positive
        $newRole = intval($newRole);
        if($newRole < 0 || $newRole >2) {
            throw(new RangeException("role $newRole is not 0, 1, or 2"));
        }
        
        //finally, the role is clean and can be taken out of quarantine
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
     *accessor method for email
     *
     *@return string value of email
     **/
    public function getEmail() {
        return($this->email);
    }
    
    /**
     *mutator method for email
     *
     *@param string new value of email
     **/
    public function setEmail($newEmail) {
        //first, trim the input of excess whitespace
        $newEmail = trim($newEmail);
        
        //second, sanitize the email of all invalid email characters
        $newEmail = filter_var($newEmail, FILTER_SANITIZE_EMAIL);
        
        //finally, bring the email out of quarantine
        $this->email = $newEmail;
    }
    
?>