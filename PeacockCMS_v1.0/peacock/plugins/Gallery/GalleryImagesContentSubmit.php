<?php
session_start();
define("SITE_PATH", $_COOKIE['sitePath']);
include("../../".SITE_PATH."config/config.php");
include('../../../src/CLASS_Connectdb.php');


if ($_POST['finalID'] != null){
	
	$sqlconnect = new Connectdb;
	$db = $sqlconnect->connectTo();
	
	$finalID = $_POST['finalID'];
	$count = 1;
	
	while ($count <= $finalID){
		
		$title = "title-".$count;
		@$titlePost = $_POST[$title];
		
		$desc = "desc-".$count;
		@$descPost = $_POST[$desc];
		
		if ($titlePost != null){
			$SentToDatabase = "UPDATE gallery SET imageTitle='$titlePost', imageDesc='$descPost'  WHERE id='$count'";
			mysqli_query($db,$SentToDatabase);
		}
		
		
		$count++;
	}
	
	
	$db->close();
	
	header("location:../../controlpanel.php");
	
}else{
	header("location:../../controlpanel.php");
}


?>