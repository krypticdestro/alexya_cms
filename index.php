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
//$Controller->user_can_access_website();

//$Controller->test($_GET);

//Load page
$Alexya->theme->load("index");