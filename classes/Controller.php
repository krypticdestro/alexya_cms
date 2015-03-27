<?php
/**
 * Controller Class
 * 
 * This class will handle the controllers, it will contain an array with the
 * functions that will handle each controller (I know it's a bad description but
 * read the code and you'll know what I mean -.- :* ). Anyway, read the code
 * I think it's big enough to make it look something cool
 * 
 * @author Kryptic Destro
 */
class Controller
{
    /**
     * array functions
     * 
     * It will contain the functions that will be used by the controller.
     * The key of each index is a name that describes the function, don't change
     * them, if you want to make a plugin, just keep same name and add a diferent
     * function.
     * 
     * The value is the function itself, it will accept an array as parameter
     * that will contain the arguments, whether you want to be the array, I don't
     * give a fuck, just make it works
     */
    private $functions;
    
    /**
     * Constructor
     * 
     * This will set the default indexes in the $functions array, you don't need
     * to change anything here, this are the default functions of Alexya's core
     */
    public function __construct()
    {
        $this->functions = array(
            /**
             * This is an example, it's never used
             * 
             * You can add the functions directly here or use Controller::set()
             * which accepts the key of the index as first parameter (a string)
             * and the value of the index as second parameter (a function)
             * 
             * To call this function just use Controller::load() which accepts
             * a string as first parameter (in this case "test") and an array
             * as second parameter (which will be the parameters of the function)
             */
            "test" => function($params) {
				echo "test function: ";
                var_dump($params);
            },
            
            /**
             * Generates and returns a sessionID
             * 
             * @see classes/Functions.php
             */
            "generate_sessionID" => "Functions::generateSessionID",
			
			/**
			 * Register function
			 *
			 * @see classes/Session.php
			 */
			"register" => "Session::register",
			
			/**
			 * Login function
			 * 
			 * @see classes/Session.php
			 */
			"login" => "Session::login",
			
			/**
			 * Check if user can access the website
			 * 
			 * @see classes/Security.php
			 */
			"check_user_has_access" => "Security::userHasAccess"
        );
    }
    
    /**
     * Adds an entry to the array
     * 
     * Use this method if you want to add a function that Alexya will execute
     * Use the default names if you want to override an existing function or
     * use your own if not.
     * 
     * @param string name name of the function that will be saved in the array
     * @param function function the function that will be executed
     * 
     * @return true if $name already exists and was overwrited, false if it didn't
     *         exist but was added properly
     */
    public function __set($name, $function)
    {
        if(array_key_exists($name, $this->functions)) {
            $this->functions[$name] = $function;
            return true;
        } else {
            $this->functions[$name] = $function;
            return false;
        }
    }
    
    /**
     * Executes a function
     * 
     * This method will execute a function of the array.
     * 
     * @param string name name of the function to execute
     * @param mixed param parameters that will be passed to the function
     * 
     * @returns true if functions exists false if not
     */
    public function __call($name, $param)
    {
        if(!array_key_exists($name, $this->functions)) {
			if(DEBUG) {
				echo "Call to undefined function $name in Controller class!";
			}
            return false;
        }
        
        return call_user_func_array($this->functions[$name], $param);
    }
}