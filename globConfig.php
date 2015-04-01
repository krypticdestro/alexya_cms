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
//ini_set("session.name", "Alexya CMS");
//ini_set("session.user_cookies", 1);
session_save_path("tmp");
session_start();

/* Set error reporting */
if(DEBUG) {
    ini_set("display_errors", 1);
    error_reporting(E_ALL);
} else {
    ini_set("display_errors", 0);
}

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
define("MYSQL_HOST", "0.0.0.0");

/**
 * Username
 * 
 * Username to access the database
 */
define("MYSQL_USERNAME", "krypticdestro");

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
define("MYSQL_DATABASE", "c9");
/* End MySQL Settings */

/* Start URL Settings */
/**
 * Host
 * 
 * Host that hosts Alexya CMS
 */
define("HOST", "alexya-cms-krypticdestro.c9.io");

/**
 * Url
 * 
 * URL used to access Alexya CMS
 */
define("URL", "https://". HOST ."/");
/* End URL Settings */

require_once(ROOT."classDefinition.php");