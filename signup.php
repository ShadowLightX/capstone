<?php
// notice the $_POST superglobal is an array!
// expect all the form values to be loaded into the $_POST superglobal automatically
// (e.g., the email form value is in $_POST["email"])

// define variables and set to empty values
$firstName       = "";
$lastName        = "";
$userName        = "";
$password        = "";
$confirmPassword = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["firstName"])) {
    $firstNameErr = "Name is required";
  } else {
    $firstName = test_input($_POST["firstName"]);
  }

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
    echo "Your password is confirmed. <br />";
    
}
// catch the exception and format it as an error message
catch(Exception $error) {
    echo "<span class='badForm'>" . $error->getMessage() . "</span>";
    }
}
    function test_input($input) {
        return $input;
    }
?>