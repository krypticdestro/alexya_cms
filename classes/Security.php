<?php
/**
 * Security Class
 *
 * This class will contain functions related to security like userHasAccess(), parseHTML()...
 * If you're a plugin developer you might want to rewrite some of this functions :)
 *
 * @author Kryptic Destro
 */
class Security
{
	/**
	 * Checks if Alexya is private.
	 * If Alexya is private and user isn't registered will be redirected to login page
	 *
	 * @return true if user can access the page
	 */
	public static function userHasAccess()
	{
		global $User;
		global $Alexya;
		
		//Check if Alexya is private
		if($Alexya->is_private) {
			//Now check that user is logged
			if(!$User->isLogged()) {
				//And finally check that the page isn't login or register
				if($_GET["page"] != "login" || $_GET["page"] != "register") {
					//Add a message to show when the user reloads the page
					Results::addFlash(array(
									"result" => "error",
									"message" => "You must be loged in order to see this site!"
								)
							 );
					//Redirect
					Functions::redirect("?page=login");
				}
			}
		}
		
		return true;
	}
	
	/**
	 * XSS and SQL Injection Fix
	 *
	 * Will receive a string as parameter and will be parsed to HTML to avoid XSS
	 * injection, can be used to avoid SQL injection too}
	 *
	 * @param string text text to parse
	 * @param boolean bbcode if you want to parse bbcodes set this to true
	 *
	 * @return sanitized text
	 */
	public static function sanitize($text, $bbcode = false)
	{
	    $table = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
        $textArray = str_split($text);
        $result = array();

        foreach($textArray as $key => $value) {
            if(isset($table[$value])) {
                $value = $table[$value];
            }

            $result[] = $value;
        }
		
		//TODO add BBCodes

        $str = nl2br(implode("", $result));
        $ret = str_replace("\r\n", "", $str);
        return $ret;
	}
}