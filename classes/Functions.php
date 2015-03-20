<?php
/**
 * Random functions
 * 
 * This class will contain Alexya's functions that doesn't belongs to any other
 * class, if you think a function has something to do in another class, place it 
 * there, otherwise, here :*
 * 
 * @author Kryptic Destro
 */
class Functions
{
	/**
	 * Redirects user to given page
	 *
	 * @param string page: page to redirect
	 */
	public static function redirect($page)
	{
	    if(headers_sent()) {
	        echo '<script type="text/javascript">window.location.replace("'.$page.'");</script>';
	        die();
	    } else {
	        header("location: $page");
	        die();
	    }
	}
	
	/**
	 * Returns users IP
	 * 
	 * @return string user's IP
	 */
	public static function getIP()
	{    
		$client  = @$_SERVER['HTTP_CLIENT_IP'];
	    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
	    $remote  = $_SERVER['REMOTE_ADDR'];
	
	    if(filter_var($client, FILTER_VALIDATE_IP)) {
	        $ip = $client;
	    } else if(filter_var($forward, FILTER_VALIDATE_IP)) {
	        $ip = $forward;
	    } else {
	        $ip = $remote;
	    }
	
	    return $ip;
	}
    
    /**
	 * trims text to a space then adds ellipses if desired
	 * @param string $input text to trim
	 * @param int $length in characters to trim to
	 * @param bool $ellipses if ellipses (...) are to be added
	 * @param bool $strip_html if html tags are to be stripped
	 * @return string
	 */
	public static function trim_text($input, $length, $ellipses = true, $strip_html = true) {
	    //strip tags, if desired
	    if ($strip_html) {
	        $input = $this->parseHtml($input);
	    }
	  
	    //no need to trim, already shorter than trim length
	    if (strlen($input) <= $length) {
	        return $input;
	    }
	  
	    //find last space within length
	    $last_space = strrpos(substr($input, 0, $length), ' ');
	    $trimmed_text = substr($input, 0, $last_space);
	  
	    //add ellipses (...)
	    if ($ellipses) {
	        $trimmed_text .= '[...]';
	    }
	  
	    return $trimmed_text;
	}
	    
	/**
     * Returns current time stamp
     */
    public static function getTimeStamp($timestamp = 0)
    {
    	if($timestamp != 0) {
    		return date("Y-m-d H:i:s",$timestamp);
    	} else {
        	$currentDate = date_create();
        	$timestamp   = date_timestamp_get($currentDate);
        
        	return $timestamp;
        }
    }
    
    /**
     * As Smarty is fool and can't concatenate 2 strings I've made this function
     * 
     * @param array strings strings to concatenate
     * @return string concatenated strings
     */
    public static function concatenate(array $strings)
    {
    	$text = "";
    	foreach($strings as $string) {
    		$text .= $string;
    	}
    	return $text;
    }
	
	/**
	 * Description:
	 * Function for Smarty convert string to time
	 * @param String string time
	 */
	public static function strtotime($string) {
		return strtotime($string);
	}
	
	/**
     * Desription:
     * Calculates the percentage given max storage and current storage
     * @param int maxStorage
     * @param int currentStorage
     * @return int percentage
     */
    public static function getPercentage($maxStorage, $currentStorage) {
        $percentage = ($currentStorage * 100) / $maxStorage;
        return $percentage;
    }
}