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
	 * Array pages
	 * 
	 * Pages array
	 */
	private $pages;
	
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
	 * if the page doesn't exists will redirect to home page
	 *
	 * @param string name page name
	 */
	public function load($name)
	{
		global $Controller;
		global $Alexya;
		
		$file = $this->getFile($name);
		
		if(is_string($file)) {
			$Controller->load_page($file);
		} else {
			$not_found = $this->getFile("404");
			if(is_string($not_found)) {
				$Controller->load_page($not_found);
			} else {
				$home_page = $this->getFile("home");
				if(is_string($home_page)) {
					Functions::redirect(URL."home/");
				} else {
					die("Your theme is shit, use another");
				}
			}
		}//fool proof
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
				if(strpos($name, "pages") != false) {
					return THEMES.$Alexya->theme_name.$this->data->$name;
				}
				return $this->pages;
			}
			return $this->data->$name;
		}
		
		return false;
	}
	
	/**
	 * Executes theme handler
	 */
	public function handler()
	{
		global $Alexya;
		
		if(file_exists(THEMES.$Alexya->theme_name."/".$this->handler)) {
			define("HANDLER_PATH", THEMES.$Alexya->theme_name.
									"/".Functions::getPath($this->handler));
			require_once(THEMES.$Alexya->theme_name."/".$this->handler);
		} else {
			Results::addFlash(array(
						"result" => "danger",
						"message" => "Couldn't find theme handler, please reinstall the theme!"
					));
		}
	}
	
	/**
	 * Sets pages array
	 * 
	 * @param array pages array containing pages list
	 */
	public function setPages($pages)
	{
		$this->pages = $pages;
	}
	
	/**
	 * Returns the corresponding file of the page
	 * 
	 * if it wasn't found will return false
	 * 
	 * @param string page page name
	 * @return string file name if exists, false if not
	 */
	public function getFile($page)
	{
		if(isset($this->pages[$page]) && 
			file_exists(THEMES.$Alexya->theme_name."/".$this->pages[$page])) {
			return $this->pages[$page];
		}
		
		return false;
	}
}