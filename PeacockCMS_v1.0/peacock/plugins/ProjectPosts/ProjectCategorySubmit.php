<?php
    session_start();
    define("SITE_PATH", $_COOKIE['sitePath']);
    include("../../".SITE_PATH."config/config.php");
	include_once ("../../../src/CLASS_Connectdb.php");
	include_once ("../../../src/CLASS_peacock.php");
    require("ProjectFunctions.php");
	
	$peacock = new Peacock;
	$username = $_SESSION['username'];
	$peacock->checkUser($username);

    $PostID = $_GET['id'];
    $Category = $_POST['category'];
    $sqlconnect = new Connectdb;
    $db = $sqlconnect->connectTo();

    $projects = new Projects;
    $categories = $projects->getProjectCategory($PostID);

    $updateCategories = $categories.",".$Category;


    $SentToDatabase = "UPDATE projects SET projectCategory='$updateCategories' WHERE id='$PostID'";

    mysqli_query($db,$SentToDatabase);
    $db->close();
    header("location:../../controlpanel.php");
?>