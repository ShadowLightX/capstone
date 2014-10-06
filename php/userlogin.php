<?php
require_once("login.php");
require_once("user.php");
require_once("phpbblogin.php")
require_once("cs.php");
require_once("/etc/apache2/capstone-mysql/net-neutrality.php");
session_start();
function siteLogin(){
    $verified = verifyCsrf($_POST["csrfName"], $_POST["csrfToken"]);
    if ($verified === true){
	try{
	    $database = Pointer::getPointer();
	    //scrub the incomming stuff from $post using input santization
	    $newUserName = filter_input(INPUT_POST, "userLogin", FILTER_SANITIZE_STRING);
	    $newPassword = trim(filter_input(INPUT_POST, "userpassword", FILTER_SANITIZE_STRING));
	    //pass the values to be found in our database
	    $phplogin = PhpBBLogin::loginUser($database,$newUserName,$newPassword);
	    $ourLogin = Login::selectLoginByUserNamePassword($database,$newUserName,$newPassword);
	    //no object
	    if ($phplogin == true){
		    if(isset($_SESSION["user"]) === false)
		    {
			if ($ourNewLogin->getAuthenticationToken()!=null){
				$_SESSION["user"] = $newUserName;
				$ourUser = User::getUserByUserId($database, $ourNewLogin->getUserId());
				$role = $ourUser->getRole();
				if ($role == "admin"){
				    $_SESSION["admin"] = true;
				}
				else
				{
				    $SESSION["admin"]= false;
				}
			 }
			else{
			     echo "please register before logging in.";
			}
		    }
		    else
		    {
			throw(new RuntimeException("Unable to login as session already exists"));
		    }
	    }
    

	    // compare the sent token and session token
	    $verified = false;
	    $token    = $_SESSION[$name];

	}
	catch (Exception $exception)
	{
	    echo "<span class='badform'>$exception</span>";
	}
    }    
}
?>