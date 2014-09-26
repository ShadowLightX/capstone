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
     * username of user
     **/
    private $username;
    /**
     * email of user
     **/
    private $email;
    /**
     * denotes whether or not user is an admin
     **/
    private $admin;
    /**
     * function to authenticate a user login
     **/
    private $authenticated;
    
    /**
     * gets the value of username
     *
     * @return string value of username
     **/
    public function getUsername() {
        return($this->username);
    }
    
    /**
     * sets the value of email
     *
     * @param string $newEmail email
     * @throws UnexpectedValueException if the input doesn't appear to be an Email
     **/
    public function setUsername($newUsername) {
        // sanitize the Email as a likely Email
        $newUsername = trim($newUsername);
        if(($newUsername = filter_var($newUsername, FILTER_SANITIZE_EMAIL)) == false) {
            throw(new UnexpectedValueException("$newUsername does not exist"));
        }
        
        // then just take email out of quarantine
        $this->username = $newUsername;
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
     * gets the value of admin
     *
     * @return boolean $admin
     **/
    
    /**
     * gets the value of Authenticated
     *
     * @return string value of email
     **/
    
    public function loginUser(){
        
    }
    
    public function jsonLogin(){
        json_encode
    }
}

?>