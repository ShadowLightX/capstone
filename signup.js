$(document).ready(
    function() {
    $("#signUpForm").validate({
        //DEBUG MORE: stop the form submission...
        // ...delete is after debugging
        
         // debug: true,
         // errorclass: formatting of messages
         errorClass: "badForm",
         
        // rules define how fields should be sanitized
        rules: {
            email: {
                email: true,
                required: true
                },
            password: {
                minlength: 8
                },
                confirmPassword: {
                    equalTo: "#password"
                },
                napHours: {
                    // setting up a min enforces numeric (integer, double) types
                    min: 0,
                    required: true
                }
            },
            
            // messages define what we tell the user
            messages: {
                email: {
                    // email is the message they get for input that's invalid
                      email: "please enter a valid Email",
                     // required is the message they get for omitting the Email
                      required: "Please enter anything at all"
                },
                  // it is not necessary to expand when there's only one rule
                  password: {
                    minlength: "Please enter a password of at least 8 characters",
                    required: "Please enter a password",
                },
                  confirmPassword: "Passwords do not match",
                  napHours: {
                    min: "Please enter 0 or more hours",
                    required : "Please enter the number of nap hours"
                }
            },
            
            // setup the AJAX call
            submitHandler: function(form) {
                $(form).ajaxSubmit({
                    // How do we send this data? GET or POST
                    type: "POST",
                    // URL to submit to
                    // SECURITY WARNING: browsers don't allow you to submit to
                    // an external server - you can only load from your own
                    url: "signup.php",
                    // data to submit
                    data: $(form).serialize(),
                    // anonymous callback function to react to a successful query
                    success: function(ajaxOutput) {
                        // html() is jQuery's .innerHTML
                        $("#outputArea").html(ajaxOutput);
                    }
                    
                });
            }
        });
    }
    
);