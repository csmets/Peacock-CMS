<?php
/**
 * @license Copyright (c) 2014 - 2016, Peacock CMS by Clyde Smets <clyde@peacockcms.com>
 * Peacock CMS is under the GNU - General Public License V3.
 */

//Set the location to point at the peacockCMS init file
define("PEACOCKCMS_DIR","peacockCMS.php");

//Setting for mysql connection
define("MYSQL_HOST","127.0.0.1");
define("MYSQL_DATABASE", "peacockcms");
define("MYSQL_USERNAME", "root");
define("MYSQL_PASSWORD", "mysql");

$plugins = array(
    //Insert list of Global plugins here.
    "SimpleGallery"
);

$themes = array(
    "basic",
    "Eagle",
    "lapwing",
);

$peacockBlogging = true;

?>
