<?php
/**
 * Posts class
 * 
 * This class will handle all posts, it has functions for gathering posts from
 * database like getAll(), getCategory()...
 * 
 * @author Kryptic Destro
 */
class Posts
{
    /**
     * Returns an array containing ALL posts from database
     * 
     * @return array array containing more arrays
     */
    public static function getAll()
    {
        global $Database;
        
        $posts = $Database->get("posts", "ORDER BY date DESC");
        
        return $posts; //That pro code
    }
    
    /**
     * Returns an array containing posts from given categories
     * 
     * The parameter can be an integer (categoryID), a string (category name) or
     * an array that can contain integers (categoryID), strings (category name) or
     * both.
     * 
     * If you give a string make sure there's just one category with that name
     * 
     * @param mixed category explained above
     * 
     * @return array array containing posts from given categories
     */
    public static function getPerCategory($category)
    {
        global $Database;
        
        $posts = array();
        
        //check if category is an array
        if(is_array($category)) {
            foreach($category as $cat) {
                $Category = new Category($cat);
                $posts[]  = $Category->getPosts();
            }
        } else {
            $Category = new Category($category);
            $posts[]  = $Category->getPosts();
        }
        
        return $posts;
    }
}