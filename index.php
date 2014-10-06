<?php
require_once("header.php");
?>
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
			<a id="carousel1" href="videos.php"><img src="images/vi-hart-net-neutrality-600x369.jpg" alt="net neutrality video"></a><!--added link-->
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
<?php
require_once("footer.html");
?>