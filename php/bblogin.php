<?php
define('IN_PHPBB', true);
$phpbb_root_path = './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
 
// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup();

if($user->data['is_registered'])
{
    //User is already logged in
}
else
{
    $username = request_var('username', '', true);
    $password = request_var('password', '', true);

    $result = $auth->login($username, $password);

    if ($result['status'] == LOGIN_SUCCESS)
    {
        //User was successfully logged into phpBB
    }
    else
    {
        //User's login failed
    }
}
?>