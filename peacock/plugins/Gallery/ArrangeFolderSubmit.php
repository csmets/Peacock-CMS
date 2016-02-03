<?php
    session_start();
    include("../../../config/config.php");
    include('../../../src/CLASS_Connectdb.php');
    include('../../../src/CLASS_DatabaseConnection.php');
    include("../../../src/CLASS_user.php");

    $username = $_SESSION['username'];
    $User = new User($username);
    $User->checkUser();

	if (isset($_REQUEST['data'])){

		$data = $_REQUEST['data'];
		parse_str($data, $str);
		$menu = $str['item'];

		$sqlconnect = new Connectdb;
	    $db = $sqlconnect->connectTo();

		foreach ($menu as $key => $value){
			$key = $key + 1;
			$sendToDatabase = "UPDATE GalleryFolders SET FolderOrder='$key' WHERE id='$value'";
			mysqli_query($db,$sendToDatabase);
		}

	    $db->close();
   }else{
   	header("location:../../dashboard.php");
   }

?>
