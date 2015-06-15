<?php
session_start();
define("SITE_PATH", $_COOKIE['sitePath']);
include("../../".SITE_PATH."config/config.php");
include('../../../src/CLASS_Connectdb.php');

$FolderName = $_REQUEST['FolderName'];

if ($FolderName != null){
	
	$sqlconnect = new Connectdb;
	$db = $sqlconnect->connectTo();
	mysqli_query($db,"INSERT INTO GalleryFolders (FolderName) VALUES ('$FolderName')");
	$db->close();
	
	header("location:../../controlpanel.php");
	
}else{
	header("location:../../controlpanel.php");
}


?>