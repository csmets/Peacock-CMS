<?php
/**
 * @license Copyright (c) 2015, Peacock CMS - Clyde Smets. All rights reserved.
 * For licensing, see EULA.rtf
 */

session_start();
include("initPeacock.php");
if(isset($_SESSION['username'])){
  unset($_SESSION['username']);
}
session_regenerate_id();
header("location:../plogin.php");
?>