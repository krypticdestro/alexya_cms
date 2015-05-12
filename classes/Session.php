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
	public static function login($username, $password)
	{
	    global $Database;
	    global $Alexya;
	    global $Controller;
	    
		/**
		 * Can continue, boolean
		 *
		 * If an error happened this flag will be switched to false
		 */
		$can_continue = true;
		
	    //check username
	    if(empty($username)) {
	        Results::addFlash(array(
						"result" => "danger",
						"message" => "Username can't be empty!"
					));
			$can_continue = false;
	    } else if(strlen($username) < $Alexya->min_username_length) {
	        Results::addFlash(array(
						"result" => "danger",
						"message" => "Username can't be shorter than $Alexya->min_username_length characters!"
					));
			$can_continue = false;
	    } else if(strlen($username) > $Alexya->max_username_length) {
			Results::addFlash(array(
						"result" => "danger",
						"message" => "Username can't be longer than $Alexya->max_username_length characters!"
					));
			$can_continue = false;
	    }
	    
	    //check password
	    if(empty($password)) {
			Results::addFlash(array(
						"result" => "danger",
						"message" => "Password can't be empty!"
					));
			$can_continue = false;
	    } else if(strlen($password) < $Alexya->min_password_length) {
			Results::addFlash(array(
						"result" => "danger",
						"message" => "Password can't be shorter than $Alexya->min_password_length characters!"
					));
			$can_continue = false;
	    } else if(strlen($password) > $Alexya->max_password_length) {
			Results::addFlash(array(
						"result" => "danger",
						"message" => "Password can't be longer than $Alexya->max_password_length characters!"
					));
			$can_continue = false;
	    }
	    
	    //Check no error ocurred
	    if($can_continue) {
	        $password = md5($password);
	        
	        //check username/pass exists
	        $username_pass = $Database->select("users", "*", [
	        								"username" => $username,
	        								"password" => $password
	        							]
	        						);
	        
	        if(count($username_pass) == 1) {
	            $user      = $username_pass;
	            $sessionID = $Controller->generate_sessionID();
	            
	            //Update sessionID
	            $update_sessionID = $Database->update("users", [
	            							"sessionID" => $sessionID
	            						], [
	            							"userID" => $user["userID"]
	            						]
	            					);
	            if(is_numeric($update_sessionID)) {
	                $_SESSION["sessionID"] = $sessionID;
	                
	                $user = $Database->get("users", "*", [
	                						"sessionID" => $sessionID
	                					]
	                				);
	                if(is_array($user)) {
	                	$user = $user->fetch_assoc();
	                	$ip = json_decode($user["lastIPs"]);
	                	
	                	if(count($ip) >= 10) {
	                		unset($ip[0]); //delete first ip
	                	}
	                	
	                	$ip[] = Functions::getIP();
	                	
	                	$ip = array_reverse(array_flip(array_flip(array_reverse($ip, true))));
	                	
	                	$update_iplog = $Database->update("users", [
	                							"lastIPs" => json_encode($ip),
	                							"lastLogin" => Functions::getTimeStamp()
	                						], [
	                							"userID" => $user["userID"]
	                						]
	                					);
	                } else {
	                	Results::addFlash(array(
	                				"result" => "warning",
	            					"message" => "Couldn't find sessionID on database!"
	                			));
	                }
	                
					Results::addFlash(array(
								"result" => "success",
								"message" => "You're now logged!"
							));
	                Functions::redirect(URL."home");
	            } else {
					Results::addFlash(array(
								"result" => "danger",
								"message" => "Couldn't update sessionID!"
							));
	            }
	        } else {
				Results::addFlash(array(
							"result" => "danger",
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
	    global $Controller;
		
		/**
		 * Can continue, boolean
		 *
		 * If an error happened this flag will be switched to false
		 */
		$can_continue = true;
		
	    //check username
	    if(empty($username)) {
	        Results::addFlash(array(
						"result" => "danger",
						"message" => "Username can't be empty!"
					));
			$can_continue = false;
	    } else if(strlen($username) < $Alexya->min_username_length) {
	        Results::addFlash(array(
						"result" => "danger",
						"message" => "Username can't be shorter than $Alexya->min_username_length characters!"
					));
			$can_continue = false;
	    } else if(strlen($username) > $Alexya->max_username_length) {
			Results::addFlash(array(
						"result" => "danger",
						"message" => "Username can't be longer than $Alexya->max_username_length characters!"
					));
			$can_continue = false;
	    }
	    
	    //check password
	    if(empty($password)) {
			Results::addFlash(array(
						"result" => "danger",
						"message" => "Password can't be empty!"
					));
			$can_continue = false;
	    } else if(strlen($password) < $Alexya->min_password_length) {
			Results::addFlash(array(
						"result" => "danger",
						"message" => "Password can't be shorter than $Alexya->min_password_length characters!"
					));
			$can_continue = false;
	    } else if(strlen($password) > $Alexya->max_password_length) {
			Results::addFlash(array(
						"result" => "danger",
						"message" => "Password can't be longer than $Alexya->max_password_length characters!"
					));
			$can_continue = false;
	    }
	    
	    //check email
	    if(empty($email)) {
			Results::addFlash(array(
						"result" => "danger",
						"message" => "Email can't be empty!"
					));
			$can_continue = false;
	    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			Results::addFlash(array(
						"result" => "danger",
						"message" => "The email seems to be incorrect!"
					));
			$can_continue = false;
	    }
	    
	    //Check no error ocurred
	    if($can_continue) {
	        $password = md5($password);
	        
	        //check username/pass exists
	        $username_exists = $Database->select("users", "*", [
	        									"username" => $username
	        								]
	        							);
	        							
	        if(count($username_exists) == 0) {
	            $sessionID = $Controller->generate_sessionID();
				
				//insert user in database
				$userID = $Database->insert("users", [
											"username"  => $username,
											"password"  => $password,
											"email"     => $email,
											"sessionID" => $sessionID,
											"ip"		=> Functions::getIP()
										]
									);
				
	            if(is_numeric($userID)) {
	                $_SESSION["sessionID"] = $sessionID;
					Results::addFlash(array(
								"result" => "success",
								"message" => "You're now registered!"
							));
	                Functions::redirect(URL."home");
	            } else {
					Results::addFlash(array(
								"result" => "danger",
								"message" => "Couldn't add user to database!"
							));
	            }
	        } else {
				Results::addFlash(array(
							"result" => "danger",
							"message" => "Wrong username/password, please try again!"
						));
	        }
	    }
	    
	    return false;
	}
}