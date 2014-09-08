<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
            <!-- Format -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <!-- Format -->
        <meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>Sign Up</title>
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
	// define error varialbles
	$firstNameErr = "First name is required";
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	 // If form fields are empty give error if not proceed to test input
	if(empty($_POST["firstName"])) {
        $firstNameErr = "First name is required";
	}
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
			<h1>Registered User Sign Up</h1>
			<form method="post" action="signup.html">
			    <label for="firstName">First Name</label>
			    <input type="text" name="firstName">
			    <?php
				if(empty($_POST["firstName"])) {
				$firstNameErr = "First name is required";
			    }
			    ?>
			    <span class="error">* <?php echo $firstNameErr;?></span>
			    <br><br>
			    <label for="lastName">Last Name</label>
			    <input type="text" name="lastName">
			    <span class="error">* <?php echo $lastNameErr;?></span>
			    <br><br>
			    <label for="userName">User Name</label>
			    <input type="text" name="userName">
			    <span class="error">* <?php echo $userNameErr;?></span>
			    <br><br>
			    <label for="password">Enter Password</label>
			    <input type="password" name="password">
			    <span class="error">* <?php echo $passwordErr;?></span>
			    <br><br>
			    <label for="confirm_password">Confirm Password</label>
			    <input type="password" name="confirm_password">
			    <span class="error">* <?php echo $confirm_passwordErr;?></span>
			    <br><br>
			    <label for="email">E-mail</label>
			    <input type="email" name="email">
			    <span class="error">* <?php echo $emailErr;?></span>
			    <br><br>
			    <button type="submit" value="submit">Submit</button>
			</form>
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