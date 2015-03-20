<?php
/**
 * Alexya Configuration File
 * 
 * This file will contain the basics configuration needed by the
 * Alexya CMS core, paths, urls, constants... will be defined here
 * 
 * It will also include classDefinition.php so this will be the file
 * you MUST include in order to use Alexya's core
 * 
 * @author Kryptic Destro
 */

/* Start Global Configuration */
/**
 * Debug
 * 
 * True to activate debug mode
 */
define("DEBUG", true);

/**
 * Start and configure session settings
 */
ini_set("session.name", "Alexya");
session_start();
/* End Global Configuration */

/* Start Path Settings */
/**
 * Root
 * 
 * Default directory of Alexya's core
 */
define("ROOT", dirname(__FILE__)."/");

/**
 * Classes
 * 
 * Classes directory
 */
define("CLASSES", ROOT."classes/");

/**
 * Objects
 * 
 * Objects directory
 */
define("OBJECTS", ROOT."objects/");

/**
 * Libraries
 * 
 * Libraries directory
 */
define("LIBRARIES", ROOT."libraries/");

/**
 * Themes
 * 
 * Themes directory
 */
define("THEMES", ROOT."themes/");
/* End Path Settings */

/* Start MySQL Settings */
/**
 * Host
 * 
 * Hostname or IP that hosts database
 */
define("MYSQL_HOST", "localhost");

/**
 * Username
 * 
 * Username to access the database
 */
define("MYSQL_USERNAME", "root");

/**
 * Password
 * 
 * Password to authenticate database
 */
define("MYSQL_PASSWORD", "");

/**
 * Name
 * 
 * Database name
 */
define("MYSQL_DATABASE", "alexya");
/* End MySQL Settings */

/* Start URL Settings */
/**
 * Host
 * 
 * Host that hosts Alexya CMS
 */
define("HOST", "port-80.hau8kxjq2yqwu3di0k3jb0fhruihehfr2jex36xee5klnmi.box.codeanywhere.com");

/**
 * Url
 * 
 * URL used to access Alexya CMS
 */
define("URL", "https://". HOST ."/");
/* End URL Settings */

require_once(ROOT."classDefinition.php");