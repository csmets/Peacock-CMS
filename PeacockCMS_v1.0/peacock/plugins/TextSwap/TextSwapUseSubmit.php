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
    $sql = "SELECT * FROM textswap";
    $query = mysqli_query($db,$sql);
    while($get_data = mysqli_fetch_assoc($query)){
        if ($get_data['usetext'] == 'yes'){
           $SendToDatabase = "UPDATE textswap SET usetext='no' WHERE id='".$get_data['id']."'";
            mysqli_query($db,$SendToDatabase);
        }
    }

	$id = $_GET['id'];
	if ($id){
		$SentToDatabase = "UPDATE textswap SET usetext='yes' WHERE id='$id'";
	}else{
		echo "ERROR: No ID Given";
	}
	mysqli_query($db,$SentToDatabase);
	$db->close();
    header("location:../../controlpanel.php");
?>