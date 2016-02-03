<?php
session_start();
include("../../../config/config.php");
include('../../../src/CLASS_Connectdb.php');
include('../../../src/CLASS_DatabaseConnection.php');
include("../../../src/CLASS_user.php");

$username = $_SESSION['username'];
$User = new User($username);
$User->checkUser();


if ($_POST['finalID'] != null){

	$sqlconnect = new Connectdb;
	$db = $sqlconnect->connectTo();

	$finalID = $_POST['finalID'];
	$count = 1;

	while ($count <= $finalID){

		$title = "title-".$count;
		@$titlePost = $_POST[$title];

		$desc = "desc-".$count;
		@$descPost = $_POST[$desc];

		if ($titlePost != null){
			$SentToDatabase = "UPDATE gallery SET imageTitle='$titlePost', imageDesc='$descPost'  WHERE id='$count'";
			mysqli_query($db,$SentToDatabase);
		}


		$count++;
	}


	$db->close();

	header("location:../../dashboard.php");

}else{
	header("location:../../dashboard.php");
}


?>
