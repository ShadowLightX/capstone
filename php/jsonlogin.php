<?php
require_once("/etc/apache2/capstone-mysql/net-neutrality.php");
require_once("phpbblogin.php");

$password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
$username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
$mysqli   = Pointer::getPointer();

if($password === false || $username === false) {
    $phpBbLogin = new PhpBBLogin(false, false, null, null);
    echo $phpBbLogin->toJson();
} else {
    $phpBbLogin = new PhpBBLogin(false, false, $username, null);
    echo $phpBbLogin->jsonLogin($mysqli, $username, $password);
}
?>