<?php
/**
 *This is the login class for obtaining and creating a login from the login table. This class
 *will also clarify the fields in the table and when instaned create an object for database manipulation.
 *
 *@author Rey Baros 
 **/

 
 class Login {
    /**
     *state variable for loginId (primary key)
     **/
    private $loginId;
    /**
     *state variable for userId 
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
     *The constructor or expected variables need for class creation loginId can be null
     *@param mixed $newLoginId the login id of the individual loging in
     *@param integer $newUserId the id of the user associated with the login
     *@param string $authenticationToken is randomized string for email authenication
     *@param string $newPassword the encrypted password 
     *@param string $newSalt the salt used to create the encrypted password
     *@param string $newUserName the username choosen for login purposes
     *@throws UnexpectedValueException when bad types are passed into the constructor 
     *@throws RangeException when a value passed is not in an acceptable range of values
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
     *sets the loginId
     *@param setting parameter
     *@throws UnexpectedValueException if its not an integer
     *@throws RangeException if login range is invalid
    **/
    public function setLoginId($newLoginId) {
        if ($newLoginId === null) {
            $this->loginId = null;
            return;
        }
        
        if(gettype($newLoginId) !== "integer"){
            throw(new UnexptectedValueException ("Invalid Characters"));
        }
        
        if($newLoginId < 0) {
            throw(new RangeException("$newLoginId is not acceptable"));
        }   
        
        $this->LoginId = $newLoginId;        
    }
    
           //set the getter
    public function getLoginId() {
        return($this->loginId);
    }
    
     /**
     *set the userId
     *@param integer $newUserId the user id of the person in the database
     *@throws UnexpectedValueException if invalid characters
     *@throws RangeException if userid not between 1 and 50 characters
     **/
    public function setuserId($newUserId) {
        if(gettype($newUserId) !== "integer"){
            throw(new UnexptectedValueException ("Invalid Characters"));
        }
    
        if($userId < 0) {
            throw(new RangeException("$newUserId is not acceptable"));
        }    
    
        $this->LoginId = $newUserId;        
    }
           
    /**
     *get the user id of this person that is person
     *@return integer the user id of the person associated with this log in
     **/
    public function getUserId() {
        return($this->UserId);
    }
    
    /**
     *set the authenticationToken
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
     *gets the current value of the authenicationToken
     *@return string value of the authenitation token that was created for registration purposes 
    **/
    public function getAuthenticationToken(){
         return($this->authenticationToken);
    }
    
    /**  
     * Sets the password for this login 
     * @param string $newPassword the password as it was passed in
     * @throws UnexpectedValueException if the input is not a string
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
    
    /**
     *Get the password value
     *@return string hashed password for this login
     **/
    public function getPassword() {
           return($this->password);
    }
    
    /**
     *Set the salt of the login
     *
     *@param string $newSalt the salt used during creation 
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
    
    /*
     *Get the value of the salt
     *
     *@return sting the value of the salt for this login
     */
    public function getSalt() {
          return($this->salt);
    }
    
    /**
     *Sets the userName for this login
     *
     *@param string $newUserName The name the user has choosen for logging in
     *@throws UnexpectedValue exception if valuse passed is not a string
     *@throws RangeException if the user name does not conform to length standards
    **/
    public function setUserName($newUserName) {
        if(gettype($newUserName) !== "string") {
            throw(new UnexpectedValueException ("Please provide a regular user name"));
        }
        
        if(strlen($newUserName <= 0)){
            throw(new RangeException ("Please enter a user name"));
        }
        
        if(strlen($newUserName > 30)){
            throw(new RangeException ("Please enter a shorter user name"));
        }
        
        // sanitize it
        $newUserName = filter_var ( $newUserName, FILTER_SANITIZE_STRING);
        
        $this->userName = $newUserName;
    }
        
    /* Get the value of the userName
     *
     * @return string The user name of the login we are acceaaing
     **/
    public function getUserName() {
        return($this->UserName);
    }
    
    /**
     *Inserts a login record into the mySql database
     *
     *@param resource $mysqli pointer to mySQL connection, by reference
     *@throws mysqli_sql_exception when mySQL errors occur
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
        $query     = "INSERT INTO login(loginId, userId, authenticationToken, password, salt, userName) VALUES(?, ?, ?, ?, ?)";
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
     * Deletes this login from mySQL
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
     * updates this login row selected in mySQL
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
        $wasClean = $statement->bind_param("iisss", $this->userId, $this->authenticationToken, $this->password, $this->salt,
                                           $this->userName);
                                                    
        if($wasClean === false) {
            throw(new mysqli_sql_exception("Unable to bind parameters"));
        }
        
        // execute the statement
        if($statement->execute() === false) {
            throw(new mysqli_sql_exception("Unable to execute mySQL statement"));
        }
    }

    /**
     *Selects a login by userName and returns one result on success
     *@param resource $mysqli object pointer
     *@param string $newUserName the user that you want to look for
     *@throws mysqli_sql_exception for any database connection problems or issues
     *@return mixed null if no result is found or a login object
     **/
    public static function selectLoginByUserName(&$mysqli, $newUserName)
    {
        if(gettype($mysqli) !== "object" || get_class($mysqli) !== "mysqli") {
            throw(new mysqli_sql_exception("input is not a mysqli object"));
        }
        
        //santize and reset
        $this->setUserName(newUserName);
        $cleanUser = $this->getUserName();
        
        //prepare the select statement
        $query     = "SELECT loginId, userId, authenticationToken, password, salt FROM login WHERE username= ?";
        $statement = $mysqli->prepare($query);
        if($statement === false) {
            throw(new mysqli_sql_exception("Unable to prepare statement"));
        }
        
        // bind the member variables to the place holders in the template
        $wasClean = $statement->bind_param("s", $cleanUser);
        
        if($wasClean === false) {
            throw(new mysqli_sql_exception("Unable to bind parameters"));
        }
        
        // execute the statement
        if($statement->execute() === false) {
            throw(new mysqli_sql_exception("Unable to execute mySQL statement"));
        }
        
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
                $login = new Login($row["loginId"], $row["userId"], $row["authenticationToken"], $row["password"], $row["salt"], $row["userName"]);
            }
            catch(Exception $exception) {
                // if the row couldn't be converted, rethrow it
                throw(new mysqli_sql_exception("Unable to convert row to Login", 0, $exception));
            }
            
            return($login);
        } else {
            // 404 Article not found - return null instead
            return(null);
        }
    }
    
    /**
     *Selects a login by userId and returns one result on success
     *@param resource $mysqli object pointer
     *@param string $newUserId the user id that you want to look for
     *@throws mysqli_sql_exception for any database connection problems or issues
     *@return mixed null if no result is found or a login object
     **/
    public static function selectLoginByUserId(&$mysqli, $newUserId)
    {
        if(gettype($mysqli) !== "object" || get_class($mysqli) !== "mysqli") {
            throw(new mysqli_sql_exception("input is not a mysqli object"));
        }
        
        //santize and reset
        $this->setUserId(newUserId);
        $cleanUserId = $this->getUserId();
        
        //prepare the select statement
        $query     = "SELECT loginId, authenticationToken, password, salt, userName FROM login WHERE userId = ?";
        $statement = $mysqli->prepare($query);
        if($statement === false) {
            throw(new mysqli_sql_exception("Unable to prepare statement"));
        }
        
        // bind the member variables to the place holders in the template
        $wasClean = $statement->bind_param("i", $cleanUser);
        
        if($wasClean === false) {
            throw(new mysqli_sql_exception("Unable to bind parameters"));
        }
        
        // execute the statement
        if($statement->execute() === false) {
            throw(new mysqli_sql_exception("Unable to execute mySQL statement"));
        }
        
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
                $login = new Login($row["loginId"], $cleanUserId , $row["authenticationToken"], $row["password"], $row["salt"], $row["userName"]);                         
            }
            catch(Exception $exception) {
                // if the row couldn't be converted, rethrow it
                throw(new mysqli_sql_exception("Unable to convert row to Login", 0, $exception));
            }
            
            return($login);
        } else {
            // 404 Article not found - return null instead
            return(null);
        }
    }
    
    /**
     *Selects a login by authenticationToken and returns one result on success
     *@param resource $mysqli object pointer
     *@param string $newUserName the user that you want to look for
     *@throws mysqli_sql_exception for any database connection problems or issues
     *@return mixed null if no result is found or a login object
     **/
    public static function selectLoginByAuthenticationToken(&$mysqli, $newAuthenticationToken)
    {
        if(gettype($mysqli) !== "object" || get_class($mysqli) !== "mysqli") {
            throw(new mysqli_sql_exception("input is not a mysqli object"));
        }
        
        //santize and reset
        $this->setAuthenticationToken(newUserId);
        $cleanAuthenticationToken = $this->getAuthenticationToken();
        
        //prepare the select statement
        $query     = "SELECT loginId, userId, password, salt, userName FROM login WHERE authenticationToken = ?";
        $statement = $mysqli->prepare($query);
        if($statement === false) {
            throw(new mysqli_sql_exception("Unable to prepare statement"));
        }
        
        // bind the member variables to the place holders in the template
        $wasClean = $statement->bind_param("s", $cleanAuthenicationToken);
        
        if($wasClean === false) {
            throw(new mysqli_sql_exception("Unable to bind parameters"));
        }
        
        // execute the statement
        if($statement->execute() === false) {
            throw(new mysqli_sql_exception("Unable to execute mySQL statement"));
        }
        
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
                $login = new Login($row["loginId"], $row["userId"] , $cleanAuthenticationToken, $row["password"], $row["salt"], $row["userName"]);
            }
            catch(Exception $exception) {
                // if the row couldn't be converted, rethrow it
                throw(new mysqli_sql_exception("Unable to convert row to Login", 0, $exception));
            }
            
            return($login);
        } else {
            // 404 Article not found - return null instead
            return(null);
        }
    }
    
    /**
     *Selects a login by userName and password and returns one result on success (hash the password before use)
     *@param resource $mysqli object pointer
     *@param string $newUserName the user that you want to look for
     *@param string $newPassword the hash password that was provided
     *@throws mysqli_sql_exception for any database connection problems or issues
     *@return mixed null if no result is found (username, password combination does not exist) or a login object
     **/
    public static function selectLoginByUserNamePassword(&$mysqli, $newUserName, $newPassword)
    {
        if(gettype($mysqli) !== "object" || get_class($mysqli) !== "mysqli") {
            throw(new mysqli_sql_exception("input is not a mysqli object"));
        }
        
        //santize and reset
        $this->setUserName($newUserId);
        $cleanUserName = $this->getUserName();
        $this->setPassword($newPassword);
        $cleanPassword =$this->getPassword();
        
        //prepare the select statement
        $query     = "SELECT loginId, userId, authenticationToken FROM login WHERE userName = ? AND password = ?";
        $statement = $mysqli->prepare($query);
        if($statement === false) {
            throw(new mysqli_sql_exception("Unable to prepare statement"));
        }
        
        // bind the member variables to the place holders in the template
        $wasClean = $statement->bind_param("ss", $cleanUserName, $cleanPassword);
        
        if($wasClean === false) {
            throw(new mysqli_sql_exception("Unable to bind parameters"));
        }
        
        // execute the statement
        if($statement->execute() === false) {
            throw(new mysqli_sql_exception("Unable to execute mySQL statement"));
        }
        
        $result = $statement->get_result();
        if($result === false) {
            throw(new mysqli_sql_exception("Results are not available"));
        }
        
        // since this is a unique field, this will only return 0 or 1 results. So...
        // 1) if there's a result, make it into a article object normally
        // 2) if there's no result, return null
        $row = $result->fetch_assoc(); // fetch_assoc() returns a row as an associative array
        
        // convert the associative array to a User
        if($row !== null) {
            try {
                $login = new Login($row["loginId"], $row["userId"] , $row["authenticationToken"], $cleanPassword, $row["salt"], $cleanUserName);                       
            }
            catch(Exception $exception) {
                // if the row couldn't be converted, rethrow it
                throw(new mysqli_sql_exception("Unable to convert row to Login", 0, $exception));
            }
            
            return($login);
        } else {
            // 404  not found - return null instead
            return(null);
        }
    }
}
?>