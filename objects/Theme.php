<?php
/**
 * Theme model
 *
 * This is the model that will represent a theme, the constructor will
 * receive the theme name as parameter and will try to find the file
 * "theme.xml" inside theme's path (THEMES.$name), if it wasn't found will load default theme
 * If default theme wasn't found will show an error and Alexya will die u.u
 *
 * @author Kryptic Destro
 */
class Theme
{
	/**
	 * SimpleXMLElement data
	 *
	 * The result of load theme.xml
	 */
	private $data;
	
	/**
	 * String name
	 *
	 * Theme's name
	 */
	private $name;
	
	/**
	 * Constructor
	 *
	 * @param string name theme's name
	 */
	public function __construct($name)
	{
		if(file_exists(THEMES."$name/theme.xml")) {
			$str = file_get_contents(THEMES.$name."/theme.xml");
		} else if(file_exists(THEMES."alexya/theme.xml")) {
			Results::addFlash(array(
						"result" => "warning",
						"message" => "The $name theme wasn't found! Using default theme!"
					));
			$name = "alexya";
			$Alexya->theme_name = "alexya";
			$str = file_get_contents(THEMES.$name."/theme.xml");
		} else {
			die("Couldn't find default theme, please, check that configuration is correct and try reinstalling Alexya!");
		}
		
		$xml = str_replace("{theme_path}", "themes/$name/", $str);
		$this->data = simplexml_load_string($xml);
	}
	
	/**
	 * Load method
	 *
	 * This method will try to load the given page.
	 * if the page doesn't exists will redirect to ?page=home
	 *
	 * @param string name page name
	 */
	public function load($name)
	{
		global $SmartyLoader;
		global $Alexya;
		
		if(file_exists(THEMES."$Alexya->theme_name/$name.html")) {
			$SmartyLoader->load($this->paths->includes."head.html");
			$SmartyLoader->load(THEMES.$Alexya->theme_name."/$name.html");
			$SmartyLoader->load($this->paths->includes."foot.html");
		} else {
			header("location: ?page=home");
		}
	}
	
	/**
	 * Magic method __set
	 *
	 * Will return a value from the data object
	 *
	 * @param object name name of the value to return
	 * @return mixed object's value
	 */
	public function __get($name)
	{
		if(isset($this->data->$name)) {
			if(strpos($name, "paths") != false) {
				return THEMES.$Alexya->theme_name.$this->data->$name;
			}
			return $this->data->$name;
		}
		
		return false;
	}
}