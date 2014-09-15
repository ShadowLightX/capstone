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
     *integer of user ID's
     **/
    private $userId;
    
    /**
     *boolean role
     **/
    private $role;
    
    /**
     *array of names
     **/
    private $name;
    
    /**
     *array of email addresses
     **/
    private $email;
    
    /**
     *constructor for user information
     *
     *@param integer new user ID
     *@param boolean new role
     *@param array new names
     *@param array new emails
     **/
    public function __construct($newUser, $newRole, $newName, $newEmail) {
        try{
            //use our mutator methods to sanitize inputs
            $this->setKeys($newUserID);
            $this->setType($newRole; 
            $this->setType($newName); 
            $this->setType($newEmail);         
        }
        
        catch(UnexpectedValueException $error) {
            //rethrow the exception to the code that tried to create the object
            throw(new UnexpectedValueException("unable to create piano", 0, $error));
        }
    }
    
    
    /**
     *gets the value of user ID
     *
     *@return integer value of userId
     **/
    public function getUserId() {
        return($this->userID);
    }
    
    /**
     *sets the value of the user ID
     *
     *@param integer of userId
     *@throws UnexpectedValueException if the input is not an integer
     **/
    public function setUserID($newUserId) {
        
        //fourth, verify the value of each key is on the interval [0,1]
        foreach($newKeys as $pianoKey) {
            if($newUserId < 0 || $pianoKey > 200000000) {
                throw(new RangeException("$userId is not on the interval [0,1]"));
            }
        }
        
        //if the array got here, it's passed all our tests - assign it!
        $this->userId = $newUesrId;
    }
    
    /**
     *gets the value of type
     *
     *@return array value of type
     **/
    public function getType() {
        return($this->type);
    }
    
    /**
     *sets the type of the piano
     *
     *@param string type of the piano
     *@throws UnexpectedValueException if the input is not a string
     *@throws RangeException if the type is not a recognized type
     **/
    public function setType($newType) {
        //first, check if the keys are truly a string
        if(gettype($newType) !== "string") {
            throw(new UnexpectedValueException("please enter athe type"));
        }
        
        //second, sanitize the string
        $newType = filter_var($newType, FILTER_SANITIZE_STRING);
        
        //third, verify the type against an array of known types
        $pianoTypes = array("geand", "baby grand", "keyboard", "Playskool");
        if(in_array($newType, $pianoTypes) === false) {
            throw(new RangeException("$newType is not a type of piano"));
        }
        
        //if the type was found in the array, we can take it out of quarantine
        $this->type = $newType;
    }
    
    /**toString() contract to tell the user summary data about this piano
     *
     *@param string summary data about this piano
     **/
    public function __toString() {
        //first, calculate the mean damage of the keys
        $mean = 0.0;
        foreach($this->keys as $pianoKey) {
            $mean = $mean + $pianoKey;
        }
        $mean = $mean / count($this->keys);
        
        //second, build a string with the summary
        $summary = "this is a " . $this->type . " piano with a mean damage of $mean</p>";
        return($summary);
    }
}

?>