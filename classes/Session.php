<?php
/**
 * Session Class
 * 
 * This class will handle Alexya's sessions, meaning that it will contain login,
 * register, recoverPassowrd and that kind of shitty functions, you know right?
 * 
 * @author Kryptic Destro
 */
class Session
{
	/**
     * Performs a login attempt
     * 
     * Will try to perform a login attempt with the given username and password
     * if the login succed user will be redirected to home page
     * 
     * @param string username user's name
     * @param string password text-play password (will be encrypted here)
     * 
     * @return false if login failed
     */
    public function login($username, $password)
    {
        global $Database;
        global $Alexya;
        
		/**
		 * Can continue, boolean
		 *
		 * If an error happened this flag will be switched to false
		 */
		$can_continue = true;
		
        //check username
        if(empty($username)) {
            Results::addFlash(array(
						"result" => "error",
						"message" => "Username can't be empty!"
					));
			$can_continue = false;
        } else if(strlen($username) < $Alexya->min_username_length) {
            Results::addFlash(array(
						"result" => "error",
						"message" => "Username can't be shorter than $Alexya->min_username_length characters!"
					));
			$can_continue = false;
        } else if(strlen($username) > $Alexya->max_username_length) {
			Results::addFlash(array(
						"result" => "error",
						"message" => "Username can't be longer than $Alexya->max_username_length characters!"
					));
			$can_continue = false;
        }
        
        //check password
        if(empty($password)) {
			Results::addFlash(array(
						"result" => "error",
						"message" => "Password can't be empty!"
					));
			$can_continue = false;
        } else if(strlen($password) < $Alexya->min_password_length) {
			Results::addFlash(array(
						"result" => "error",
						"message" => "Password can't be shorter than $Alexya->min_password_length characters!"
					));
			$can_continue = false;
        } else if(strlen($password) > $Alexya->max_password_lenght) {
			Results::addFlash(array(
						"result" => "error",
						"message" => "Password can\'t be longer than $Alexya->max_password_lenght characters!"
					));
			$can_continue = false;
        }
        
        //Check no error ocurred
        if($can_continue) {
            $password = md5($password);
            
            //check username/pass exists
            $username_pass = $Database->query("SELECT * FROM accounts WHERE username='$username' && password='$password'");
            
            if($username_pass && $username_pass->num_rows == 1) {
                $user      = $username_pass->fetch_assoc();
                $sessionID = $Controller->generate_sessionID();
                
                //Update sessionID
                $update_sessionID = $Database->update("accounts", array("sessionID" => $sessionID), $user["userID"]);
                if($update_sessionID == true) {
                    $_SESSION["sessionID"] = $sessionID;
					Results::addFlash(array(
								"result" => "success",
								"message" => "You're now logged!"
							));
                    Functions::redirect(URL."?page=home");
                } else {
					Results::addFlash(array(
								"result" => "error",
								"message" => "Couldn't update sessionID!"
							));
                }
            } else {
				Results::addFlash(array(
							"result" => "error",
							"message" => "Wrong username/password, please try again!"
						));
            }
        }
        
        return false;
    }
	
	/**
     * Performs a register attempt
     * 
     * Will try to perform a register attempt with the given username and password
     * if the register succed user will be redirected to home page
     * 
     * @param string username user's name
     * @param string password text password (will be encrypted here)
	 * @param string mail register email
     * 
     * @return false if register failed
     */
    public static function register($username, $password, $email)
    {
        global $Database;
        global $Alexya;
		
		/**
		 * Can continue, boolean
		 *
		 * If an error happened this flag will be switched to false
		 */
		$can_continue = true;
		
        //check username
        if(empty($username)) {
            Results::addFlash(array(
						"result" => "error",
						"message" => "Username can't be empty!"
					));
			$can_continue = false;
        } else if(strlen($username) < $Alexya->min_username_length) {
            Results::addFlash(array(
						"result" => "error",
						"message" => "Username can't be shorter than $Alexya->min_username_length characters!"
					));
			$can_continue = false;
        } else if(strlen($username) > $Alexya->max_username_length) {
			Results::addFlash(array(
						"result" => "error",
						"message" => "Username can't be longer than $Alexya->max_username_length characters!"
					));
			$can_continue = false;
        }
        
        //check password
        if(empty($password)) {
			Results::addFlash(array(
						"result" => "error",
						"message" => "Password can't be empty!"
					));
			$can_continue = false;
        } else if(strlen($password) < $Alexya->min_password_length) {
			Results::addFlash(array(
						"result" => "error",
						"message" => "Password can't be shorter than $Alexya->min_password_length characters!"
					));
			$can_continue = false;
        } else if(strlen($password) > $Alexya->max_password_lenght) {
			Results::addFlash(array(
						"result" => "error",
						"message" => "Password can't be longer than $Alexya->max_password_lenght characters!"
					));
			$can_continue = false;
        }
        
        //check email
        if(empty($email)) {
			Results::addFlash(array(
						"result" => "error",
						"message" => "Email can't be empty!"
					));
			$can_continue = false;
        } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			Results::addFlash(array(
						"result" => "error",
						"message" => "The email see,s to be incorrect!"
					));
			$can_continue = false;
        }
        
        //Check no error ocurred
        if($can_continue) {
            $password = md5($password);
            
            //check username/pass exists
            $username_exists = $Database->query("SELECT * FROM accounts WHERE username='$username'");
            
            if($username_exists && $username_exists->num_rows == 0) {
                $sessionID = $Controller->generate_sessionID();
				
				//insert user in database
				$userID = $Database->insert("users", array(
											"username"  => $username,
											"password"  => $password,
											"email"     => $email,
											"sessionID" => $sessionID
										));
				
                if(is_numeric($userID)) {
                    $_SESSION["sessionID"] = $sessionID;
					Results::addFlash(array(
								"result" => "success",
								"message" => "You're now registered!"
							));
                    Functions::redirect(URL."?page=home");
                } else {
					Results::addFlash(array(
								"result" => "error",
								"message" => "Couldn't add user to database!"
							));
                }
            } else {
				Results::addFlash(array(
							"result" => "error",
							"message" => "Wrong username/password, please try again!"
						));
            }
        }
        
        return false;
    }
}