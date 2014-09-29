<?php
/**
 * Resource class handles resource links and resource types
**/
class Resource {
    /**
     * Auto generated by mySQL and can be null at creation
    **/
    private $resourceId;
    
    /**
     * Auto generated by mySQL and can be null at creation
    **/
    private $userId;
    
    /**
     * String, the URL of the link 
    **/
    private $resourceLink;
    
    /**
     * String title of the link, video or audio 
    **/
    private $resourceTitle;
    
    /**
     *constructor for resource
     *
     *@param Int for the resource id
     *@param Int for the admin id
     *@param string The URL the came from
     *@param string Title of the resource
     *@throws UnexceptedValueException if inputs are of the incorrect types or urls
     *@throws RangesException if the inputs contain invalid values
     **/
    public function __construct($resourceId, $userId, $resourceLink, $resourceTitle) {
        try{
            $this ->resourceId($newResourceId);
            $this ->userId($newUserId);
            $this ->resourceLink($newResourceLink);
            $this ->resourceTitle($newResourceTitle);
        } catch(UnexpectedValueException $unexpectedValue) {
            // rethrow to caller
            throw(UnexpectedValueException("Unable to construct resource", 0, $unexpectedValue));  
        } catch(RangeException $range) {
            // rethrow to caller
            throw(new RangeException("Unable to construct resource", 0, $range));
        }
    }
    
    /**
     * Accessor method for resource id
     *
     * @return integer value of resource id
     *
    **/
     public function getResourceId() {
        
    }
    /**
     * Mutator method for resource id
     *
     * @param mixed new value of a resource id or null if a new object
     * @throws UnexpectedValueException if input is not an integer
     * @throws a RangeException if resource id isn't positive 
    **/
    public function setResourceId($newResourceId) {
        // zeroth, allow null if this is a new object
        if($newResourceId === null) {
            $this->resourceId = null;
            return;
    }
    
    // first, trim the input
    $newResourceId = trim($newResourceId);
    
    // second, check if resource id is an integer
    if((filter_var($newResourceId, FILTER_VALIDATE_INT)) === false) {
        throw(UnexpectedValueException("resource id $newResourceId is not a number"));
    }
    
    // third, convert resource id to an integer and ensure it's positive
    $newResourceId = intval($newResourceId);
    if($resourceId<= 0) {
        throw(new RangeException("resource id $resourceId must be a positive number"));
    }
    
    // finally, the resource id is clean and can be taken out of quarantine
    $this->resourceId = $newResourceId;
}
    
    /**
     * Accessor method for user id
     *
     * @return integer value of user id
    **/
    public function getUserId() {
        
    }
    
    /**
     * Mutator method for user id
     *
     * @param mixed value of user id or allow to be null if it's a new object
     * @throws UnexpectedValueException if user id is not an integer
     * @throws RangeException if user id isn't positive
    **/
    public function setUserId($newUserId) {
        // zeroth, allow null if this is a new object
        if($newUserId === null) {
            $this->userId = null;
            return;
        }
        
        // first, trim the input
        $newUserId = trim($newUserId);
        
        // second, check if the user id is an integer
        if((filter_var($newUserId, FILTER_VALIDATE_INT)) === false) {
            throw(new UnexpectedValueException("user id $newUserId is not an integer"));   
        }
        
        // third, convert user id and ensure it's positive
        $newUserId = intval($newUserId);
        if($newUserId <= 0) {
            throw(new RangeException("user id $newUserId must be a positive integer"));
        }
        
        // finally, user id is clean and can be removed from quarantine
        $this->userId = $newUserId;
    }
    
    /**
     * Accessor method for resource link
     *
     * @return string of resource link URL
    **/
    public function getResourceLink() {
        
    }
    
    /**
     * Mutator method for resource link URL
     *
     * @param string URL of the resource link
     * @throws UnexpectedValueException if the URL is not a string, not a valid URL, or http or https link
    **/
    public function setResourceLink($newResourceLink) {
        if(gettype($newResourceLink) !== "string") {
            throw(new UnexpectedValueException("Please use a URL string of the resource link"));
        }
        
        //check that string is a valid URL
        if(filter_var($newResourceLink, FILTER_VALIDATE_URL) === false) {
            throw(new UnexpectedValueException("Please use a valid URL link"));   
        }
        
        $splitResourceLink = explode ("://", $newResourceLink);
        if(strtolower($splitResourceLink[0]) !== "http" || strtolower($splitResourceLink[0]) !== "https") {
            throw(new UnexpectedValueException("Please use only Http and Https"));    
        }
        
        $splitResourceLink[1] = filter_var($splitResourceLink[1], FILTER_SANITIZE_STRING);
        
        $this->resourceLink = implode("://", $splitResourceLink);
    }
    
    /**
     * Accessor method for resource title
     *
     * Retrieve the resource title
     * @return string name of resource
    **/
    public function getResourceTitle() {
        
    }
    
    /**
     * Mutator method for resource title
     *
     * @param string name of the resource
     * @throws UnexpectedValueException if value is not a string
     * @throws Range Exception if value is empty or more than 75 characters
    **/
    public function setResourceTitle($newResourceTitle) {
        // verify that resource title is a string
        if(gettype($newResourceTitle) !== "string") {
            throw(new UnexpectedValueException("Please enter the title of the resouce $newResourceTitle"));
        }
        
        // trim and filter resource title as a generic string
        $newResourceTitle = trim($newResourceTitle);
        $newResourceTitle = filter_var($newResourceTitle, FILTER_SANITIZE_STRING);
        
        if(strlen($newResourceTitle) < 0 || strlen($newResourceTitle) > 70) {
            throw(new RangeException("The title $newResourceTitle is either not set or too long"));   
        }
        
        $this->resourceTitle = $newResourceTitle;
        }
        
    /**
     * inserts this Resource to mySQL
     *
     * @param resource $mysqli pointer to mySQL connection, by reference
     * @throws mysqli_sql_exception when mySQL related errors occur
     **/
    public function insert(&$mysqli) {
        // handle degenerate cases
        if(gettype($mysqli) !== "object" || get_class($mysqli) !== "mysqli") {
            throw(new mysqli_sql_exception("input is not a mysqli object"));
        }
        
        // enforce the resoureId is null (i.e., don't insert a resource that already exists)
        if($this->resourceId !== null) {
            throw(new mysqli_sql_exception("not a new resource"));
        }
        
        // create query template
        $query     = "INSERT INTO resource(userId, resourceLink, resourceTitle) VALUES(?, ?, ?)";
        $statement = $mysqli->prepare($query);
        if($statement === false) {
            throw(new mysqli_sql_exception("Unable to prepare statement"));
        }
        
        // bind the member variables to the place holders in the template
        $wasClean = $statement->bind_param("iss", $this->userId, $this->resourceLink, resourceTitle);
        if($wasClean === false) {
            throw(new mysqli_sql_exception("Unable to bind parameters"));
        }
        
        // execute the statement
        if($statement->execute() === false) {
            throw(new mysqli_sql_exception("Unable to execute mySQL statement"));
        }
        
        // update the null resourceId with what mySQL just gave us
        $this->resourceId = $mysqli->insert_id;
    }
    
    /**
     * deletes this Resource from mySQL
     *
     * @param resource $mysqli pointer to mySQL connection, by reference
     * @throws mysqli_sql_exception when mySQL related errors occur
     **/
    public function delete(&$mysqli) {
        // handle degenerate cases
        if(gettype($mysqli) !== "object" || get_class($mysqli) !== "mysqli") {
            throw(new mysqli_sql_exception("input is not a mysqli object"));
        }
        
        // enforce the resourceId is not null (i.e., don't delete a resource that hasn't been inserted)
        if($this->resourceId === null) {
            throw(new mysqli_sql_exception("Unable to delete a resource that does not exist"));
        }
        
        // create query template
        $query     = "DELETE FROM resource WHERE resourceId = ?";
        $statement = $mysqli->prepare($query);
        if($statement === false) {
            throw(new mysqli_sql_exception("Unable to prepare statement"));
        }
        
        // bind the member variables to the place holder in the template
        $wasClean = $statement->bind_param("i", $this->resourceId);
        if($wasClean === false) {
            throw(new mysqli_sql_exception("Unable to bind parameters"));
        }
        
        // execute the statement
        if($statement->execute() === false) {
            throw(new mysqli_sql_exception("Unable to execute mySQL statement"));
        }
    }
    
    /**
     * updates this Resource in mySQL
     *
     * @param resource $mysqli pointer to mySQL connection, by reference
     * @throws mysqli_sql_exception when mySQL related errors occur
     **/
    public function update(&$mysqli) {
        // handle degenerate cases
        if(gettype($mysqli) !== "object" || get_class($mysqli) !== "mysqli") {
            throw(new mysqli_sql_exception("input is not a mysqli object"));
        }
        
        // enforce the resourceId is not null (i.e., don't update a resource that hasn't been inserted)
        if($this->resourceId === null) {
            throw(new mysqli_sql_exception("Unable to update a resource that does not exist"));
        }
        
        // create query template
        $query     = "UPDATE resource SET userId = ?, resourceLink = ?, resourceTitle = ? WHERE resourceId = ?";
        $statement = $mysqli->prepare($query);
        if($statement === false) {
            throw(new mysqli_sql_exception("Unable to prepare statement"));
        }
        
        // bind the member variables to the place holders in the template
        $wasClean = $statement->bind_param("iss", $this->userId, $this->resourceLink, $this->resourceTitle);
                                                    
        if($wasClean === false) {
            throw(new mysqli_sql_exception("Unable to bind parameters"));
        }
        
        // execute the statement
        if($statement->execute() === false) {
            throw(new mysqli_sql_exception("Unable to execute mySQL statement"));
        }
    }
    
    }
?>