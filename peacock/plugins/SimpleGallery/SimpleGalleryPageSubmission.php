<?php
    session_start();
	include_once ("../../peacock_config.php");
	include_once ("../../core/CLASS_connectdb.php");
	include_once ("../../core/CLASS_peacock.php");

    $username = $_SESSION['username'];
    $peacock = new Peacock;
    $peacock->checkUser($username);

	$ID = $_GET['id'];
	$Contents = $_POST['pageContent'];
	$Image = $_POST['backgroundImage'];
	if ($Contents){
		$SentToDatabase = "UPDATE pages SET bodycontent='$Contents', image='$Image' WHERE id='$ID'";
	}else{
		echo "ERROR: No Content Given.";
	}
	$sqlconnect = new Connectdb;
	$db = $sqlconnect->connectTo();
	mysqli_query($db,$SentToDatabase);
	$db->close();
	
	header("location:../../dashboard.php");
?>