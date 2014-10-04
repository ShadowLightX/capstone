<?php
/**
 * PHP enbled cross-database login
 *
 * This is a php class which allows the users to login to both the website and forum databases at the same time
 *
 * @author Modesto Ayala Ruth <tigrecientifico@gmail.com>
 **/ 
class PhpBBLogin {
    /**
     * denotes whether or not user is an admin
     **/
    private $admin;
    /**
     * function to authenticate a user login
     **/
    private $authenticated;
    /**
     * email of user
     **/
    private $email;
    /**
     * username of user
     **/
    private $username;
    
    /**
     * gets the value of admin
     *
     * @return string value of admin
     **/
    public function getAdmin() {
        return($this->admin);
    }
    
    /**
     * sets the value of admin
     * 
     * @param bool admin
     * @throws Exception if there is no true or false
     **/
    public function setAdmin($newAdmin) {
        $true = array(1, "true", "T", "yes", "Y", "on", true);
        else if(in_array($newAdmin, $true) === true) {
            $this->admin = true;
        }
        else {
            $this->admin = false;
        }
    }
    
    /**
     * gets the value of Authenticated
     *
     * @return string value of authenticated
     **/
    public function getAuthenticated() {
        return($this->authenticated);
    }
    /**
     * sets value of authenticated
     *
     * @param bool authenticated
     * @throws Exception if the user is not autheticated
     **/
    public function setAuthenticated($newAuthenticated) {   
        $true = array(1, "true", "T", "yes", "Y", "on", true);
        else if(in_array($newAuthenticated, $true) === true) {
            $this->authenticated = true;
        }
        else {
            $this->authenticated = false;
        }
    }
    
    /**
     * gets the value of email
     *
     * @return string value of email
     **/
    public function getEmail() {
        return($this->email);
    }
    
    /**
     * sets the value of email
     *
     * @param string $newEmail email
     * @throws UnexpectedValueException if the input doesn't appear to be an Email
     **/
    public function setEmail($newEmail) {
        // sanitize the Email as a likely Email
        $newEmail = trim($newEmail);
        if(($newEmail = filter_var($newEmail, FILTER_SANITIZE_EMAIL)) == false) {
            throw(new UnexpectedValueException("$newEmail is not a registered email address"));
        }
        
        // then just take email out of quarantine
        $this->email = $newEmail;
    }
    
    /**
     * gets the value of username
     *
     * @return string value of username
     **/
    public function getUsername() {
        return($this->username);
    }
    /**
     * sets the value of username
     *
     * @param string $newUsername username
     * @throws UnexpectedValueException if the input doesn't appear to be an Email
     **/
    public function setUsername($newUsername) {
        // sanitize the username as a likely username
        $newUsername = trim($newUsername);
        if(($newUsername = filter_var($newUsername, FILTER_SANITIZE_STRING)) == false) {
            throw(new UnexpectedValueException("$newUsername does not exist"));
        }
        
        // then just take username out of quarantine
        $this->username = $newUsername;
    }
    
    /**
    * gets user by Email
    *
    * @param resources $mysqli pointer to mySQL connec, by reference
    * @param string $email email search for
    * @return mixed User found or null if not found
    * @throws mysqli_sql_exception when mySQL error occurs
    **/
    public static function getUserLoginByUsername(&$mysqli, $username) {
        //handle degenerate cases
        if(gettype($mysqli) !== "object" || get_class($mysqli) !== "mysqli") {
            throw(new mysqli_sql_exception ("input is not a valid mysqli object"));
        }
        
        //sanitize the email before searching
        $username = trim($username);
        $username = filter_var($username, FILTER_SANITIZE_EMAIL);
        
        //create query template
        $query     = "SELECT userId, email, password, salt, authenticationToken FROM user WHERE username = ?";
        $statement = $mysqli->prepare($query);
        if($statement === false) {
            throw(new mysqli_sql_exception("Unable to prepare statement"));
        }
        
        //bind the member variables to the place holders in the template
        $wasClean = $statement->bind_param("s", $username);
        if($wasClean === false) {
            throw(new mysqli_sql_exception("unable to bind parameters"));
        }
        
        //execute the statement
        if($statement->execute() === false) {
            throw(new mysqli_sql_exception("unable to execute mySQL statement"));
        }
        
        //gets results from the SELECT query *pounds fists*
        $result = $statement->get_result();
        if($result === false) {
            throw(new mysqli_sql_exception("unable to get result set"));
        }
        
        //since this is a unique field, this will only return 1 or 0, so...
        //1) if there's a result we can make it into a user object normally
        //2) if there's no result, we can just return null
        $row = $result->fetch_assoc(); //fetch_assoc() returns a row as an assoc array
        
        //convert the assoc array into a user
        if($row !== null) {
            try {
                $user = new User($row["userId"], $row["email"], $row["password"], $row["salt"], $row["authenticationToken"]);
            }
            catch (Exception $exception) {
                //if the row can't be converted rethrow it
                throw(new mysqli_sql_exception("Unable to convert row to User", 0, $exception));
            }
            
            //if we got here, the user id good - return it
            return($user);
        } else {
            //404 user not found - return null instead
            return(null);
        }
    }
    
    /**
     * logs in a user from mySQL
     *
     * @param string $username username of the user
     * @param string $password clear text password of the user
     * @return bool true if authenticated, false if not
     * @throws mysqli_sql_exception if a mySQL error occurs
     **/
    public function loginUser($username, $password) {
        $userLogin - UserLogin::getUserLoginByUsername($username);
        
        $hash = hash_pbkdf2("sha512", $password, $userLogin->getSalt(), 2048, 128);
        
        if ($hash === getPassword);
    }
    
    public function jsonLogin(){
        json_encode
    }
}

?>