<?php
/**
 * Alexya Class
 * 
 * This class will represent Alexya's beautifull configuration, the dirty
 * unexplainable and misterious configuration and feelings related with Alexya
 * will be defined here, be carefull, you might get scared >:)
 * 
 * @author Kryptic Destro
 */
class Alexya
{
    /**
     * array insides
     * 
     * This array will contain Alexya's insides (aka configuration)
     * it will be setted with default shit and will be overriden in the constructor
     * with more data from database
     * 
     * It will be a 1 dimension array, if you need to add another dimension to the
     * array use a JSON instead. Each index is the property name and the value is...
     * ITS VALUE!!! (clap) (clap) (clap) (no skype emoticons in the file sorry u.u)
     */
    private $insides = array(
        "site_name"         => "Alexya CMS", //Site tilte, it will appear in the browser title
        "site_description"  => "Alexya's CMS home", //Site description, it will be used by metatags
		"site_keywords"		=> "Alexya, Blog, CMS, php, programming, kryptic destro", //SEO Keywords
        "is_private"        => true, //Is private, requires being logged in order to see the site
        "max_username_length" => 32,
        "min_username_length" => 4,
        "max_password_length" => 32,
        "min_password_legnth" => 4
    );
    
    /**
     * Constructor
     * 
     * This function will overloa the $insides array with shit from database
     */
    public function __construct()
    {
        global $Database;
		
		$this->insides["theme"] = new Theme("alexya"); //default theme
        $this->insides["theme_name"] = "alexya";
		
        //TODO design database and load shit
    }
    
    /**
     * Magic method!!
     * 
     * Did you know that Alexya is a magician? Yes, she is, like dynamo but way better!
     * This magic method will find the given parameter as the key in $insides array 
     * and will return its value, if it doesn't exists, will return false.
     * 
     * The above piece of shit means that this should be fool-prof enough to work
     * with Alexya, just easy as use $Alexya->index instead of $Alexya->insides["index"]
     * which won't work because Alexya's insides are private and just Alexya can see her insides
     * 
     * @param string (actually I don't know how will the parameter be sent) param index of $insides array
     * @return Alexya::insides[$param]
     */
    public function __get($param)
    {
        if(isset($this->insides[$param])) {
            return $this->insides[$param];
        }
        
        return false;
        //Okay, maybe it was a really extense documentation for such piece of shit-code u.u sorry
    } 
    
    /**
     * Magic method!!
     * 
     * Our favourite magician (aka Alexya) bring us this magic method along with __get($param)
     * it will be used to change Alexya's insides, use it with carefull :P
     * 
     * @param string name index name
     * @param mixed value index value
     * @return true if name already exists and was overriden, false if not and was created
     */
    public function __set($name, $value)
    {
        if(array_key_exists($name, $this->insides)) {
            $this->insides[$name] = $value;
            return true;
        } else {
            $this->insides[$name] = $value;
            return false;
        }
    }
}