<?php
/**
 * Theme handler
 * 
 * This file will handle things related to the theme like choosing which page to
 * load, add eventes to EventController...
 * 
 * @author Kryptic Destro
 */

/**
 * Array pages
 * 
 * It will contain the page and file name to display
 * 
 * The array index is the page in url, the value is the file name (no path, just 
 * file name)
 */
$pages = array(
        /**
         * Home page
         */
        "home" => "index.html",
    
        /**
         * Login page
         */
        "login" => "login.html",
        
        /**
         * Logout page
         * 
         * Same as login because will be handled through events
         */
        "logout" => "login.html",
    
        /**
         * Reguister page
         * 
         * As this theme has login and register on same page, the file is the same
         */
        "register" => "login.html",
    
        /**
         * Post page
         */
        "posts" => "posts.html",
    
        /**
         * User page
         */
        "users" => "users.html",
        
        /**
         * Category page
         */
        "category" => "category.html",
        
        /**
         * 404 page
         */
        "404" => "404.html",
    );

/**
 * Loads Smarty template
 * 
 * @param string name filename
 */
function load_page($file)
{
   global $SmartyLoader;
   global $Alexya;
   
	$SmartyLoader->load($Alexya->theme->paths->includes."head.html");
	$SmartyLoader->load(THEMES.$Alexya->theme_name."/$file");
	$SmartyLoader->load($Alexya->theme->paths->includes."foot.html");
}

/**
 * Array events
 * 
 * Will contain the events that EventController will handle
 */
$events = array(
    "post" => array(
        "subaction" => array(
                "login" => function() {
                    global $Controller;
                    
                    if(isset($_POST["username"], $_POST["password"])) {
                        $Controller->login($_POST["username"], $_POST["password"]);
                    } else {
                        Results::addFlash(array(
                                    "result" => "danger",
                                    "message" => "Please, fill the form and try again!"
                                ));
                    }
                },
                "register" => function() {
                    global $Controller;
                    
                    if(isset($_POST["username"], $_POST["password"], $_POST["email"])) {
                        $Controller->register($_POST["username"], $_POST["password"], $_POST["email"]);
                    } else {
                        Results::addFlash(array(
                                    "result" => "danger",
                                    "message" => "Please, fill the form and try again!"
                                ));
                    }
                },
                "post_comment" => function() {
                    global $Database;
                    global $User;
                    
                    //Check if info is setted
                    if(isset($_POST["content"], $_GET["posts"]) && !empty($_POST["content"])) {
                        $text = Security::sanitize($_POST["content"]);
                        //Get postID
                        $post = $Database->get("posts", "*", [
                                                        "permalink" => $_GET["posts"]
                                                    ]
                                                );
                        if(is_array($post)) {
                            $postID = $post["postID"];
                        } else {
                            Results::addFlash(array(
                                        "result" => "danger",
                                        "message" => "The post wasn't found in database!"
                                    ));
                            return;
                        }
                        
                        //Build query
                        $query = $Database->insert("comments", array(
                                        "postID" => $postID,
                                        "authorID" => $User->userID,
                                        "content" => $text
                                    ));
                        if(is_numeric($query)) {
                            Results::addFlash(array(
                                        "result" => "success",
                                        "message" => "Post added!"
                                    ));
                        } else {
                            Results::addFlash(array(
                                        "result" => "danger",
                                        "message" => "Couldn't add post in database $query!"
                                    ));
                        }
                    } else {
                        Results::addFlash(array(
                                    "result" => "danger",
                                    "message" => "Comment can't be empty!"
                                ));
                    }
                }
            )
        ),
    "get" => array(
            "action" => array(
                "logout" => function() {
                    if(isset($_SESSION["sessionID"])) {
                        session_unset("sessionID");
                        Results::addFlash(array(
                                    "result" => "success",
                                    "message" => "You've successfully logged out!"
                                ));
                        Functions::redirect(URL."home");
                    }
                }
            )
        )
    );
$GLOBALS["EventController"]->addEvents($events);
$GLOBALS["EventController"]->listen();

if(!isset($_GET["action"])) {
    Functions::redirect(URL."home");
}

if(isset($pages[$_GET["action"]])) {
    $file = $pages[$_GET["action"]];
} else {
    $file = false;
}

if(is_string($file)) {
	load_page($file);
} else {
	$not_found = $this->getFile("404");
	if(is_string($not_found)) {
		load_page($not_found);
	} else {
		$home_page = $this->getFile("home");
		if(is_string($home_page)) {
			Functions::redirect(URL."home");
		} else {
			die("Your theme is shit, use another");
		}
	}
}//fool proof

foreach(Results::get() as $result) {
    echo	'<div class="alert alert-'.$result["result"].' alert-dismissible">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
  				'.$result["message"].'
  			</div>';
}