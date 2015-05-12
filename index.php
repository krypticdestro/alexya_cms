<?php
/**
 * Index page
 * 
 * This file will contain the behaivour of the site, everything will be here
 * 
 * @author Kryptic Destro
 */

//include Alexya's Core
require_once("globConfig.php");

//Redirect user if he cant access the page
$Controller->check_user_has_access();

//assign menu to Smarty
$menu = $Database->select("menu", "*", [
                    "visible" => 1
                ]
            );
$menu = array_reverse($menu);
$SmartyLoader->add("menu", $menu);


//Call theme handler
$Alexya->theme->handler();