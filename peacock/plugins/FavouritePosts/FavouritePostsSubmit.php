<?php
    session_start();
    require("../../../config/config.php");
    require('../../../peacockCMS.php');
    require('../../../src/CLASS_user.php');


    $username = $_SESSION['username'];
    $user = new User($username);
    $user->checkUser();
    $peacock = new Peacock;

    $postID = $_REQUEST['AddPost'];

    $sqlconnect = new Connectdb;
    $db = $sqlconnect->connectTo();
    $SentToDatabase = "INSERT INTO favouritePosts (postID) VALUES ('$postID')";
	mysqli_query($db,$SentToDatabase);
	$db->close();
?>
