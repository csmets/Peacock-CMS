<?php
/**
 * @license Copyright (c) 2015, Peacock CMS - Clyde Smets. All rights reserved.
 * For licensing, see EULA.rtf
 */
    
//Set the location to point at the peacockCMS init file
define("PEACOCKCMS_DIR","peacockCMS.php");
//Project folder location
define("FOLDER","");

//Setting for mysql connection
define("MYSQL_HOST","127.0.0.1");
define("MYSQL_DATABASE", "DATABASE_NAME");
define("MYSQL_USERNAME", "MYSQL_USERNAME");
define("MYSQL_PASSWORD", "MYSQL_PASSWORD");

$plugins = array(
    //Insert list of plugins here.
    "SimpleGallery",
    "FavouritePosts"
);

$themes = array(
    "basic",
    "Eagle",
    "lapwing",
);

$peacockBlogging = true;

?>