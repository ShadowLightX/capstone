<?php
require_once("php/article.php");
require_once("php/login.php");
require_once("php/user.php");
require_once("php/cs.php");
require_once("/etc/apache2/capstone-mysql/net-neutrality.php");
session_start();
if (isset($_SESSION["user"])== true && session_id() !== null) {
    $link = '<a href="logout.php">Logout</a>';
}
else {
    $link = '<a href="#x" class="overlay" id="login_form">Login</a>';
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <Title>Home</title>
        <meta charset="UTF-8" />
        <!--format-->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!--format-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--stylesheet-->
        <link rel="stylesheet" type="text/css" href="css/neutrality.css" />
        <!--bootstrap-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<link href="css/bootstrap.min.css" rel="stylesheet">
        <!--javascript-->
        <script type="text/javascript" src="javascript/bootstrap.min.js"></script>
        <!--google font-->
	<link href='http://fonts.googleapis.com/css?family=Geo' rel='stylesheet' type='text/css'>			
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]-->
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<!--[endif]-->
	<script src="javascript/neutrality.js"></script>			
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <link href="tabs.css" rel="stylesheet" type="text/css"><!-- added for tabs link rey-->
        <script src="//malsup.github.com/jquery.form.js"></script>
        <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.min.js"></script>
        <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/additional-methods.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="javascript/bootstrap.min.js"></script>
	<script src="javascript/signup.js"></script>
	<!-- link type="text/css" rel="stylesheet" href="css/jquery-form.css" /-->

    </head>
    <body class="col-xs-offset-1">
	<div class="container">
	    <!--nav-->
	    <section id="logo" class="col-xs-10 col-md-2 logo"><a href="index.php"><img alt ="net-neutrality-logo" src="images/logo.png"></a></section>
	    <ul class="row myMenu">
		<li id="home" class="text-center col-xs-10 col-md-2 home"><a href="index.php"><h2>Home</h2></a></li>
		<li id="resources" class="text-center col-xs-10 col-md-2 resources"><a href=""><h2>Resources</h2></a>
		    <ul>
			<li class="text-center col-xs-10 col-md-2"><a href="http://www.change.org/p/tom-wheeler-save-net-neutrality">Sign the Petition</a></li>
			<li class="text-center col-xs-10 col-md-2"><a href="http://www.savetheinternet.com/sti-home">Get involved</a></li>
			<li class="text-center col-xs-10 col-md-2"><a href="http://www.senate.gov/reference/common/faq/How_to_contact_senators.htm">Contact your Senators</a></li>
		    </ul>
		</li>
		<li id="articles" class="text-center col-xs-10 col-md-2 articles"><a href="articles.php"><h2>Articles</h2></a>
		    <ul>
			<li class="text-center col-xs-10 col-md-2"><a href="article-template.php">Comcast Time Warner Merger</a></li>
			<li class="text-center col-xs-10 col-md-2"><a href="article-template1.php">Article1</a></li>
		    </ul>
		</li>
		<li id="forums" class="text-center col-xs-10 col-md-2 forums"><a href="forum/"><h2>Forums</h2></a></li>
		<li id="search" class="text-center col-xs-10 col-md-4 search reverse" ><script>
		    (function() {
			var cx = '009791810137793547729:flmkvccfzue';
			var gcse = document.createElement('script');
			gcse.type = 'text/javascript';
			gcse.async = true;
			gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//www.google.com/cse/cse.js?cx=' + cx;
			var s = document.getElementsByTagName('script')[0];
			s.parentNode.insertBefore(gcse, s);
		    })();
		</script><gcse:search></gcse:search></li>
		<li id="register" class="text-center col-xs-10 col-md-2 register reverse"><a href="register.php"><h2>Register</h2></a></li>
		<li id="login" class="text-center col-xs-10 col-md-2 login reverse"><!--<a href=" "> --> <!--<h2>login</h2>  this goes after the popup code-->
		    <!-- start, do not delete the comments-->
		    <div class="main" <!--img src="images/network_neutrality-mar.jpg">
			<div class="panel"> 
			    <a href="#login_form" id="login_pop" ><h2>Login</h2></a>
			    <!--<a href="#join_form" id="join_pop">Sign Up</a>
			</div>
			</div>
			popup form #1 -->
			<a href="#x" class="overlay" id="login_form"></a>
			<div class="popup">
			    <!-- <h2>Welcome Guest!</h2>  -->
			    <p><h5>Please enter your login and password here</h5></p>
			    <form name="login" method="post" action="php/userlogin.php">
				<div>
				    <?php
				     echo generateInputTags();
				     ?>
				</div>
				<div>
				    <label for="login">User Name</label> 
				    <input type="text" id="userLogin" name="userLogin" value="" />
				</div>
				<div>
				    <label for="password">Password</label>
				    <input type="password" id="userPassword" name="userPassword" value="" />
				</div>
				<h3><input type="submit" name="Login" value="Login" /></h3>
				<a class="close" href="#close"></a>
				<?php echo $link; ?>
			    </form>
			</div>
		    </div>
		<!-- end of login link-->
		<!--</a>--></li>
	    </ul>