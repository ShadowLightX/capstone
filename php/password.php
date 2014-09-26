<?php
 function setPassword($newPassword) {
        // check if the keys are truly an string
        if(gettype($newPassword) !== "string") {
            throw(new UnexpectedValueException ("Please retype password"));
        }
        
        // sanitize it and forget it
        $newPassword = filter_var ( $newPassword, FILTER_SANITIZE_STRING);
        // this?
        $this->password = $newPassword;
        }
?>