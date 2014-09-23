<!DOCTYPE html>
<html>
     <head>
        <Title>Sign Up</title>
        <meta charset="UTF-8" />
            <!-- Format -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <!-- Format -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
            <!-- Stylesheet -->
        <link rel="stylesheet" type="text/css" href="../css/neutrality.css" />
            <!-- Bootstrap -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
            <!-- Google font -->
	<link href='http://fonts.googleapis.com/css?family=Geo' rel='stylesheet' type='text/css'>			
	    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>  
        <script src="//malsup.github.com/jquery.form.js"></script>
        <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.min.js"></script>
        <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/additional-methods.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="../javascript/bootstrap.min.js"></script>
	<script src="../javascript/signup.js"></script>
	<!-- link type="text/css" rel="stylesheet" href="css/jquery-form.css" /-->
    </head>
    <body>
       <div id="container" class="container">
	<div id="container" class="container col-xs-offset-1">
	  <!--nav-->
	  <ul class="row myMenu">
	    <section id= "logo" class= "col-xs-10 col-md-2"><a href="index.html"><img src="../images/logo.png"></a></section>
	    <li id= "home" class= "col-xs-10 col-md-2"><a href="index.html">Home</a></li>
	    <li id= "resources" class="col-xs-10 col-md-2"><a href="resources.html">Resources</a>
	      <ul>
                <li class= "col-xs-10 col-md-2"><a href="#">...</a></li>
		<li class= "col-xs-10 col-md-2"><a href="#">...</a></li>
		<li class= "col-xs-10 col-md-2"><a href="#">...</a></li>
		<li class= "col-xs-10 col-md-2"><a href="#">...</a></li>
	      </ul>
	    </li>
	    <li id= "articles" class= "col-xs-10 col-md-2"><a href="articles.html">Articles</a>
	      <ul>
                <li class= "col-xs-10 col-md-2"><a href="#">...</a></li>
                <li class= "col-xs-10 col-md-2"><a href="#">...</a></li>
                <li class= "col-xs-10 col-md-2"><a href="#">...</a></li>
                <li class= "col-xs-10 col-md-2"><a href="#">...</a></li>
	      </ul>
	    </li>
		<li id= "forums" class= "col-xs-10 col-md-2"><a href="forums.html">Forum</a></li><br>
		<li id= "search" class= "col-xs-10 col-md-4 reverse" ><a href="....html">Search</a></section>
		<li id= "login" class= "col-xs-10 col-md-4 reverse"><a href="....html">Login</a></section>
	    </ul>
	
<?php
// notice the $_POST superglobal is an array!
// expect all the form values to be loaded into the $_POST superglobal automatically
// (e.g., the email form value is in $_POST["email"])

// define variables and set to empty values
$firstName       = "";
$lastName        = "";
$userName        = "";
$password        = "";
$confirmPassword = "";
// try the sanitization so we can format errors later on
// filter firstName for bad stuff
try {
    if(empty($_POST["firstName"])) {
        throw(new Exception("Please enter your first name"));
    } else {
        $firstName = filter_input(INPUT_POST, "firstName", FILTER_SANITIZE_STRING);
    }
    
    if(empty($_POST["lastName"])) {
        throw(new Exception("Please enter your last name"));
    } else {
        $lastName = filter_input(INPUT_POST, "lastName", FILTER_SANITIZE_STRING);
    }
    if(empty($_POST["userName"])) {
        throw(new Exception("Please create your user name"));
    } else {
        $userName= filter_input(INPUT_POST, "userName", FILTER_SANITIZE_STRING);
    }
    
    if(filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL) === false) {
        throw(new Exception("Please enter your Email address"));
    }
    
    // if filter_input passed the Email, we can use it
    $safeEmail = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    
    // first, trim the input of excess whitespace
    $password = trim($password);
    
    
    // sanitize both passwords 127 so
    $safePassword = filter_input(INPUT_POST, "password",       FILTER_SANITIZE_SPECIAL_CHARS);
    $safeConfirm = filter_input(INPUT_POST, "confirmPassword", FILTER_SANITIZE_SPECIAL_CHARS);
    
    // email is safe
    echo "<p id='outputArea'>Welcome " . $userName . ". Please confirm your e-mail address to complete your registration.</p>";

    //echo $safePassword . ", " .$safeConfirm . "</p>"; 
    // ensure the passwords match
    if($safePassword !== $safeConfirm) {
        throw(new Exception("Please match passwords"));
    }
    

// catch the exception and format it as an error message
} catch (Exception $error) {
    echo "<span class='badForm'>" . $error->getMessage() . "</span>";
}
?>
<!--footer-->
		<div class="row">
		    <div class="text-center">
			<section id= "footer" class= "col-xs-10" >
			    <h2>...</h2>
			    <p>...</p>
			</section>
		    </div>
		</div>
	    </div>
        </div>
    </body>
</html>