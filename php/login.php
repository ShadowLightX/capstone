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
     /**
      *state variable for username
      **/
     private $userName;
     /*
     *creating constructor for login
     *
     *
     **/
    public function __construct($newLoginId, $newUserId, $newAuthenticationToken, $newPassword, $newSalt, $newUserName) {
        
        try {
            $this->setLoginId($newLoginId);
            $this->setuserId($newUserId);
            $this->setauthenticationToken($newAuthenticationToken);
            $this->setpassword($newPassword);
            $this->setsalt($newSalt);
            $this->setUserName($newUserName);
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
           return($this->loginId);
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
        
        /**
         *setting up the userName funciton
         **/
        public function setUserName($newUserName) {
            if(gettype($newUserName) !== "string") {
            throw(new UnexpectedValueException ("Please retype "));
        }
        // sanitize it
        $newUserName = filter_var ( $newUserName, FILTER_SANITIZE_STRING);
        }
        // setting the getter
        public function getUserName() {
           return($this->UserName);
    }
    
    
    
    /**
     *adding my insert, delete and update
     **/
     public function insert(&$mysqli) {
        // handle degenerate cases 
        if(gettype($mysqli) !== "object" && get_class($mysqli) !== "mysqli") {
            throw(new mysqli_sql_exception("input is not a mysqli object"));
        }
        
        // enforce the loginId is null (i.e., don't insert a login that already exists)
        if($this->loginId !== null) {
            throw(new mysqli_sql_exception("not a new login"));
        }
        
        // create query template
        // CUSTOMIZE THE QUERY -- BIGGEST CHANGE
        $query     = "INSERT INTO login(userId, authenticationToken, password, salt, userName) VALUES(?, ?, ?, ?, ?)";
        $statement = $mysqli->prepare($query);
        if($statement === false) {
            throw(new mysqli_sql_exception("Unable to prepare statement"));
        }
        
        // bind the member variables to the place holders in the template
        // CHANGE STATE VARIABLE NAMES
        // the first argument states the type: d = double, i = integer, and s = string
        $wasClean = $statement->bind_param("iss", $this->userId, $this->authenticationToken, $this->password, $this->salt, $this->userName);
        if($wasClean === false) {
            throw(new mysqli_sql_exception("Unable to bind parameters"));
        }
        
        // execute the statement
        // DOES NOT CHANGE
        if($statement->execute() === false) {
            throw(new mysqli_sql_exception("Unable to execute mySQL statement"));
        }
        
        // update the null loginId with what mySQL just gave us
        $this->loginId = $mysqli->insert_id;
    }
    
    /**
     * deletes this login from mySQL
     *
     * @param login $mysqli pointer to mySQL connection, by reference
     * @throws mysqli_sql_exception when mySQL related errors occur
     **/
    public function delete(&$mysqli) {
        // handle degenerate cases
        if(gettype($mysqli) !== "object" || get_class($mysqli) !== "mysqli") {
            throw(new mysqli_sql_exception("input is not a mysqli object"));
        }
        
        // enforce the loginId is not null (i.e., don't delete a login that hasn't been inserted)
        if($this->loginId === null) {
            throw(new mysqli_sql_exception("Unable to delete a login that does not exist"));
        }
        
        // create query template
        $query     = "DELETE FROM login WHERE loginId = ?";
        $statement = $mysqli->prepare($query);
        if($statement === false) {
            throw(new mysqli_sql_exception("Unable to prepare statement"));
        }
        
        // bind the member variables to the place holder in the template
        $wasClean = $statement->bind_param("i", $this->loginId);
        if($wasClean === false) {
            throw(new mysqli_sql_exception("Unable to bind parameters"));
        }
        
        // execute the statement
        if($statement->execute() === false) {
            throw(new mysqli_sql_exception("Unable to execute mySQL statement"));
        }
    }
    
    /**
     * updates this login in mySQL
     *
     * @param login $mysqli pointer to mySQL connection, by reference
     * @throws mysqli_sql_exception when mySQL related errors occur
     **/
    public function update(&$mysqli) {
        // handle degenerate cases
        if(gettype($mysqli) !== "object" || get_class($mysqli) !== "mysqli") {
            throw(new mysqli_sql_exception("input is not a mysqli object"));
        }
        
        // enforce the loginId is not null (i.e., don't update a resource that hasn't been inserted)
        if($this->loginId === null) {
            throw(new mysqli_sql_exception("Unable to update a resource that does not exist"));
        }
        
        // create query template
        $query     = "UPDATE login SET userId = ?, authenticationToken = ?, password = ?, salt = ?, userName = ?, WHERE loginId = ?";
        $statement = $mysqli->prepare($query);
        if($statement === false) {
            throw(new mysqli_sql_exception("Unable to prepare statement"));
        }
        
        // bind the member variables to the place holders in the template
        $wasClean = $statement->bind_param("iisss", $this->userId, $this->authenticationToken, $this->password, $this->salt, $this->userName);
                                                    
        if($wasClean === false) {
            throw(new mysqli_sql_exception("Unable to bind parameters"));
        }
        
        // execute the statement
        if($statement->execute() === false) {
            throw(new mysqli_sql_exception("Unable to execute mySQL statement"));
        }
    }
    
}
?>
        
  
    } 
        




?>