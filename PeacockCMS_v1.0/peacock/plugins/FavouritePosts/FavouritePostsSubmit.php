<?php
    session_start();
    define("SITE_PATH", $_COOKIE['sitePath']);
    include("../../".SITE_PATH."config/config.php");
    include('../../../src/CLASS_Connectdb.php');
    include('../../../src/CLASS_peacock.php');

    $username = $_SESSION['username'];
    $peacock = new Peacock;
    $peacock->checkUser($username);

    $postID = $_REQUEST['AddPost'];

    $sqlconnect = new Connectdb;
    $db = $sqlconnect->connectTo();   
    $SentToDatabase = "INSERT INTO favouritePosts (postID) VALUES ('$postID')";
	mysqli_query($db,$SentToDatabase);
	$db->close();
?>