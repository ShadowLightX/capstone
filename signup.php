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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_REQUEST["firstName"];
    echo $firstName;
    /*$lastName = test_input($POST["lastName"]);
    echo $lastName;
    $userName = test_input($POST["userName"]);
    echo $userName;
    $password = test_input($POST["password"]);
    echo $password;
    $confirm = test_input($POST["confirm"]);
    echo $confirm;
    $email = test_input($POST["email"]);
    echo $email;*/
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