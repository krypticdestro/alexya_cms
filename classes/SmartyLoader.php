<?php
/**
 * Smarty loader
 * 
 * This class will load smarty, set variables, print page...
 * 
 * The constructor will set variables that will be used in all pages, if you will
 * use a Smarty variable in all pages, add it in the constructor, if it's going to be used
 * just in certain pages, add it in that page.
 * 
 * @author Kryptic Destro
 */
class SmartyLoader extends Smarty
{
    /**
	 * Constructor
	 *
     * Adds default constants to the array
     */
    public function __construct()
    {
        parent::__construct();
        $this->add("database", $GLOBALS["Database"]);
		$this->add("Alexya", $GLOBALS["Alexya"]);
    }
     
    /**
     * Sets variables and prints page
     * 
     * @param string page: the page path to display
     * @param array array: the array containing variables and values
     */
    public function load($page, array $array = null)
    {
        if($array != null) {
              $this->addArray($array);
        }
        
        $this->display($page);
    }
    
    /**
     * Adds an entry to the array
     * 
     * @param string key: array entry key
     * @param mixed val: entry value
     */
    public function add($key, $val)
    {
        $this->assign($key, $val);
    }
    
    /**
     * Adds an entry to the array
     * 
     * @param array array: collection of keys and values
     */
    public function addArray($array)
    {
        foreach($array as $key => $val) {
            $this->add($key, $val);
        }
    }
    
    /**
     * Instances and returns an object
     * 
     * @param string name object name
     * @param mixed param params to send to constructor
     */
    public static function instance_object($name, $param)
    {
        return new $name($param);
    }
}