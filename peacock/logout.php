<?php
/**
 * @license Copyright (c) 2014 - 2016, Peacock CMS by Clyde Smets <clyde@peacockcms.com>
 * Peacock CMS is under the GNU - General Public License V3.
 */

session_start();
include("initPeacock.php");
if(isset($_SESSION['username'])){
  unset($_SESSION['username']);
}
session_regenerate_id();
header("location:/plogin");
?>
