<?php
    /**
     * class for favorites
     *
     * this is a container for articles favorited by users
     **/
    
    class FavoriteS {
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
        private $bookmark;
        
        public function __construct($newUserId, $newArticleId, $newResourceId, $newBookmarkId) {
            // use the mutator methods to populate the user
            try {
                $this->setUserId($newUserId);
                $this->setArticleId($newArticleId);
                $this->setResourceId($newResourceId);
                $this->setBookmark($newBookmark);
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
         *accessor method for user id
         *
         * @return integer value of user id
         **/
        public function getUserId() {
            return($this->userId);
        }
        
        
    }
?>


















