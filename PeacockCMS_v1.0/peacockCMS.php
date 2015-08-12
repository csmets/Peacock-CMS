<?php
/**
 * @license Copyright (c) 2015, Peacock CMS - Clyde Smets. All rights reserved.
 * For licensing, see EULA.rtf
 */

// ****** _INIT_ ********

// Gathering of Classes Used to run Peacock

//Database Connection
require ("src/CLASS_Connectdb.php");

//Peacock CMS functionalities
include_once ("src/CLASS_peacock.php");

//Page Analytics
include_once("src/CLASS_pageAnalytics.php");

//Search Functionality
include_once("src/CLASS_search.php");

//MySQL Read and Write Functionality
include_once("src/CLASS_SQLRW.php");

//Routing Options
require("src/CLASS_route.php");

//EXTERNAL LIB
require_once("peacock/extlibs/simple_html_dom.php");

//Adding Editable Regions to Template
include_once("src/CLASS_addEditables.php");

?>