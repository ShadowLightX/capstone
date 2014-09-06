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
$firstNameErr = "";
$lastNameErr = "";
$userNameErr = "";
$passwordErr = "";
$confirmErr = "";
$emailErr = "";

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
        $passwordNameErr = "Password is required";
    } else {
        $password = test_input($_POST["password"]);
    }
    
    if(empty($_POST["confirm"])) {
        $confirmErr = "Confirm password";
    } else {
        $confirm = test_input($_POST["confirm"]);
    }
    
    if(empty($_POST["email"])) {
        $email = "E-mail address required";
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
?>
    </body>
</html>