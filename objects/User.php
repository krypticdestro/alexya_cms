<?php
/**
 * Main user class
 *
 * The functions in this class are related to user's data
 *
 * @author Manulaiko
 */
class User
{
	/**
	 * Array Data
	 *
	 * It will contain all user data and objects
	 */
	public $data = array(
	);

	public function __construct()
	{
		global $Database;
		
		if(isset($_SESSION["sessionID"])) {
			$query = $Database->query("SELECT * FROM `users` WHERE sessionID='".
											$_SESSION["sessionID"]. "'");
			if(is_object($query) && $query->num_rows == 1) {
				$q = $query->fetch_assoc();
				
				$this->data = $q;
				
				//Set messages
				/*$outbox = $Database->get("messages", "WHERE authorID=".$q["userID"],
											-1, "array");
				$inbox = $Database->get("messages", "WHERE destinataryID=".$q["userID"],
											-1, "array");
				$notes = $Database->get("messages", "WHERE isNote=1", -1, "array");
				$this->data["messages"] = array(
						"inbox"	 => $inbox,
						"outbox" => $outbox,
						"notes"	 => $notes
					);
				
				//Decode jsons
				$this->data["friends"] = json_decode($q["firends"]);
				*/
				
				//TODO add more shit
			} else {
				session_unset("sessionID");
				Results::addFlash(array(
							"result" => "error",
							"message" => "Couldn't find sessionID!"
						));
				//Functions::redirect("login/");
			}
		}
	}
	
	/**
	 * Magic method __get
	 * 
	 * It will replace get($key)
	 * 
	 * Used to get a value from the array
	 * 
	 * @param mixed key: data's key
	 * @return mixed data's key value
	 */
	public function __get($key)
	{
        if(isset($this->data[$key])) {
            return $this->data[$key];
        }
        
        return false;
	}
	
	/**
	 * Magic method __set
	 * 
	 * It will replace set($key, $value)
	 * 
	 * Used to set a value in the array
	 * 
	 * @param mixed key: data's key
	 * @param mixed value: data's key value
	 */
	public function __set($key, $value)
	{
        if(array_key_exists($name, $this->data)) {
            $this->data[$name] = $value;
            return true;
        } else {
            $this->data[$name] = $value;
            return false;
        }
	}
	
	public function isAdmin()
	{
		if($this->rank == 21) {
			return true;
		}
		
		return false;
	}
	
	/**
	 * Description:
	 * returns boolean if this user is setted
	 */
	public function isLogged()
	{
		if($this->userID) {
			return true;
		}
		return false;
	}
}