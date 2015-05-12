<?php
/**
 * Post Model
 * 
 * Will represent a post from the database, it will also contain functions
 * to get the comments from the post
 * 
 * @author Kryptic Destro
 */
class Post
{
    /**
     * Array comments
     * 
     * Contains all comments from the post
     */
    private $comments;
    
    /**
     * Array data
     * 
     * Contains database's data
     */
    public $data = null;
    
    /**
     * Constructor
     * 
     * Loads all comments from the post
     * 
     * @param mixed identifier post identifier, can be permalink or postID
     */
    public function __construct($identifier)
    {
        global $Database;
        
        if(is_numeric($identifier)) {
            $data = $Database->get("posts", "*", [
                                    "postID" => $identifier
                                ]
                            );
            
            if(is_array($data)) {
                $this->data = $data;
                $this->setComments();
            } else {
                Results::addFlash(array(
                            "result"  => "error",
                            "message" => "Couldn't find post with ID $identifier!"
                        ));
            }
        } else {
            $perma = Security::sanitize($identifier);
            
            $data = $Database->get("posts", "*", [
                                    "permalink" => $perma
                                ]
                            );
            if(count($data) == 1) {
                $this->data = $data;
                $this->setComments();
            } else {
                Results::addFlash(array(
                            "result"  => "error",
                            "message" => "Couldn't find post with ID $identifier!"
                        ));
            }
        }
    }
    
    /**
     * Sets all comments from post
     * 
     * Adds all comments from this post to the array
     */
    public function setComments()
    {
        global $Database;
        
        if($this->data == null) {
            return array();
        }
        
        $comments = $Database->select("comments", "*", [
                                        "postID" => $this->data["postID"]
                                    ]
                                );
                                
        //To get the comments ordered by date
        $this->comments = array_reverse($comments);
    }
    
    /**
     * Returns an array with post's comments
     * 
     * @param int offset
     * @param int max
     * @return array array containing post's comments
     */
    public function getComments($offset = -1, $max = -1)
    {
        if($offset < 0 && $max < 0) {
            return $this->posts;
        }
        
        // From now over:
        // I don't know the fuck what I'm doing, but it should be big enough
        $comments = array();
        $i = $offset + $max;
        
        for($j = 0; $j < $i; $j++) {
            if($offset > 0) {
                $offset--;
                continue;
            }
            
            $comments[] = $this->comments[$j];
            
            if((count($comments) >= $max) &&
               ($max > 0)) {
                break;
            }
        }
        
        return $comments;
    }
}