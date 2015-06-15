<?php
	session_start();
	
	$username = $_SESSION['username'];
	
    define("SITE_PATH", $_COOKIE['sitePath']);
    include("../../".SITE_PATH."config/config.php");
	include_once ("../../../src/CLASS_Connectdb.php");
	include_once ("../../../src/CLASS_peacock.php");
	$peacock = new Peacock;
    $peacock->checkUser($username);
	
	$projectID = $_GET['id'];
	$projectStatus = $_GET['status'];
	
	if ($projectID != null && ($projectStatus == 'no' || $projectStatus == 'yes')){
		$sqlconnect = new Connectdb;
	    $db = $sqlconnect->connectTo();
	    $SentToDatabase = "UPDATE projects SET projectDraft='$projectStatus' WHERE id='$projectID'";
	    $sql = mysqli_query($db, $SentToDatabase);
		$db->close();
		header("location:../../controlpanel.php");
	}else{
		echo "NO Project ID OR INCORRECT STATUS GIVEN";
	}
?>