<?php
session_start();
define("SITE_PATH", $_COOKIE['sitePath']);
include("../../".SITE_PATH."config/config.php");
include_once ("../../../src/CLASS_Connectdb.php");

$postID = $_GET['id'];
$postName = $_POST['projectTitle'];
$postContent = $_POST['projectContent'];
$postImage = $_POST['projectImage'];
$postSubTitle = $_POST['projectSubTitle'];

if ($postID && $postName && $postContent && $postImage){
	
	if ($postImage == 'none'){
		$postImage = '';
	}
	
	$sqlconnect = new Connectdb;
	$db = $sqlconnect->connectTo();
	mysqli_query($db,"UPDATE projects SET projectTitle='$postName', projectSubTitle='$postSubTitle', projectContent='$postContent', projectImage='$postImage' WHERE id='$postID'");
	$db->close();
	header("location:../../dashboard.php");
}


?>