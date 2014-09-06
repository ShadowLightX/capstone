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
    $firstName = test_input($_POST['firstName'],"Please enter your first name");
    echo $firstName;
    $lastName = test_input($_POST['lastName'],"Please enter your last name");
    echo $lastName;
    $userName = test_input($_POST['userName'],"Please enter your user name");
    echo $userName;
    $password = test_input($_POST['password'],"Please create your password");
    echo $password;
    $confirm = test_input($_POST['firstName'],"Please confirm your password");
    echo $confirm;
    $email = test_input($_POST['email'],"Please enter your e-mail");
    echo $email;
}

function test_input($data, $problem='') {
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    if ($problem && strlen($data) == 0) {
        show_error($problem);
    }
    return $data;
}
?>
    </body>
</html>