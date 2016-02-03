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

    $ProjectID = $_GET['id'];
    $Category = $_GET['category'];
    $sqlconnect = new Connectdb;
    $db = $sqlconnect->connectTo();

    $projects = new Projects;
    $categories = $projects->getProjectCategory($ProjectID);

    $categoriesArray = explode(",",$categories);

    $updateCategories = '';
    $count = 1;
    foreach ($categoriesArray as $value){
        if ($value != $Category){
            if($count < (count($categoriesArray)-1)) {
                $updateCategories .= $value.","; 
                $count++;
            }else{
                $updateCategories .= $value; 
            }
        }else{
            if (count($categoriesArray) == 1){
                $updateCategories = 1; 
            }   
        }
    }

    $SentToDatabase = "UPDATE projects SET projectCategory='$updateCategories' WHERE id='$ProjectID'";

    mysqli_query($db,$SentToDatabase);
    $db->close();
    header("location:../../dashboard.php");
?>