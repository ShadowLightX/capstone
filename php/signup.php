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
	       $passHashed = hash_pbkdf2("sha512", $safepassword, $salt, 2048, 128);
	       
	       //create authentication token
	       $token = bin2hex(openssl_random_pseudo_bytes(16));
	       
	       //create classes
	       $user = new User(null, "user",$safeFirstName,$safeLastName,$safeEmail);
	       $userId = $user->getUserId();
	       $login = new Login(null,$userId,$token,$passHashed,$salt,$safeUserName);
	       
	       //connect to the database
	       $database = Pointer::getPointer();
	       
	       //insert into the user table and the login table
	       $user->insert($database);
	       $login->insert($database);
     
	       /*send an email verification (not ready yet)
	       mail($user->getEmail, "Email Verification", "Welcome to our site we a pleased you have decided to register
		    with us. Your authentication venue is $website/?auth='$token'");*/
	       
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