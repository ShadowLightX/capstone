<?php
/**
 *creating a class for login
 *login class to state the attributes in login table
 *this class will also clarify the login specifications
 *beginning by declaring the variables password and userName
 *
 *
 *@author Rey Baros 
 **/

 
 class login {
    /**
     *declaring variables password, loginId, userId
     *
     *declaring loginId 
     *
     **/
    private $loginId;
    /**
     *declaring password variable
     */
    private $userId;
    /**
     * state variable for authenticationToken
     **/
    private $authenticationToken;
    /**
     * state variable for salt
     **/
    private $password;
      /**
     *state the variable userId
     **/
     private $salt;
    
    
    
    
     /*
     *creating constructor for login
     *
     *
     **/
    public function __construct($newLoginId, $newUserId, $newAuthenticationToken, $newPassword, $newSalt) {
        
        try {
            $this->setLoginId($newLoginId);
            $this->setuserId($newUserId);
            $this->setauthenticationToken($newAuthenticationToken);
            $this->setpassword($newPassword);
            $this->setsalt($newSalt);
        }
        catch(UnexpectedValueException $error) {
            // rethrow the exception to the code that tried to create the object
            throw(new UnexpectedValueException("unable to create Login", 0, $error));
        }
        catch(RangeException $error) {
            // again, just re-throw to inform the caller of the error
            throw(new RangeException("unable to create Login", 0, $error));
        }
    }
    
 
        
        /**
         *setter
         *@param setting parameter
         *@throws UnexpectedValueException if its not an integer
         *@throws RangeException if login range is invalid
         *this?
         *
         **/
        public function setLoginId($newLoginId) {
            if(gettype($newLoginId) !== "integer"){
                throw(new UnexptectedValueException ("Invalid Characters"));
            }
            if($newLoginId < 1 || $login> 2000000) {
                throw(new RangeException("$newLoginId is not acceptable"));
            }   
        $this->LoginId = $newLoginId;
            
        
        }
           //set the getter
           public function getLoginId() {
           return($this->LoginId);
           }
              /**
           *set userId to integer
           *@throws UnexpectedValueException if invalid characters
           *@throws RangeException if userid not between 1 and 50 characters
           *this?
           *
           **/
            public function setuserId($newUserId) {
            if(gettype($newUserId) !== "integer"){
                throw(new UnexptectedValueException ("Invalid Characters"));
            }
            if($userId < 1 || $userId > 50) {
                throw(new RangeException("$newUserId is not acceptable"));
            }
             $this->LoginId = $newUserId;
            
        
     }
           // set the getter
           public function getUserId() {
           return($this->UserId);
        }
             /**
             *mutator method for authentication token
             *@param mixed new value of authentication token or null if a user is activated
             *@throws UnexpectedValueException if the authentication token is not a hexadecimal string
             **/
     
           public function setAuthenticationToken($newAuthenticationToken){
           // zeroth, allow a nunn if this is a new object
            if($newAuthenticationToken === null) {
            $this->authenticationToken = null;
            return;
         }
         
         // first trim the input of excess whitespace
         $newAuthenticationToken = trim($newAuthenticationToken);
         
         
         // second verify this is a string of 32 hexadecimal characters
         $filterOptions = array("option" => array("regexp" => "/^[\da-f] {32} $/i"));
         if((filter_var($newAuthenticationToken, FILTER_VALIDATE_REGEXP, $filterOptions)) === false) {
            throw(new UnexpectedValueException("$newAuthenticationToken is not hexidecimal"));
         }
         /**
          *Sanitize the authenticationToken
          **/
         $newAuthenticationToken = filter_var ( $newAuthenticationToken, FILTER_SANITIZE_STRING);

         // finally, if it passed the regular expresssion, it is clean and can be taken out of the quarentine
         $this->authenticationToken = $newAuthenticationToken;
     }
         /**
         * accessor methods for authenication token
         *
         **/
         public function getAuthenticationToken(){
         return($this->authenticationToken);
     }
    
        /**  
        * set the string of passwords 
        * setting the setter
        * @throws UnexpectedValueException if the input is not a string
        * 
        **/

        public function setPassword($newPassword) {
        // check if the keys are truly an string
        if(gettype($newPassword) !== "string") {
            throw(new UnexpectedValueException ("Please retype password"));
        }
        
        // sanitize it and forget it
        $newPassword = filter_var ( $newPassword, FILTER_SANITIZE_STRING);
        // this?
        $this->password = $newPassword;
        }
        // retreive the value with a getter
           public function getPassword() {
           return($this->password);
    }
        /**
         *setting the setter for salt
         */
         public function setSalt($newSalt){
       
         // first trim the input of excess whitespace
         $newSalt = trim($newSalt);
         
         
         // second verify this is a string of 64 hexadecimal characters
         $filterOptions = array("option" => array("regexp" => "/^[\da-f] {64} $/i"));
         if((filter_var($newSalt, FILTER_VALIDATE_REGEXP, $filterOptions)) === false) {
            throw(new UnexpectedValueException("$newSalt is not hexidecimal"));
         }
         
         // finally, if it passed the regular expresssion, it is clean and can be taken out of the quarantine
         $newSalt = strtolower($newSalt);
         $this->salt = $newSalt;
     }
    
          public function getSalt() {
          return($this->salt);
          }
        
        
        
  
    } 
        




?>