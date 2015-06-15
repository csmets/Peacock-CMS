<?php

	session_start();
    define("SITE_PATH", $_COOKIE['sitePath']);
    include("../../".SITE_PATH."config/config.php");
    include('../../../src/CLASS_Connectdb.php');

    $sqlconnect = new Connectdb;
    $db = $sqlconnect->connectTo();
	
	foreach($_REQUEST['folderlist'] as $folder){
		if ($folder != null){
			$sendToDatabase = "DELETE FROM GalleryFolders WHERE FolderName='$folder'";
			mysqli_query($db,$sendToDatabase);
			
			$FindData = mysqli_query($db,"SELECT * FROM gallery WHERE imageFolder='$folder'");
			
			while ($get_data = mysqli_fetch_assoc($FindData)){
				if ($get_data['id'] != null){
					$imageID = $get_data['id'];
				    mysqli_query($db,"DELETE FROM gallery WHERE id='$imageID'");
				}
			}
		}
	}
    $db->close();

?>