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
    $lastName = $_REQUEST["lastName"];
    echo $lastName;
    $userName = $_REQUEST["userName"];
    echo $userName;
    $password = $_REQUEST["password"];
    echo $password;
    $confirm = $_REQUEST["confirm"];
    echo $confirm;
    $email = $_REQUEST["email"];
    echo $email;
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