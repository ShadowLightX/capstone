<?php
require_once("article.php");
require_once("/etc/apache2/capstone-mysql/net-neutrality.php");
session_start();
function buildArticleList(){
    $database = Pointer::getPointer();
    $recentArticle = Article::getArticlesInOrderByDate($database);
    $articleList = "";
    foreach ($recentArticle as $netArticles){
	$page = $netArticles->getArticleId();
	$articleList = $articleList . "<li class='text-center col-xs-10 col-md-2'><a href='display.php?article=$page'>" . $netArticles->getTitle() . "</a></li>/n";
    }
    return ($articleList);
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
		<li id="search" class="text-center col-xs-10 col-md-4 search" ><a href="....html"><h2>Search</h2></a></li>
		<li id="register" class="text-center col-xs-10 col-md-2 register"><a href="register.php"><h2>Register</h2></a></li>
		<li id="login" class="text-center col-xs-10 col-md-2 login"><a href="....html"><h2>Login</h2></a></li>
		<li id="home" class="text-center col-xs-10 col-md-2 home reverse"><a href="index.php"><h2>Home</h2></a></li>
		<li id="forums" class="text-center col-xs-10 col-md-2 forums reverse"><a href="bootcamp-coders.cnm.edu/~mayala/forum"><h2>Forums</h2></a></li>
		<li id="resources" class="text-center col-xs-10 col-md-2 resources reverse"><a href="resources.php"><h2>Resources</h2></a>
		
		    <ul>
			<li class="text-center col-xs-10 col-md-2"><a href="#">...</a></li>
			<li class="text-center col-xs-10 col-md-2"><a href="#">...</a></li>
			<li class="text-center col-xs-10 col-md-2"><a href="#">...</a></li>
			<li class="text-center col-xs-10 col-md-2"><a href="#">...</a></li>
		    </ul>
		</li>
		<li id="articles" class="text-center col-xs-10 col-md-2 articles"><a href="articles.php"><h2>Articles</h2></a>
		    <ul>
			<?php
			echo "<li class='text-center col-xs-10 col-md-2'><a href='#'>...</a></li>";
			//echo buildArticleList();
			?>
		    </ul>
		</li>
	    </ul>