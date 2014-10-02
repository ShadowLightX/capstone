<?php
require_once("header.html");
?>
     <form class="text-center col-xs-10" id="signUpForm" method="post" action="php/signup.php">
	  <p style="color: red">*required</p><br>
	  <label for="firstName">First Name</label><br>
	  <input type="text" id="firstName" name="firstName" placeholder="first name(optional)" /><br><br>
	  <label for="lastName">Last Name</label><br>
	  <input type="text" id="lastName" name="lastName" placeholder="last name(optional)"/><br><br>
	  <label for="userName" style="color: red">*User Name</label><br>
	  <input type="text" id="userName" name="userName" placeholder="user name"/><br><br>       
	  <label for="password" style="color: red">*Password</label><br>
	  <input type="password" id="password" name="password" placeholder="password" /><br><br>
	  <label for="confirmPassword" style="color: red">*Confirm Password</label><br>
	  <input type="password" id="confirmPassword" name="confirmPassword" placeholder="confirm password" /><br><br>
	  <label for="email" style="color: red">*E-mail</label><br>
	  <input type="email" id="email" name="email" placeholder="E-mail" /><br><br>
	  <button type="submit">Submit</button>
     </form>
			   
<p id="outputArea"></p>
<?php
require_once("footer.html");
?>