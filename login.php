<?php
require_once("header.html");
?>
	       <!--start of form--> 
			   <!--<h2 class="start here"></h2><br><br><br>-->
					
                                        
                                        
                                      <div class="container">

</style>
</head>
<body>
<div id="login">
<h1><strong>Welcome.</strong> Please login.</h1>
<form action="javascript:void(0);" method="get">
<fieldset>
<p><input type="text" required value="Username" onBlur="if(this.value=='')this.value='Username'" onFocus="if(this.value=='Username')this.value='' "></p>
<p><input type="password" required value="Password" onBlur="if(this.value=='')this.value='Password'" onFocus="if(this.value=='Password')this.value='' "></p>
<p><a href="#">Forgot Password?</a></p>
<p><input type="submit" value="Login"></p>
</fieldset>
</form>

</div> <!-- end login -->
</body>
</html>                    
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
			   <!--<h2 class="end here"></h2><br><br><br>-->
	       <p id="outputArea"></p>
<?php
require_once("footer.html");
?>