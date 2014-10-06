<?php
define('IN_PHPBB', true);
$phpbb_root_path = 'Forum/';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include('common.php');

$user->session_begin();
$auth->acl($user->data);
$user->setup();

if($user->data['is_registered'])
{
    echo "Du bist schon eingeloggt!";
}
else
{  
    if(!isset($_POST['loginbutton'])) {
    echo '<form action = "testlogin2.php" method="POST">
        <input type="text" name="user">
        <input type="password" name="password">
        <input type="submit" name="loginbutton">
        </form>';
    } else {
        $username = request_var($_POST['user'], '', true);
        $password = request_var($_POST['password'], '', true);

        $result = $auth->login($username, $password);

        if ($result['status'] == LOGIN_SUCCESS)
        {
            echo "Sucessfull";
        }
        else
        {
            echo "Wrong Username/Password";
        }
    }
}