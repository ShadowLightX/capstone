<?php
// notice the $_POST superglobal is an array!
// expect all the form values to be loaded into the $_POST superglobal automatically
// (e.g., the email form value is in $_POST["email"])

// define variables and set to empty values
$firstName       = ($_POST['firstName']);
$lastName        = ($_POST['lastName']);
$userName        = "";
$password        = "";
$confirmPassword = "";
// try the sanitization so we can format errors later on
try {
    if(empty($_POST["firstName"])) {
        throw(new Exception("Please enter your first name"));
    } else {
        (filter_var($firstName, FILTER_SANITIZE_STRING) !== $firstName);        
    }
    // filter firstName for bad stuff
    //if(filter_var($firstName, FILTER_SANITIZE_STRING) !== $firstName) {
        //throw(new Exception("Please enter your first name"));
    if(empty($_POST["lastName"])) {
        throw(new Exception("Please enter your last name"));
    } else {
        (filter_var($lastName, FILTER_SANITIZE_STRING) !== $lastName);        
    }
    
    // if the Email has no @ character, throw an exception
    if(filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL) === false) {
        throw(new Exception("Please enter your Email address"));
    }
    
    // if filter_input passed the Email, we can use it
    $safeEmail = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);

    // email is safe
    echo $safeEmail . " just signed up.<br />";
    
    // sanitize both passwords
    $safePassword = filter_input(INPUT_POST, "password",       FILTER_SANITIZE_SPECIAL_CHARS);
    $safeConfirm = filter_input(INPUT_POST, "confirmPassword", FILTER_SANITIZE_SPECIAL_CHARS);
    
    
    // ensure the passwords match
    if($safePassword !== $safeConfirm) {
        throw(new Exception("Please match passwords"));
    }
    
    // passwords are safe & match
    echo "Your password is confirmed. <br />";
    

// catch the exception and format it as an error message
} catch (Exception $error) {
    echo "<span class='badForm'>" . $error->getMessage() . "</span>";
}
?>