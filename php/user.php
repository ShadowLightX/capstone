<?php
/**
 *class representing a users in Net-Neutrality website
 *
 *this is a container for user information
 *
 *@author Charlie Goodan <cgoodan@gmail.com>
 **/
class User {
    //first, start with the member (state) variables - documenting each in a block
    /**
     *integer of user ID
     **/
    private $userId;
    
    /**
     *string of roles
     **/ 
    private $role;
    
    /**
     *string of first names
     **/
    private $firstName;
    
    /**
     *string of last names
     **/
    private $lastName;
    
    /**
     *string of email addresses
     **/
    private $email;
    
    /**
     *constructor for user information
     *
     *@param mixed user ID
     *@param integer role
     *@param string first names
     *@param string last names
     *@param string email
     **/
    public function __construct($newUserId, $newRole, $newFirstName, $newLastName, $newEmail) {
        try{
            //use our mutator methods to sanitize inputs
            $this->setUserId($newUserId);
            $this->setRole($newRole);
            $this->setFirstName($newFirstName); 
            $this->setLastName($newLastName);
            $this->setEmail($newEmail);
        } catch(UnexpectedValueException $unexpectedValue) {
            //rethrow to the caller
            throw(new UnexpectedValueException("unable to construct user", "0", $unexpectedValue));
        } catch(RangeException $range) {
            //rethrow to the caller
            throw(new RangeException("Unable to construct user", 0, $range));
        }
    }
    
    /**
     *accessor method for user ID
     *
     *@return integer value of user ID
     **/
    public function getUserId() {
        return($this->userId);
    }
    
    /**
     *mutator method for user ID
     *
     *@param mixed new value of user id or null if a new object
     *@throws UnexpectedValueException if the user ID is not an integer
     *@throws RangeException if the user ID is not positive
     **/
    public function setUserId($newUserId) {
        //zeroth, allow a null if this is a new object
        if($newUserId === null) {
            $this->userId = null;
            return;
        }
        
        //first, trim the input of excess whitespace
        $newUserId = trim($newUserId);
        
        //second, verify this is an integer
        if((filter_var($newUserId, FILTER_VALIDATE_INT)) === false) {
            throw(new UnexpectedValueException("user id $newUserId is not an integer"));
        }
        
        //third, convert the id to an integer and ensure it's positive
        $newUserId = intval($newUserId);
        if($newUserId <= 0) {
            throw(new RangeException("user id $newUserId is not positive"));
        }
        
        //finally, the user id is clean and can be taken out of quarantine
        $this->userId = $newUserId;
    }
  
    /**
     *accessor method for role
     *
     *@return integer value of role
     **/
    public function getRole() {
        return($this->role);
    }
    
    /**
     *mutator method for role
     *
     *@param integer new value of role
     *@throws UnexpectedValueException if the role is not an integer
     *@throws RangeException if the role is not {0,1,2}
     **/
    public function setRole($newRole) {
        //first, trim the input of excess whitespace
        $newRole = trim($newRole);
        
        //second, verify this is an integer
        if((filter_var($newRole, FILTER_VALIDATE_INT)) === false) {
            throw(new UnexpectedValueException("role $newRole is not an integer"));
        }
        
        //third, convert the role to an integer and ensure it's positive
        $newRole = intval($newRole);
        if($newRole < 0 || $newRole >2) {
            throw(new RangeException("role $newRole is not 0, 1, or 2"));
        }
        
        //finally, the role is clean and can be taken out of quarantine
        $this->role = $newRole;
    }
    
    /**
     *gets the first name of the user
     *
     *@return string of first name
     **/
    public function getFirstName() {
        return($this->firstName);
    }
    
    /**
     *sets the first name of the user
     *
     *@param string of first name
     **/
    public function setFirstName($newFirstName) {
        //sanitize the string
        $newFirstName = filter_var($newFirstName, FILTER_SANITIZE_STRING);
        
        //if the string got here, it's passed all our tests - assign it!
        $this->firstName = $newFirstName;
    }
    
    /**
     *gets the last name of the user
     *
     *@return string of last name
     **/
    public function getLastName() {
        return($this->lastName);
    }
    
    /**
     *sets the last name of the user
     *
     *@param string of last name
     **/
    public function setLastName($newLastName) {
        //sanitize the string
        $newLastName = filter_var($newLastName, FILTER_SANITIZE_STRING);
        
        //if the string got here, it's passed all our tests - assign it!
        $this->lastName = $newLastName;
    }
    
    /**
     *accessor method for email
     *
     *@return string value of email
     **/
    public function getEmail() {
        return($this->email);
    }
    
    /**
     *mutator method for email
     *
     *@param string new value of email
     **/
    public function setEmail($newEmail) {
        //first, trim the input of excess whitespace
        $newEmail = trim($newEmail);
        
        //second, sanitize the email of all invalid email characters
        $newEmail = filter_var($newEmail, FILTER_SANITIZE_EMAIL);
        
        //finally, bring the email out of quarantine
        $this->email = $newEmail;
    }
    
    /**
     * inserts this User to mySQL
     *
     * @param user $mysqli pointer to mySQL connection, by reference
     * @throws mysqli_sql_exception when mySQL related errors occur
     **/
    public function insert(&$mysqli) {
        // handle degenerate cases
        if(gettype($mysqli) !== "object" || get_class($mysqli) !== "mysqli") {
            throw(new mysqli_sql_exception("input is not a mysqli object"));
        }
        
        // enforce the resoureId is null (i.e., don't insert a user that already exists)
        if($this->userId !== null) {
            throw(new mysqli_sql_exception("not a new user"));
        }
        
        // create query template
        $query     = "INSERT INTO user(userId, email, firstName, lastName, role) VALUES(?, ?, ?, ?, ?)";
        $statement = $mysqli->prepare($query);
        if($statement === false) {
            throw(new mysqli_sql_exception("Unable to prepare statement"));
        }
        
        // bind the member variables to the place holders in the template
        $wasClean = $statement->bind_param("isssi", $this->userId, $this->email, $this->firstName, $this->lastName, $this->role);
        if($wasClean === false) {
            throw(new mysqli_sql_exception("Unable to bind parameters"));
        }
        
        // execute the statement
        if($statement->execute() === false) {
            throw(new mysqli_sql_exception("could not execute the statement"));
        }
        
        // update the null userId with what mySQL just gave us
        $this->userId = $mysqli->insert_id;
    }
    
    /**
     * deletes this User from mySQL
     *
     * @param user $mysqli pointer to mySQL connection, by reference
     * @throws mysqli_sql_exception when mySQL related errors occur
     **/
    public function delete(&$mysqli) {
        // handle degenerate cases
        if(gettype($mysqli) !== "object" || get_class($mysqli) !== "mysqli") {
            throw(new mysqli_sql_exception("input is not a mysqli object"));
        }
        
        // enforce the userId is not null (i.e., don't delete a user that hasn't been inserted)
        if($this->userId === null) {
            throw(new mysqli_sql_exception("Unable to delete a user that does not exist"));
        }
        
        // create query template
        $query     = "DELETE FROM user WHERE userId = ?";
        $statement = $mysqli->prepare($query);
        if($statement === false) {
            throw(new mysqli_sql_exception("Unable to prepare statement"));
        }
        
        // bind the member variables to the place holder in the template
        $wasClean = $statement->bind_param("i", $this->userId);
        if($wasClean === false) {
            throw(new mysqli_sql_exception("Unable to bind parameters"));
        }
        
        // execute the statement
        if($statement->execute() === false) {
            throw(new mysqli_sql_exception("Unable to execute mySQL statement"));
        }
    }
    
    /**
     * updates this User in mySQL
     *
     * @param user $mysqli pointer to mySQL connection, by reference
     * @throws mysqli_sql_exception when mySQL related errors occur
     **/
    public function update(&$mysqli) {
        // handle degenerate cases
        if(gettype($mysqli) !== "object" || get_class($mysqli) !== "mysqli") {
            throw(new mysqli_sql_exception("input is not a mysqli object"));
        }
        
        // enforce the userId is not null (i.e., don't update a user that hasn't been inserted)
        if($this->userId === null) {
            throw(new mysqli_sql_exception("Unable to update a user that does not exist"));
        }
        
        // create query template
        $query     = "UPDATE user SET email = ?, firstName = ?, lastName = ?, role = ? WHERE userId = ?";
        $statement = $mysqli->prepare($query);
        if($statement === false) {
            throw(new mysqli_sql_exception("Unable to prepare statement"));
        }
        
        // bind the member variables to the place holders in the template
        $wasClean = $statement->bind_param("sssii", $this->email, $this->firstName, $this->lastName, $this->role, $this->userId);
                                                    
        if($wasClean === false) {
            throw(new mysqli_sql_exception("Unable to bind parameters"));
        }
        
        // execute the statement
        if($statement->execute() === false) {
            throw(new mysqli_sql_exception("Unable to execute mySQL statement"));
        }
    }
    public static function getUserByUserId(&$mysqli, $userId) {
        // handle degenerate cases
        if(gettype($mysqli) !== "object" || get_class($mysqli) !== "mysqli") {
            throw(new mysqli_sql_exception("input is not a mysqli object"));
        }
        
        // sanitize the Email before searching
        $userId = trim($userId);
        $userId = filter_var($userId, FILTER_SANITIZE_NUMBER_INT);
        
        // create query template
        $query     = "SELECT userId, email, firstName, lastName, role FROM user WHERE userId = ?";
        $statement = $mysqli->prepare($query);
        if($statement === false) {
            throw(new mysqli_sql_exception("Unable to prepare statement"));
        }
        
        // bind the email to the place holder in the template
        $wasClean = $statement->bind_param("i", $userId);
        if($wasClean === false) {
            throw(new mysqli_sql_exception("Unable to bind parameters"));
        }
        
        // execute the statement
        if($statement->execute() === false) {
            throw(new mysqli_sql_exception("Unable to execute mySQL statement"));
        }
        
        // get result from the SELECT query *pounds fists*
        $result = $statement->get_result();
        if($result === false) {
            throw(new mysqli_sql_exception("Unable to get result set"));
        }
        
        // since this is a unique field, this will only return 0 or 1 results. So...
        // 1) if there's a result, we can make it into a User object normally
        // 2) if there's no result, we can just return null
        $row = $result->fetch_assoc(); // fetch_assoc() returns a row as an associative array
        
        // convert the associative array to a User
        if($row !== null) {
            try {
                $user = new User($row["userId"], $row["role"], $row["firstName"], $row["lastName"], $row["email"]);
            }
            catch(Exception $exception) {
                // if the row couldn't be converted, rethrow it
                throw(new mysqli_sql_exception("Unable to convert row to user: $exception", 0, $exception));
            }
            
            // if we got here, the User is good - return it
            return($user);
        } else {
            // 404 User not found - return null instead
            return(null);
        }
    }
    
    /*
     *gets a user by email provided
     *
     *@param resource $mysqli pointer to the mysqli database connection
     *@param string $newEmail The email that you are looking for
     */
    public static function getUserByEmail(&$mysqli, $newEmail) {
        // handle degenerate cases
        if(gettype($mysqli) !== "object" || get_class($mysqli) !== "mysqli") {
            throw(new mysqli_sql_exception("input is not a mysqli object"));
        }
        
        // sanitize the Email before searching
        $userId = trim($newEmail);
        $userId = filter_var($userId, FILTER_SANITIZE_EMAIL);
        
        // create query template
        $query     = "SELECT userId, email, firstName, lastName, role FROM user WHERE email = ?";
        $statement = $mysqli->prepare($query);
        if($statement === false) {
            throw(new mysqli_sql_exception("Unable to prepare statement"));
        }
        
        // bind the email to the place holder in the template
        $wasClean = $statement->bind_param("s", $newEmail);
        if($wasClean === false) {
            throw(new mysqli_sql_exception("Unable to bind parameters"));
        }
        
        // execute the statement
        if($statement->execute() === false) {
            throw(new mysqli_sql_exception("Unable to execute mySQL statement"));
        }
        
        // get result from the SELECT query *pounds fists*
        $result = $statement->get_result();
        if($result === false) {
            throw(new mysqli_sql_exception("Unable to get result set"));
        }
        
        // since this is a unique field, this will only return 0 or 1 results. So...
        // 1) if there's a result, we can make it into a User object normally
        // 2) if there's no result, we can just return null
        $row = $result->fetch_assoc(); // fetch_assoc() returns a row as an associative array
        
        // convert the associative array to a User
        if($row !== null) {
            try {
                $user = new User($row["userId"], $row["role"], $row["firstName"], $row["lastName"], $row["email"]);
            }
            catch(Exception $exception) {
                // if the row couldn't be converted, rethrow it
                throw(new mysqli_sql_exception("Unable to convert row to user: $exception", 0, $exception));
            }
            
            // if we got here, the User is good - return it
            return($user);
        } else {
            // 404 User not found - return null instead
            return(null);
        }
    }
}
?>