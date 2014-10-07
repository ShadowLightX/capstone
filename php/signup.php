<?php
// notice the $_POST superglobal is an array!
// expect all the form values to be loaded into the $_POST superglobal automatically
// (e.g., the email form value is in $_POST["email"])
// start the session and require the CSRF verifier
session_start();
require_once("cs.php");
require_once("user.php");
require_once("login.php");
require_once("/etc/apache2/capstone-mysql/net-neutrality.php");

// verify the CSRF data
try {
    $verified = verifyCsrf($_POST["csrfName"], $_POST["csrfToken"]);
    
    if($verified === true) {
	  $safeFirstName   = null;
	  $safeLastName    = null;
	  $userName        = "";
	  $password        = "";
	  $confirmPassword = "";
	  // try the sanitization so we can format errors later on
	  // filter firstName for bad stuff
	  try {
	       
	       if(!empty($_POST["firstName"])) {
	            $safeFirstName = filter_input(INPUT_POST, "firstName", FILTER_SANITIZE_STRING);
	       }
	  
	       if(!empty($_POST["lastName"])) {
	            $safeLastName = filter_input(INPUT_POST, "lastName", FILTER_SANITIZE_STRING);
	       }
	  
	       if(empty($_POST["userName"])) {
	            throw(new Exception("Please enter a User Name"));
	       }
	       else if(strlen($_POST["userName"])> 30){
		    throw(new Exception("Please enter a shorter User Name"));
	       }
	       else {
	            $safeUserName= filter_input(INPUT_POST, "userName", FILTER_SANITIZE_STRING);
	       }
	       
	       if(filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL) === false) {
	            throw(new Exception("Please enter your Email address"));
	       }
	       
	       // if filter_input passed the Email, we can use it
	       $safeEmail = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    
	       // first, trim the input of excess whitespace and sanitize both passwords 127 so
	       $safePassword = trim(filter_input(INPUT_POST, "password",       FILTER_SANITIZE_STRING));
	       $safeConfirm = trim(filter_input(INPUT_POST, "confirmPassword", FILTER_SANITIZE_STRING));
    	       
	       // ensure the passwords match
	       if($safePassword !== $safeConfirm) {
		    throw(new Exception("Please type matching passwords"));
	       }
	       //create the salt
	       $salt = bin2hex(openssl_random_pseudo_bytes(32));
	       
	       //encrypt passwords
	       $passHashed = hash_pbkdf2("sha512", $safePassword, $salt, 2048, 128);
	       
	       //create authentication token
	       $token = bin2hex(openssl_random_pseudo_bytes(16));
	       
	       //connect to the database
	       $database = Pointer::getPointer();
	       $exists = User::getUserByEmail($database,$safeEmail);
	       if ($exists->getEmail() == $safeEmail){
		    $newUser = User($exists->getUserId(), 2, $safeFirstName, $safeLastName, $safeEmail);
		    $newUser->update($database);
		    $newLoginExists = Login::selectLoginByUserName($database,$safeUserName);
		    if ($newLoginExists !== null){
			 $loginUpdate = new Login($newLoginExists->getLoginId(),$newUser->getUserId(),$token,$passHashed,$salt,$safeUserName);
			 $loginUpdate->update($database);
		    }
		    else
		    {
		        $loginUpdate = new Login(null,$newUser->getUserId(), $token,$passHashed,$salt,$safeUserName)
			$loginUpdate->insert($database); 
		    
		    //throw(new RuntimeException ("You have already registered"))
		    }
	       }
	       else{
	       //set user and give normal user access
	       $user = new User(null,2,$safeFirstName,$safeLastName,$safeEmail);
     
	       //insert into the user table and the login table
	      
	       $user->insert($database);
	       $userId = $user->getUserId();
	       $login = new Login(null,$userId,$token,$passHashed,$salt,$safeUserName);
	       $login->insert($database);
	       }
     
	       $sent = mail($safeEmail, "Email Verification", "Welcome to our site we are pleased you have decided to register
		    for an account on our site. Your authentication venue is <a href='bootcamp-coders.cnm.edu/net-neutrality/php/auth.php?auth=$token'>here</a>.");
	       
	       if ($sent == false){
		    throw(new RuntimeException("Your email did not complete normally"));
	       }
	       // everything checks out
	       echo "Welcome" . $user->getUserName() .  "Please confirm your e-mail address" . $user->getEmail() . "to complete your registration.";
	  }

	  // catch the exception and format it as an error message
	  catch (Exception $error) {
	       echo "<span class='badForm'>" . $error->getMessage() . "</span>";
	  }
    }
    else {
        echo "<span class='badform'>Form validation failed.</span>";
    }
}
catch(RuntimeException $runtime) {
    echo "<span class='badForm'>Please try going back to the main site and try again.</span>" . $runtime->getMessage();
}
?>