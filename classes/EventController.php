<?php
/**
 * Event Controller
 * 
 * This class will handle the events.
 * It will contain an array that looks like this:
 * 
 * array(
 *  "METHOD" => array(
 *      "PARAMETER" => array(
 *          "VALUE" => "FUNCTION"
 *      )
 *  )
 * )
 * 
 * Where "METHOD" is the method ($_GET, $_POST, $_REQUEST...), "PARAMETER" is
 * the parameter name, "VALUE" is paramter value and "FUNCTION" is the function
 * to execute when that even is reached.
 * 
 * This is an example:
 * 
 * $events = array(
 *      "get" => array(
 *          "subaction" => array(
 *              "do_somethind" => function() {
 *                       echo "asdf";
 *                  },
 *              "do_more_thinds" => function() {
 *                      echo "asdfasdf";
 *                  }
 *          )
 *      )
 *  );
 * 
 * Now consider that's the array on EventController object, if the url is
 * something like this:
 * 
 * ?subaction=do_somethind
 * 
 * EventController will execute the function $events["get"]["subaction"]["do_somethind"]
 * sames applies for "do_more_thinds",
 * 
 * To add events to the array use the function "addEvents" which accepts the events array
 * as parameter
 * 
 * @author Kryptic Destro
 */
class EventController
{
    /**
     * Array events
     * 
     * Will contain events to execute
     */
    private $events = array();
    
    /**
     * Adds events to the array
     * 
     * @param array events events to add to the array
     */
    public function addEvents($events)
    {
        $this->events = array_merge_recursive($events, $this->events);
    }
    
    /**
     * "Listens" for the events and executes them
     */
    public function listen()
    {
        foreach($this->events as $method => $m_event) {
            foreach($m_event as $parameter => $p_event) {
                foreach($p_event as $value => $function) {
                    switch($method)
                    {
                        case "get":
                        case "GET":
                            if(isset($_GET[$parameter]) &&
                               $_GET[$parameter] == $value) {
                                    call_user_func_array($function, func_get_args());
                            };
                            break;
                        case "post":
                        case "POST":
                            if(isset($_POST[$parameter]) &&
                               $_POST[$parameter] == $value) {
                                    call_user_func_array($function, func_get_args());
                            };
                            break;
                        case "request":
                        case "REQUEST":
                            if(isset($_REQUEST[$parameter]) &&
                               $_REQUEST[$parameter] == $value) {
                                    call_user_func_array($function, func_get_args());
                            };
                            break;
                    }
                }
            }
        }
    }
}