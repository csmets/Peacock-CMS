<?php
session_start();
include("../../../config/config.php");
include('../../../src/CLASS_Connectdb.php');
include('../../../src/CLASS_DatabaseConnection.php');
include("../../../src/CLASS_user.php");

$username = $_SESSION['username'];
$User = new User($username);
$User->checkUser();

$FolderName = $_REQUEST['FolderName'];

if ($FolderName != null){

	$sqlconnect = new Connectdb;
	$db = $sqlconnect->connectTo();
	mysqli_query($db,"INSERT INTO GalleryFolders (FolderName) VALUES ('$FolderName')");
	$db->close();

	header("location:../../dashboard.php");

}else{
	header("location:../../dashboard.php");
}


?>
