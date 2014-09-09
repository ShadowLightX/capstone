<?php
// notice the $_POST superglobal is an array!
// expect all the form values to be loaded into the $_POST superglobal automatically
// (e.g., the email form value is in $_POST["email"])

// try the sanitization so we can format errors later on
try {
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
        throw(new Exception("Passwords do not match"));
    }
    
    // passwords are safe & match
    echo "Your password $safePassword is safe with me! <br />";
    
    // this code is VULNERABLE to a cross site scripting attack
    // echo "Your password " . $_POST["password"] . " is safe with me!<br />";
    
    // verify the nap hours are a double
    if(filter_input(INPUT_POST, "napHours", FILTER_VALIDATE_FLOAT) === false) {
        throw(new Exception("Please enter the number of nap hours"));
    }

    // now sanitize the hours and convert them to a double
    $safeNapHours = filter_input(INPUT_POST, "napHours", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $safeNapHours = floatval($safeNapHours);
    
    //nap hours converted
    echo "Have a good nap for the next $safeNapHours hours";
}
// catch the exception and format it as an error message
catch(Exception $error) {
    echo "<span class='badForm'>" . $error->getMessage() . "</span>";
}
?>