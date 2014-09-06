<!DOCTYPE html>
<html>
    <head>
        <style>
            .error {color: #FF0000;}
        </style>
    </head>
    <body>
        <?php
        // Initialize variables and set to empy strings
        $firstName = $lastName = "";
        $firstNameErr = $lastNameErr = "";
        
        // Control variables
        $app_state = "emtpy";  // empty, processed, logged in
        $valid = 0;
        
        // Validate input and sanitize
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if(empty($_POST["firstName"])) {
                $firstNameErr = "First name is required";
            }
            else {
                $firstName = test_input($_POST["firstName"]);
                $valid++;
            }
            if (empty($_POST["lastName"])) {
                $lastNameErr = "Last name is reuqired";
            }
            
            if($valid >= 2) {
                $app_state = "processed";
            }
        }
        
        //Sanitize data
        function test_input($data) {
            $data = trim(data);
            $data = stripslashes(data);
            $data = htmlspecialchars(data);
            return $data;
        }
        
        if ($app_state == "empty") {
        ?>
        <h2>Find User</h2>
        <p><span class="error>* required</span></p>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
        First Name: <input type="text" name="firstName" value="<?php echo $firstName; ?>"><span class="error">* <?php echo $fisrtNameErr; ?></span><br><br>
        Last Name: <input type="text" name="lastName" value="<?php echo $lastName; ?>"><span class="error">* <?php echo $lastNameErr; ?></span><br<br>
        <input type="submit">
        </form>
    </body>
</html>
<?php
}
elseif($app_state == "processed") {
    if($firstName == "Vincent") {
        $app_state = "Logged in";
    }
}

if ($app_state == "Logged in") {
    echo("logged in<br> Hello Vincent</body></html>");
}
?>
