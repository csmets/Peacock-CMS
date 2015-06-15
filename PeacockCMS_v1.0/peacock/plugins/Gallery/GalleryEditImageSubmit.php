<?php
session_start();
define("SITE_PATH", $_COOKIE['sitePath']);
include("../../".SITE_PATH."config/config.php");
include('../../../src/CLASS_Connectdb.php');
include_once ("GalleryFunctions.php");

$sqlconnect = new Connectdb;
$db = $sqlconnect->connectTo();

$title = $_POST['title'];
$desc = $_POST['desc'];
$id = $_POST['id'];

if ($id != null){
	$SentToDatabase = "UPDATE gallery SET imageTitle='$title', imageDesc='$desc'  WHERE id='$id'";
	mysqli_query($db,$SentToDatabase);
	
	$gallery = new Gallery;
	
	$folder = $gallery->getImageFolder($id);
	header("location:../../GalleryFolder.php?folder=$folder");
}
$db->close();
	


?>