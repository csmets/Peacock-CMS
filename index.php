<?php session_start(); ?>
<?php
/**
 * @license Copyright (c) 2014 - 2016, Peacock CMS by Clyde Smets <clyde@peacockcms.com>
 * Peacock CMS is under the GNU - General Public License V3.
 */
ob_start();
include("peacockCMS.php");
$peacock = new Peacock;
$route = new Route();
?>
