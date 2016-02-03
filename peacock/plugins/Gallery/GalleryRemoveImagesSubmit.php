<?php
session_start();
require("../../../config/config.php");
require('../../../src/CLASS_Connectdb.php');
include('../../../src/CLASS_DatabaseConnection.php');
include("../../../src/CLASS_user.php");

$username = $_SESSION['username'];
$User = new User($username);
$User->checkUser();


if (!empty($_POST['imagelist'])){

	$sqlconnect = new Connectdb;
	$db = $sqlconnect->connectTo();

	$folder = $_POST['foldername'];

	foreach($_POST['imagelist'] as $id){
		mysqli_query($db,"DELETE FROM gallery WHERE id = '$id'");
	}

	$db->close();

	header("location:../../GalleryRemoveImages.php?folder=$folder");

}else{
	header("location:../../GalleryRemoveImages.php?folder=$folder");
}


?>
