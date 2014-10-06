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
     * logs in a user from mySQL
     *
     * @param mysqli $mysqli mySQLi object, by reference
     * @param string $username username of the user
     * @param string $password clear text password of the user
     * @return bool true if authenticated, false if not
     * @throws mysqli_sql_exception if a mySQL error occurs
     **/
    public function loginUser(&$mysqli, $username, $password) {
        $userLogin = Login::selectLoginByUsername($mysqli, $username);
        
        if($userLogin === null) {
            return(false);
        }
        
        $hash = hash_pbkdf2("sha512", $password, $userLogin->getSalt(), 2048, 128);
        $getPassword = $userLogin->getPassword();
        
        if ($hash === $getPassword) {
            $user = User::getUserByUserId($mysqli, $userLogin->getId());
            $role = $user->getRole();
            if($role === "admin") {
                $this->setAdmin(true);
            } else {
                $this->setAdmin(false);
            }
            
            $this->setUserName($user->getUserName());
            $this->setEmail($user->getEmail());
            return(true);
        } else {
            return(false);
        }
    }
    
    public function jsonLogin(&$mysqli, $username, $password){
        $this->setAuthenticated($this->loginUser($mysqli, $username, $password));
        return(json_encode($this));
    }
}

?>