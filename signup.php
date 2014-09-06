<?php
$firstName = check_input($_POST['firstName'], "Enter your first name");
$lastName = check_input($_POST['lastName'], "Enter your last name");
$userName = check_input($_POST['userName'], "Enter your user name");
$password = check_input($_POST['password'], "Create your password");
$confirm = check_input($_POST['confirm'], "Confirm your password");
$email = check_input($_POST['email'], "Enter your e-mail");
?>
<html>
    <body>
        <p>Welcome <?php echo $userName; ?></p><br>
    </body>
</html>

<?php
function check_input($data, $problem='') {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    if (problem && strlen($data) == 0) {
        show_error($problem);
    }
    return $data;
}

function show_error($myError) {
}
?>
    <html>
        <body>
            <strong>Please correct the following error:</strong><br>
            <?php echo $myError; ?>
<?php
    exit();
?>
