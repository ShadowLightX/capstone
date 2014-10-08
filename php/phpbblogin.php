<?php
/**
 * PHP enbled cross-database login
 *
 * This is a php class which allows the users to login to both the website and forum databases at the same time
 *
 * @author Modesto Ayala Ruth <tigrecientifico@gmail.com>
 **/
require_once("login.php");
require_once("user.php");
 
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
    
    /*
     * The constructor or expected variables need for class creation loginId can be null
     *
     * @param bool $newAdmin determines whther user is admin
     * @param bool $newAuthenticated determines whether user is authenticated
     * @param string $newEmail the email given by the user
     * @param string $newUsername the username choosen for login purposes
     * @throws UnexpectedValueException when bad types are passed into the constructor 
     * @throws RangeException when a value passed is not in an acceptable range of values
     **/
    public function __construct($newAdmin, $newAuthenticated, $newEmail, $newUsername) {
        try {
            $this->setAdmin($newAdmin);
            $this->setAuthenticated($newAuthenticated);
            $this->setEmail($newEmail);
            $this->setUsername($newUsername);
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
     * @param bool $newAdmin admin
     **/
    public function setAdmin($newAdmin) {
        $true = array(1, "true", "T", "yes", "Y", "on", true);
        if(in_array($newAdmin, $true) === true) {
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
     * @param bool $newAuthenticated authenticated
     **/
    public function setAuthenticated($newAuthenticated) {   
        $true = array(1, "true", "T", "yes", "Y", "on", true);
        if(in_array($newAuthenticated, $true) === true) {
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
        // allow email to be null
        if($newEmail === null) {
            $this->email = null;
            return;
        }

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
        // allow the username to be null
        if($newUsername === null) {
            $this->username = null;
            return;
        }

        // sanitize the username as a likely username
        $newUsername = trim($newUsername);
        if(($newUsername = filter_var($newUsername, FILTER_SANITIZE_STRING)) == false) {
            throw(new UnexpectedValueException("$newUsername does not exist"));
        }
        
        // then just take username out of quarantine
        $this->username = $newUsername;
    }
    
    /**
     * logs in a user from mySQL
     *
     * @param mysqli $mysqli mySQLi object, by reference
     * @param string $username username of the user
     * @param string $password clear text password of the user
     * @return bool true if authenticated, false if not
     * @throws mysqli_sql_exception if a mySQL error occurs
     **/
    public function loginUser(&$mysqli, $username, $password) {
        $userLogin = Login::getLoginByUsername($mysqli, $username);
        
        if($userLogin === null) {
            return(false);
        }
        
        $hash = hash_pbkdf2("sha512", $password, $userLogin->getSalt(), 2048, 128);
        $getPassword = $userLogin->getPassword();
        
        if ($hash === $getPassword) {
            $user = User::getUserByUserId($mysqli, $userLogin->getUserId());
            $role = $user->getRole();
            if($role === 2) {
                $this->setAdmin(true);
            } else {
                $this->setAdmin(false);
            }
            
            $this->setUserName($userLogin->getUserName());
            $this->setEmail($user->getEmail());
            return(true);
        } else {
            return(false);
        }
    }
    
    public function jsonLogin(&$mysqli, $username, $password){
        $this->setAuthenticated($this->loginUser($mysqli, $username, $password));
        return($this->toJson());
    }

    public function toJson() {
        $memberVariables = get_object_vars($this);
        $jsonObject      = new stdClass();
        foreach($memberVariables as $name => $value) {
            $jsonObject->$name = $value;
        }
        return(json_encode($jsonObject));
    }
}

?>