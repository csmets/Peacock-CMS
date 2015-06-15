<?php
session_start();
define("SITE_PATH", $_COOKIE['sitePath']);
include("../../".SITE_PATH."config/config.php");
include_once ("../../../src/CLASS_Connectdb.php");
include_once ("../../../src/CLASS_peacock.php");
	
$peacock = new Peacock;
$username = $_SESSION['username'];
$peacock->checkUser($username);

$postName = $_POST['projectTitle'];
$postContent = $_POST['projectContent'];
$postImage = $_POST['projectImage'];
$postSubTitle = $_POST['projectSubTitle'];

if ($postName && $postContent && $postImage){
	
	if ($postImage == 'none'){
		$postImage = '';
	}
	
	$sqlconnect = new Connectdb;
	$db = $sqlconnect->connectTo();
	mysqli_query($db,"INSERT INTO projects (projectTitle, projectSubTitle, projectContent, projectImage) VALUES ('$postName', '$postSubTitle', '$postContent', '$postImage')");
	$db->close();
	header("location:../../controlpanel.php");
}


?>