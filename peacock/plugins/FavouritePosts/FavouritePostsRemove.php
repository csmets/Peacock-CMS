<?php
    session_start();
    require("../../../config/config.php");
    require('../../../peacockCMS.php');
    require('../../../src/CLASS_user.php');

    $username = $_SESSION['username'];
    $user = new User($username);
    $user->checkUser();
    $peacock = new Peacock;

    $postID = $_GET['id'];

    $sqlconnect = new Connectdb;
    $db = $sqlconnect->connectTo();
    $SentToDatabase = "DELETE FROM favouritePosts WHERE postID='$postID'";
	  mysqli_query($db,$SentToDatabase);
	  $db->close();

    header("location:../../dashboard.php");
?>
