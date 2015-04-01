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

//var_dump($_SESSION);

//Redirect user if he cant access the page
$Controller->check_user_has_access();

//assign menu to Smarty
$menu = $Database->get("menu", "WHERE visible=1 ORDER BY position");
$SmartyLoader->add("menu", $menu);


//Call theme handler
$Alexya->theme->handler();