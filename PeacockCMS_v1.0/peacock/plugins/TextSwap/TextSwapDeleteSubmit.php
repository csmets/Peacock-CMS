<?php
    session_start();
    define("SITE_PATH", $_COOKIE['sitePath']);
    include("../../".SITE_PATH."config/config.php");
    include('../../../src/CLASS_Connectdb.php');
    include('../../../src/CLASS_peacock.php');

    $username = $_SESSION['username'];
    $peacock = new Peacock;
    $peacock->checkUser($username);

    $sqlconnect = new Connectdb;
    $db = $sqlconnect->connectTo();   

	$id = $_GET['id'];
	if ($id){
		$SentToDatabase = "DELETE FROM textswap WHERE id='$id'";
	}else{
		echo "ERROR: No ID Given";
	}
	mysqli_query($db,$SentToDatabase);
	$db->close();
    header("location:../../controlpanel.php");
?>