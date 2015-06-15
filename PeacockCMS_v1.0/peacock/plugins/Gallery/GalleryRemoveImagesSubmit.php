<?php
session_start();
define("SITE_PATH", $_COOKIE['sitePath']);
include("../../".SITE_PATH."config/config.php");
include('../../../src/CLASS_Connectdb.php');


if (!empty($_POST['imagelist'])){
	
	$sqlconnect = new Connectdb;
	$db = $sqlconnect->connectTo();
	
	$folder = $_POST['foldername'];
	
	foreach($_POST['imagelist'] as $id){
		mysqli_query($db,"DELETE FROM gallery WHERE id = '$id'");
	}
	
	$db->close();
	
	header("location:../../controlpanel.php");
	
}else{
	header("location:../../controlpanel.php");
}


?>