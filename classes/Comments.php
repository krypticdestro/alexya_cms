<?php
/**
 * Comments class
 * 
 * This class will handle all comments, it has functions for gathering comments
 * from database like getAll(), getPost()...
 * 
 * @author Kryptic Destro
 */
class Comments
{
    /**
     * Returns an array containing ALL comments from database
     * 
     * @return array array containing more arrays
     */
    public static function getAll()
    {
        global $Database;
        
        $comments = $Database->select("comments", "*");
        return array_reverse($comments);
    }
    
    /**
     * Returns an array containing comments from given categories
     * 
     * The parameter can be an integer (postID), a string (post permalink) or
     * an array that can contain integers (postID), strings (post permalink) or
     * both.
     * 
     * If you give a string make sure there's just one post with that permalink
     * 
     * @param mixed post explained above
     * 
     * @return array array containing comments from given posts
     */
    public static function getPost($post)
    {
        $comments = array();
        
        //check if category is an array
        if(is_array($post)) {
            foreach($post as $p) {
                $Post = new Post($p);
                $comments[]  = $Post->getComments();
            }
        } else {
            $Post = new Post($post);
            $comments[]  = $Post->getComments();
        }
        
        return $comments;
    }
}