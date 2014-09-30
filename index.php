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
    </head>
    <body class="col-xs-offset-1">
	<div class="container">
	    <!--nav-->
	    <section id="logo" class="col-xs-10 col-md-2 logo"><a href="index.php"><img alt ="net-neutrality-logo" src="images/logo.png"></a></section>
	    <ul class="row myMenu">
		<li id="home" class="text-center col-xs-10 col-md-2 home"><a href="index.php"><h2>Home</h2></a></li>
		<li id="resources" class="text-center col-xs-10 col-md-2 resources"><a href="resources.html"><h2>Resources</h2></a>
		    <ul>
			<li class="text-center col-xs-10 col-md-2"><a href="#">...</a></li>
			<li class="text-center col-xs-10 col-md-2"><a href="#">...</a></li>
			<li class="text-center col-xs-10 col-md-2"><a href="#">...</a></li>
			<li class="text-center col-xs-10 col-md-2"><a href="#">...</a></li>
		    </ul>
		</li>
		<li id="articles" class="text-center col-xs-10 col-md-2 articles"><a href="articles.html"><h2>Articles</h2></a>
		    <ul>
			<li class="text-center col-xs-10 col-md-2"><a href="article-template.html">Article</a></li>
			<li class="text-center col-xs-10 col-md-2"><a href="articles-template1.html">Article1</a></li>
			<li class="text-center col-xs-10 col-md-2"><a href="articles-template2.html">Article2</a></li>
		    </ul>
		</li>
		<li id="forums" class="text-center col-xs-10 col-md-2 forums"><a href="forums.html"><h2>Forums</h2></a></li>
		<li id="search" class="text-center col-xs-10 col-md-4 search reverse" ><a href="....html"><h2>Search</h2></a></li>
		<li id="register" class="text-center col-xs-10 col-md-2 register reverse"><a href="....html"><h2>Register</h2></a></li>
		<li id="login" class="text-center col-xs-10 col-md-2 login reverse"><a href="....html"><h2>Login</h2></a></li>
	    </ul>
	    <!--carousel-->
	    <div id="carousel-example-generic" class="carousel slide col-xs-10" data-ride="carousel">
		<!--indicators-->
		<ol class="carousel-indicators">
		    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
		    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
		    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
		</ol>
		<!--wrapper for slides-->
		<div class="carousel-inner">
		    <div class="item active">
			<a id="carousel1" href="videos.html"><img src="images/vi-hart-net-neutrality-600x369.jpg" alt="net neutrality video"></a><!--added link-->
			<div class="carousel-caption">
			    Watch the video here!
			</div>
		    </div>
		    <!-- <div class="item">
			<img src="http://tednasmith.mymiddleearth.com/files/2012/09/TN-Red_Keep_at_Kings_Landing.jpg" alt="...">
			<div class="carousel-caption">
			    ...
			</div>
		    </div>
		    <div class="item">
			<img src="http://tednasmith.mymiddleearth.com/files/2012/09/TN-Castle_Black_and_The_Wall.jpg" alt="...">
			<div class="carousel-caption">
			    ...
			</div>
		    </div>
			... -->
		</div>
		<!--controls-->
		<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
		    <span class="glyphicon glyphicon-chevron-left"></span>
		</a>
		<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
		    <span class="glyphicon glyphicon-chevron-right"></span>
		</a>
	    </div>
	    <!--news-->
	    <section id="news" class="text-center col-xs-10 news" >
		<h2>Recent News</h2>
		<p><!-- start feedwind code --><script type="text/javascript">document.write('<script type="text/javascript" src="' + ('https:' == document.location.protocol ? 'https://' : 'http://') + 'feed.mikle.com/js/rssmikle.js"><' + '/script>');</script><script type="text/javascript">(function() {var params = {rssmikle_url: "http://www.savetheinternet.com/sti-blog/rss.xml|https://www.eff.org/rss/updates.xml|http://www.infoworld.com/category/internet/index.rss|http://www.overclock.net/rss.php?action=livefeed&forumId=149|http://slashdot.org/blog.rss",rssmikle_frame_width: "300",rssmikle_frame_height: "400",rssmikle_target: "_blank",rssmikle_font: "Arial, Helvetica, sans-serif",rssmikle_font_size: "12",rssmikle_border: "on",responsive: "on",rssmikle_css_url: "",text_align: "left",text_align2: "left",corner: "off",scrollbar: "on",autoscroll: "on",scrolldirection: "down",scrollstep: "5",mcspeed: "20",sort: "New",rssmikle_title: "on",rssmikle_title_sentence: "Net Neutrality and Other Net News",rssmikle_title_link: "",rssmikle_title_bgcolor: "#0066FF",rssmikle_title_color: "#FFFFFF",rssmikle_title_bgimage: "",rssmikle_item_bgcolor: "#FFFFFF",rssmikle_item_bgimage: "",rssmikle_item_title_length: "55",rssmikle_item_title_color: "#0066FF",rssmikle_item_border_bottom: "on",rssmikle_item_description: "on",item_link: "off",rssmikle_item_description_length: "150",rssmikle_item_description_color: "#666666",rssmikle_item_date: "gl1",rssmikle_timezone: "Etc/GMT",datetime_format: "%b %e, %Y %l:%M:%S %p",item_description_style: "text+tn",item_thumbnail: "full",article_num: "15",rssmikle_item_podcast: "off",keyword_inc: "neutrality",keyword_exc: ""};feedwind_show_widget_iframe(params);})();</script><div style="font-size:10px; text-align:center; "><a href="http://feed.mikle.com/" target="_blank" style="color:#CCCCCC;">RSS Feed Widget</a><!--Please display the above link in your web page according to Terms of Service.--></div><!-- end feedwind code --></p>
	    </section>
	    <!--footer-->
	    <section id="footer" class="text-center col-xs-10 footer" >
		<h2>...</h2>
		<p>...</p>
	    </section>
	</div>    
    </body>
</html>