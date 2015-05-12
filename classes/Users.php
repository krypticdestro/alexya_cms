<?php
/**
 * Users class
 * 
 * This class will handle all users, it has functions for gathering users from
 * database like getAll(), get()...
 * 
 * @author Kryptic Destro
 */
class Users
{
    /**
     * Returns an array containing ALL users from database
     * 
     * @return array array containing more arrays
     */
    public static function getAll()
    {
        global $Database;
        
        $users = $Database->select("users", "*");
        return array_reverse($users);
    }
    
    /**
     * Returns an array containing $amount users from database
     * 
     * @param int amount amount of users to return
     * 
     * @return array array containing more arrays
     */
    public static function get($amount)
    {
        global $Database;
        
        $amount = Security::sanitize($amount);
        
        $users = $Database->query("SELECT * FROM `users` LIMIT ". $amount);
        if(is_object($users)) {
            return array_reverse($users->fetchAll());
        }
        
        return false;
    }
}