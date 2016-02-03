<?php
session_start();
include("../../../config/config.php");
include('../../../src/CLASS_Connectdb.php');
include('../../../src/CLASS_DatabaseConnection.php');
include("../../../src/CLASS_user.php");
include_once ("GalleryFunctions.php");

$username = $_SESSION['username'];
$User = new User($username);
$User->checkUser();

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
