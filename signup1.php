<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
            <!-- Format -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <!-- Format -->
        <meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>Sign Up</title>
	<style>.error {color: #FF0000;}</style>
            <!-- Stylesheet -->
        <link rel="stylesheet" type="text/css" href="css/neutrality.css" />
            <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet" />
            <!-- Javascript -->
        <script type="text/javascript" src="javascript/neutrality.js"></script>
            <!-- Google font -->
	<link href='http://fonts.googleapis.com/css?family=Geo' rel='stylesheet' type='text/css' />			
            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	    <!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->
    </head>
    <body>
    <?php
	// define variables and set to empty values
        $firstName = "";
        $lastName = "";
        $userName = "";
        $password = "";
        $confirm_password = "";
        $email = "";
        // define error varialbles
        $firstNameErr = "";
        $lastNameErr = "";
        $userNameErr = "";
        $passwordErr = "";
        $confirm_passwordErr = "";
        $emailErr = "";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["firstName"])) {
	$firstNameErr = "First Name is required";
	} else {
	$firstName = test_input($_POST["firstName"]);
	// check if name only contains letters and whitespace
	if (!preg_match("/^[a-zA-Z ]*$/",$firstName)) {
        $firstNameErr = "Only letters and white space allowed"; 
     }
   }
   
	if (empty($_POST["lastName"])) {
	$lastNameErr = "Last name is required";
	} else {
	$lastName = test_input($_POST["lastName"]);
	// check if name only contains letters and whitespace
	if (!preg_match("/^[a-zA-Z ]*$/",$lastName)) {
        $lastNameErr = "Only letters and white space allowed"; 
     }
   }
   
	if (empty($_POST["userName"])) {
	$userNameErr = "User name is required";
	} else {
	$userName = test_input($_POST["userName"]);
	// check if name only contains letters and whitespace
	if (!preg_match("/^[a-zA-Z ]*$/",$userName)) {
        $userNameErr = "Only letters and white space allowed"; 
     }
   }
   
	if (empty($_POST["password"])) {
	$passwordErr = "Password is required";
	} else {
	$password = test_input($_POST["password"]);
	// check if name only contains letters and whitespace
	if (!preg_match("/^[a-zA-Z ]*$/",$password)) {
        $passwordErr = "Only letters and white space allowed"; 
     }
   }
   
	if (empty($_POST["confirmPassword"])) {
	$nameErr = "Confirmation is required";
	} else {
	$confirmPassword = test_input($_POST["confirmPassword"]);
	// check if name only contains letters and whitespace
	if (!preg_match("/^[a-zA-Z ]*$/",$confirmPassword)) {
        $confirmPasswordErr = "Only letters and white space allowed"; 
     }
   }
   
	if (empty($_POST["email"])) {
	$emailErr = "E-mail is required";
	} else {
	$email = test_input($_POST["email"]);
	// check if e-mail address is well formed
	if (!preg_match("/^[a-zA-Z ]*$/",$email)) {
        $emailErr = "Only letters and white space allowed"; 
     }
   }
   
    function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    }
?>

        <div class="container">
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
	    <link src="/css/bootstrap.min.css" />
            
            <div class="row">
		<div class="text-left">
            	    <section id= "logo" class= "col-md-3"><a href="index.html"><img src="images/network_neutrality-mar.jpg"></a></section>
		</div>
	    </div>
	    
            <div class="row">
		<div class="text-center">
            	    <section id= "search" class= "col-xs-8 col-md-5 col-md-offset-3"><a href="....html">Search</a></section>
                    <section id= "login" class= "col-xs-4 col-md-3"><a href="....html">Login</a></section>
                </div>
            </div>     
                
            <div class="row">
		<div class="text-left">			
		<h2>Registered User Sign Up</h2>
		<p><span class="error">* required field.</span></p>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
		    firstName: <input type="text" name="firstName" value="<?php echo $firstName;?>">
		    <span class="error">* <?php echo $firstNameErr;?></span>
		    <br><br>
		    lastName: <input type="text" name="lastName" value="<?php echo $lastName;?>">
		    <span class="error">* <?php echo $lastNameErr;?></span>
		    <br><br>
		    userName: <input type="text" name="userName" value="<?php echo $userName;?>">
		    <span class="error">* <?php echo $userNameErr;?></span>
		    <br><br>
		    password: <input type="text" name="password" value="<?php echo $password;?>">
		    <span class="error">* <?php echo $passwordErr;?></span>
		    <br><br>
		    confirmPassword: <input type="text" name="confirmPassword" value="<?php echo $confirmPassword;?>">
		    <span class="error">* <?php echo $confirmPasswordErr;?></span>
		    <br><br>
		    email: <input type="text" name="email" value="<?php echo $email;?>">
		    <span class="error">* <?php echo $emailErr;?></span>
		    <br><br>
		    <input type="submit" name="submit" value="Submit"> 
		</form>
    <?php
    echo "<h2>Your Input:</h2>";
    echo $firstName;
    echo "<br>";
    echo $lastName;
    echo "<br>";
    echo $userName;
    echo "<br>";
    echo $password;
    echo "<br>";
    echo $confirmPassword;
    echo "<br>";
    echo $email;
    echo "<br>";
    ?>
	    </div>	
	</div>
    <div class="row">
		<div class="text-center">
		    <section id= "footer" class= "col-xs-12 col-sm-10 col-sm-offset-1" >
			<h2>...</h2>
			<p>...</p>
		    </section>
                </div>
            </div>
	</div>
    </body>
</html>