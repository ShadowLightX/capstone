<?php
    /**
     * class for favorites
     *
     * this is a container for articles favorited by users
     **/
     
    class Favorite {
        // first, start with the member (state) variables - documenting each in a doc block
        /**
         * the user favoriting the article
         **/
        private $userId;
        
        /**
         * the article to be favorited
         **/
        private $articleId;
        
        /**
         * the resource (video, image, link) to be favorited
         **/
        private $resourceId;
        
        /**
         * the bookmark to access the favorited article or resource
         **/
        //private $bookmark;
        
        public function __construct($newUserId, $newArticleId, $newResourceId, /*$newBookmarkId)*/ {
            // use the mutator methods to populate the user
            try {
                $this->setUserId($newUserId);
                $this->setArticleId($newArticleId);
                $this->setResourceId($newResourceId);
                // $this->setBookmark($newBookmark);
            }
            
            catch(UnexpectedValueException $unexpectedValue){
                // rethrow to the caller
                throw(new UnexpectedValueException("Unable to construct bookmark", 0, $unexpectedValue));
            }
                
            catch(RangeException $range) {
                // rethrow to the caller
                throw(new RangeException("Unable to construct bookmark", 0, $range));
            }
        }
        
        /**
         * accessor method for user id
         *
         * @return integer value of user id
         **/
        public function getUserId() {
            return($this->userId);
        }
        
        /**
         * mutator method for user id
         *
         * @param mixed new value of user id or null if a new object
         * @throws UnexpectedValueException if the userId is not an integer
         * @throws RangeException if the userId is not positive
         **/
        public function setUserId($newUserId) {
            // zeroth, allow a null if this is a new object
            if($newUserId === null) {
                $this->userId = null;
                return;
            }
            
            // first, trim the input of excess whitespace
            $newUserId = trim($newUserId);
            
            // second, verify this is an integer
            if((filter_var($newUserId, FILTER_VALIDATE_INT)) === false) {
                throw(new UnexpectedValueException("user id $userId is not an integer"));
            }
            
            // third, convert the id to an integer and ensure it's positive
            $newUserId = intval ($newUserId);
            if($newUserId <= 0) {
                throw(new RangeException("user id $newUserId is not positive"));
            }
            
            // finally, the user id is clean and can be taken out of quarantine
            $this->userId = $newUserId;
        }
        
        /**
         * accessor method for article id
         *
         * @return article id
         **/
        public function getArticleId() {
            return($this->articleId);
        }
        
        /**
         * mutator method for article id
         *
         * @param mixed new value of article id
         * @throws UnexpectedValueException if the article Id is not an integer
         * @throws RangeException if the userId is not positive
         **/
        public function setArticleId($newArticleId) {       
            // first, trim the input of excess whitespace
            $newArticleId = trim($newArticleId);
            
            // second, verify this is an integer
            if((filter_var($newArticleId, FILTER_VALIDATE_INT)) === false) {
                throw(new UnexpectedValueException("Article Id $articleId is not an integer"));
            }
            
            // third, convert the id to an integer and ensure it's positive
            $newArticleId = intval ($newArticleId);
            if($newArticleId <= 0) {
                throw(new RangeException("Article Id $newArticleId is not positive"));
            }
            
            // finally, the article id is clean and can be taken out of quarantine
            $this->articleId = $newArticleId;
        }
        
        /**
         * accessor method for the resource id
         *
         * @return resource id
         **/
        public function getResourceId() {
            return($this->getResourceId);
        }
        
        /**
         * mutator method for resource id
         *
         * @param mixed new value of resource id
         * @throws UnexpectedValueException if the resource Id is not an integer
         * @throws RangeException if the userId is not positive
         **/
        public function setResourceId($newResourceId) {       
            // first, trim the input of excess whitespace
            $newResourceId = trim($newResourceId);
            
            // second, verify this is an integer
            if((filter_var($newResourceId, FILTER_VALIDATE_INT)) === false) {
                throw(new UnexpectedValueException("resource Id $resourceId is not an integer"));
            }
            
            // third, convert the id to an integer and ensure it's positive
            $newResourceId = intval ($newResourceId);
            if($newResourceId <= 0) {
                throw(new RangeException("resource Id $newResourceId is not positive"));
            }
            
            // finally, the resource id is clean and can be taken out of quarantine
            $this->resourceId = $newResourceId;
        }
    }
?>


















