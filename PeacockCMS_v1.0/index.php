<?php session_start(); ?>
<link href="peacock/css/PeacockStyles.css" rel="stylesheet" type="text/css" />
<?php
/**
 * @license Copyright (c) 2015, Peacock CMS - Clyde Smets. All rights reserved.
 * For licensing, see EULA.rtf
 */
ob_start();
include("peacockCMS.php");
$peacock = new Peacock;
include("includes.php");
$route = new Route();
?>