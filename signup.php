<?php
require_once("header.html");
?>
	       <!--start of form-->
	       <!--rey start-->
	       <!--start of form-->
	       <h2 class="text-center"></h2><br><br><br>
	       <!--<p id="outputArea"></p>-->
	       <!--New addition TEST-->
	       <div id="wrapper">
		    <div id="tabContainer">
			 <div class="tabs">
			      <ul>
				   <li id="tabHeader_1">Login</li>
				   <li id="tabHeader_2">Registration</li>
			      <!--taking this out <li id="tabHeader_3">Page 3</li>-->
			      </ul>
			 </div>
			 <div class="tabscontent">
			      <div class="tabpage" id="tabpage_1">
				   <h2>Login</h2>
				   <p>
					<!-- adding login form -->
					<form name="login" action="index_submit" method="get" accept-charset="utf-8">  
					     <ul>  
						  <li><label for="usermail">Email</label>  
						  <input type="email" name="usermail" placeholder="yourname@email.com" required></li>  
						  <li><label for="password">Password</label>  
						  <input type="password" name="password" placeholder="password" required></li>  
						  <li>  
						  <input type="submit" value="Login"></li>  
					     </ul>  
					</form>  
				   <!-- ending addition -->
				   </p>
			      </div>
			      <div class="tabpage" id="tabpage_2">
			      <h2>Registration</h2>
			      <!--mutation begin-->
			      <!-- rey end-->
				   <p>
				   <!--<h2 class="text-center"></h2><br><br><br>-->
					<form class="text-center col-xs-10" id="signUpForm" method="post" action="php/signup.php">
					    <p style="color: red">*required</p><br>
					    <label for="firstName">First Name</label>
					    <input type="text" id="firstName" name="firstName" placeholder="first name(optional)" /><br><br>
					    <label for="lastName">Last Name</label>
					    <input type="text" id="lastName" name="lastName" placeholder="last name(optional)"/><br><br>
					    <label for="userName" style="color: red">*User Name</label>
					    <input type="text" id="userName" name="userName" placeholder="user name"/><br><br>       
					    <label for="password" style="color: red">*Password</label>
					    <input type="password" id="password" name="password" placeholder="password" /><br><br>
					    <label for="confirmPassword" style="color: red">*Confirm Password</label>
					    <input type="password" id="confirmPassword" name="confirmPassword" placeholder="confirm password" /><br><br>
					    <label for="email" style="color: red">*E-mail</label>
					    <input type="email" id="email" name="email" placeholder="E-mail" /><br><br>
					    <button type="submit">Submit</button>
					</form>
				   </p>
			      <!--rey start-->
			      </div>
			      <!--taking this out
			      <div class="tabpage" id="tabpage_3">
				   <h2>Page 3</h2>
				   <p>Pellentesque habitant morbi tristique senectus...</p>
			      </div>-->
			 </div>
		    </div>
	       </div>    
	       <script src="javascript/tabs.js"></script>
	       <!--END TEST-->
	       <!-- rey end-->
	       <p id="outputArea"></p>
<?php
require_once("footer.html");
?>