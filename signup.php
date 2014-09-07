<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
<?php
// define variables and set to empty values
$firstName = "";
$lastName = "";
$userName = "";
$password = "";
$confirm = "";
$email = "";
// define error varialbles
$firstNameErr = "First name is required";
$lastNameErr = "Last name is required";
$userNameErr = "User name is required";
$passwordErr = "Password required";
$confirm_passwordErr = "Password doesn't match";
$emailErr = "Invalid e-mail address";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(empty($_POST["firstName"])) {
        $firstNameErr = "First name is required";
    } else {
        $firstName = test_input($_POST["firstName"]);
    }
    
    if(empty($_POST["lastName"])) {
        $lastNameErr = "Last name is required";
    } else {
        $lastName = test_input($_POST["lastName"]);
    }
    
    if(empty($_POST["userName"])) {
        $userNameErr = "User name is required";
    } else {
        $userName = test_input($_POST["userName"]);
    }
    
    if(empty($_POST["password"])) {
        $passwordNameErr = "Password required";
    } else {
        $password = test_input($_POST["password"]);
    }
    
    if(empty($_POST["confirm_password"])) {
        $confirm_passwordErr = "Password doesn't match";
    } else {
        $confirm = test_input($_POST["confirm"]);
    }
    
    if($_POST["password"] == $_POST["confirm_password"]) {
        // success!
    } else {
        echo $confirm_passwordErr;
    }
    
    if(empty($_POST["email"])) {
        $email = "Invalid e-mail address";
    } else {
        $email = test_input($_POST["email"]);
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

echo $data;

?>
    </body>
</html>