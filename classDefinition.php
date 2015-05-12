<?php
/**
 * Class Definition
 * 
 * This file will include the Alexya's beautifull heart and will instance the
 * objects needed to build Alexya's beautifull core.
 * Don't Worry Be Happy! This file will make almost everything for you, and
 * best thing: you don't even need to include it, it will be imported by
 * "globConfig.php"
 * 
 * @author Kryptic Destro
 */

/* Start Import Libraries */
require_once(LIBRARIES."jbbcode-1.2.0/Parser.php");
require_once(LIBRARIES."smarty/Smarty.class.php");
/* End Import Libraries */

/* Start Import Classes */
require_once(CLASSES."Controller.php");
require_once(CLASSES."Medoo.php");
require_once(CLASSES."Comments.php");
require_once(CLASSES."Users.php");
require_once(CLASSES."Database.php");
require_once(CLASSES."SmartyLoader.php");
require_once(CLASSES."Functions.php");
require_once(CLASSES."Posts.php");
require_once(CLASSES."Results.php");
require_once(CLASSES."Security.php");
require_once(CLASSES."Session.php");
require_once(CLASSES."EventController.php");
/* End Import Classes */

/* Start Import Objects */
require_once(OBJECTS."Alexya.php");
require_once(OBJECTS."User.php");
require_once(OBJECTS."DatabaseObject.php");
require_once(OBJECTS."Post.php");
require_once(OBJECTS."Theme.php");
require_once(OBJECTS."Category.php");
/* End Import Objects */

/* Instance Objects */
/**
 * Database Object
 * 
 * Will be used to interact with database
 * 
 * @see classes/Database.php
 */
$Database = new Database(MYSQL_HOST, MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_DATABASE);

/**
 * User Object
 * 
 * Will represent the user that is viewing the site
 * 
 * @see objects/User.php
 */
$User = new User();

/**
 * Alexya Object
 * 
 * Represents Alexya itself, with all her beauty
 * 
 * @see objects/Alexya.php
 */
$Alexya = new Alexya();

/**
 * Controller Object
 *
 * Will contain the functions used in Alexya
 *
 * @see classes/Controller.php
 */
$Controller = new Controller();

/**
 * EventController Object
 * 
 * Will handle URL events
 * 
 * @see classes/EventController.php
 */
$EventController = new EventController();

/**
 * JBBCode Parser object
 * 
 * Will be used to parse BBCodes
 * 
 * @see libraries/jbbcode-1.2.0/Parser.php
 */
$JBBCode = new JBBCode\Parser();
$JBBCode->addCodeDefinitionSet(new JBBCode\DefaultCodeDefinitionSet());
$JBBCode->addBBCode("code", "<pre class=\"code\">{param}</pre>");

/**
 * SmartyLoader Object
 * 
 * Will be used to load Smarty (keep the last in instance)
 * 
 * @see classes/SmartyLoader.php
 */
$SmartyLoader = new SmartyLoader();
/* End Instance Objects */