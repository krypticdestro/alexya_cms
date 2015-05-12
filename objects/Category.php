<?php
/**
 * Category Model
 * 
 * Will represent a category from the database, it will also contain functions
 * to get the posts from the category
 * 
 * @author Kryptic Destro
 */
class Category
{
    /**
     * Array posts
     * 
     * Contains all posts from the category
     */
    private $posts;
    
    /**
     * Array data
     * 
     * Contains database's data
     */
    public $data = null;
    
    /**
     * Constructor
     * 
     * Loads all posts from the category
     * 
     * @param mixed identifier category identifier, can be permalink or categoryID
     */
    public function __construct($identifier)
    {
        global $Database;
        if(is_numeric($identifier)) {
            $data = $Database->get("categories", "*", [
                                    "categoryID" => $identifier
                                ]
                            );
            if(is_array($data)) {
                $this->data = $data;
                $this->setPosts();
            } else {
                Results::addFlash(array(
                            "result"  => "danger",
                            "message" => "Couldn't find category with ID $identifier!"
                        ));
            }
        } else {
            $data = $Database->get("categories", "*", [
                                    "permalink" => $identifier
                                ]
                            );
            if(is_array($data)) {
                $this->data = $data;
                $this->setPosts();
            } else {
                Results::addFlash(array(
                            "result"  => "danger",
                            "message" => "Couldn't find category with ID $identifier!"
                        ));
            }
        }
    }
    
    /**
     * Sets all posts from category
     * 
     * Adds all posts from this category to the array
     */
    public function setPosts()
    {
        global $Database;
        
        if($this->data == null) {
            return array();
        }
        
        $posts = json_decode($this->data["posts"]);
        $p = array();
        
        foreach($posts as $postID) {
            if(is_numeric($postID)) {
                $post = $Database->get("posts", "*", [
                                        "postID" => $postID
                                    ]
                                );
                
                if(is_array($post)) {
                    $p[] = $post;
                }
            } else if(is_string($postID)) {
                $post = $Database->get("posts", "*", [
                                        "permalink" => $postID
                                    ]
                                );
                
                if(count($post) == 1) {
                    $p[] = $post;
                }
            }
        }
        
        //To get the posts ordered by date
        $this->posts = array_reverse($p);
    }
    
    /**
     * Returns an array with category's posts
     * 
     * @param int offset
     * @param int max
     * @return array array containing category's posts
     */
    public function getPosts($offset = -1, $max = -1)
    {
        if($offset < 0 && $max < 0) {
            return $this->posts;
        }
        
        // From now over:
        // I don't know the fuck what I'm doing, but it should be big enough
        $posts = array();
        $i = $offset + $max;
        
        for($j = 0; $j < $i; $j++) {
            if($offset > 0) {
                $offset--;
                continue;
            }
            
            $posts[] = $this->posts[$j];
            
            if((count($posts) >= $max) &&
               ($max > 0)) {
                break;
            }
        }
        
        return $posts;
    }
}