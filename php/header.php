<?php
/*
 *this function outputs the beginning of the page
 *@param string the title of the page
 *@param array of javascript files you want to use
 *@param array of css files(do not pass in googlefonts)
 **/
function generateHeader ($title, $jscript, $css)
{
//html that will not be changed for any reason
echo "<!DOCTYPE html>\n
    <html lang='en'>\n
    <head>\n
    \t<Title>$title</title>\n
    \t\t<meta charset='UTF-8' />\n
    \t\t<!-- Format -->\n
    \t\t<meta http-equiv='X-UA-Compatible' content='IE=edge'>\n
    \t\t<meta name='viewport' content='width=device-width, initial-scale=1'>\n";
    
echo "\t\t<!-- Stylesheet -->";
    if (gettype($css) !== "array"){
        throw(new UnexpectedValueException ("css is not an array"));
    }
    
    $newCss = array_values($css);

    foreach($newCss -> $style){
        echo "<link rel='stylesheet' type='text/css' href='$style'/>";        
    }
        
    echo "\t\t<link href='http://fonts.googleapis.com/css?family=Geo' rel='stylesheet' type='text/css'>\n			
        \t\t<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->\n
	\t\t<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->\n
	\t\t<!--[if lt IE 9]-->";
    
    if (gettype($jscript)!== "array"){
        throw(new UnexpectedValueException ("javaacript is not an array"));
    }

    $newJavascript = array_values($jscript);

    foreach($newJavascript -> $js){
        echo "\t\t<script src="$js"></script>\n";        
    }
    
    echo "\t\t<!--[endif]-->\n";
    echo "</head>\n";
}


function generateNavigation(){
    echo "	<!--nav-->
                  <section id= 'logo' class= 'col-xs-10 col-md-2'><a href='index.html'><img src='images/logo.png'></a></section>
                  <ul class='row myMenu'>
		      <li id= 'home' class= 'col-xs-10 col-md-2'><a href='index.html'>Home</a></li>
		      <li id= 'resources' class='col-xs-10 col-md-2'><a href='resources.html'>Resources</a>
		    <ul>
		      <li class= 'col-xs-10 col-md-2'><a href='#'>...</a></li>
		      <li class= 'col-xs-10 col-md-2'><a href='#'>...</a></li>
		      <li class= 'col-xs-10 col-md-2'><a href='#'>...</a></li>
		      <li class= 'col-xs-10 col-md-2'><a href='#'>...</a></li>
		    </ul>
		    <li id= 'articles' class= 'col-xs-10 col-md-2'><a href= 'articles.html'>Articles</a> </li>
		    <ul>
		      <li class= 'col-xs-10 col-md-2'><a href='#'>...</a></li>
		      <li class= 'col-xs-10 col-md-2'><a href='#'>...</a></li>
		      <li class= 'col-xs-10 col-md-2'><a href='#'>...</a></li>
		      <li class= 'col-xs-10 col-md-2'><a href='#'>...</a></li>
		    </ul>
		    </li>
		    <li id= 'forums' class= 'col-xs-10 col-md-2'><a href='forums.html'>Forum</a></li><br>    
		    <ul class='row signup'>
			<li id= 'search' class= 'col-xs-10 col-sm-5' ><a href='....html'>Search</a></li>
			<li id= 'login' class= 'col-xs-10 col-sm-3'><a href='....html'>Login</a></li>
		    </ul>
		</ul>";
}
?>