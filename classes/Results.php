<?php
/**
 * Results Class
 *
 * This class is cool, it will be used to show messages.
 * It might sound stupid, but for example, the user logins and fails, how does he
 * knows what failed?
 * This class will fix that issue, it will make an array in the session that
 * will contain the messages to show when the page reloads. Once they've been showed
 * it will delete them from the session so they can't be shown again.
 *
 * To add a new result use the function Results::addFlash(array), it accepts an
 * array as parameter that will contain the type of result and the message
 * to show, once page is reloaded it will be deleted.
 * If you want to add a permanent result use the function Results::addPermanent(array)
 * which is the same as Results::addFlash(array) but won't delete the result when
 * the page is reloaded
 *
 * To get the results in the session use the function Results::get(int) which
 * accepts an integer as parameter that is the amount of messages to get. The
 * remaining messages will be deleted from the session unless you've add them through
 * Results::addPermanent() or if you add them through Results::addPermanent() and
 * the array has the index "delete_if_not_showed" to false (by default it's true)
 *
 * @author Kryptic Destro
 */
class Results
{
	/**
	 * Returns the amount of results in session
	 *
	 * @return the amount of results in session
	 */
	public static function getAmount()
	{
		if(!isset($_SESSION["results"])) {
			$_SESSION["results"] = array();
		}
		
		return count($_SESSION["results"]);
	}
	
	/**
	 * Adds a non-permanent index to the session
	 *
	 * @param array result index to be added
	 */
	public static function addFlash(array $result)
	{
		if(!isset($result["delete_if_not_shown"])) {
			$result["delete_if_not_shown"] = true;
		}
		
		$_SESSION["results"][] = array(
						"id" => Results::getAmount(),
						"is_permanent" => false,
						"array" => $result
					);
	}
	
	/**
	 * Adds a permanent index to the session
	 *
	 * @param array result indexc to be added
	 */
	public static function addPermanent(array $result)
	{
		$_SESSION["results"][] = array(
						"id" => Results::getAmount(),
						"is_permanent" => true,
						"array" => $result
					);
	}
	
	/**
	 * Returns an array with the given amount of results
	 * from the session, if $amount is 0, it will return all the 
	 * results from the session.
	 * It will also delete the non-permaments results which the
	 * "delete_if_not_shown" index is true
	 *
	 * @param integer amount amount of results to get from session
	 *
	 * @return array contaning results
	 */
	public static function get($amount = 0)
	{
		$max = $amount - 1;
		$results = array();
		$array   = array();
		
		//check amount of items to return
		if($amount == 0) {
			$max = Results::getAmount();
		} else {
			if($amount > $Results::getAmount()) {
				$max = Results::getAmount();
			}
		}
		
		//Add items to the array
		for($i = 0; $i < $max; $i++) {
			$results[] = $_SESSION["results"][$i];
			$array[]   = $_SESSION["results"][$i]["array"];
		}
		
		//Delete rest of items
		foreach($_SESSION["results"] as $result) {
			$delete = true;
			
			//check that isn't permanent
			if($result["is_permanent"]) {
				continue;
			}
			//Check item isn't in results array
			foreach($results as $item) {
				if($item["id"] == $result["id"]   &&
				   $result["array"]["delete_if_not_shown"] == false) {
					$delete = false;
					break;
				}
			}
			
			//delete item from session
			if($delete) {
				unset($_SESSION["results"][$result["id"]]);
			}
		}
		
		return $array;
	}
}






