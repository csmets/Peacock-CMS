<?php
    session_start();
    define("SITE_PATH", $_COOKIE['sitePath']);
    include("../../".SITE_PATH."config/config.php");
    include('../../../src/CLASS_Connectdb.php');
    include('../../../src/CLASS_peacock.php');

    $username = $_SESSION['username'];
    $peacock = new Peacock;
    $peacock->checkUser($username);

	$text = $_REQUEST['AddText'];
	if ($text){
		$SentToDatabase = "INSERT INTO textswap (content) VALUES ('$text')";
	}else{
		echo "ERROR: No Content Given.";
	}
	$sqlconnect = new Connectdb;
	$db = $sqlconnect->connectTo();
	mysqli_query($db,$SentToDatabase);
	$db->close();
?>