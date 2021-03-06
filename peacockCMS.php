<?php
/**
 * @license Copyright (c) 2014 - 2016, Peacock CMS by Clyde Smets <clyde@peacockcms.com>
 * Peacock CMS is under the GNU - General Public License V3.
 */

// ****** _INIT_ ********

// Gathering of Classes Used to run Peacock

//Database Connection
require ("src/CLASS_Connectdb.php");
require ("src/CLASS_DatabaseConnection.php");

//Peacock CMS functionalities
include_once ("src/CLASS_peacock.php");

//Page Analytics
include_once("src/CLASS_pageAnalytics.php");

//Search Functionality
include_once("src/CLASS_search.php");

//MySQL Read and Write Functionality
include_once("src/CLASS_SQLRW.php");

//Peacock inline editor
require("src/CLASS_inlineEditor.php");

//Routing Options
require("src/CLASS_route.php");

//EXTERNAL LIB
require_once("peacock/extlibs/simple_html_dom.php");

//Adding Editable Regions to Template
include_once("src/CLASS_addEditables.php");

//Adding Editable Regions to Template
include_once("src/CLASS_blogPagination.php");

?>
