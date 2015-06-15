<?php
	session_start();
	define("SITE_PATH", $_COOKIE['sitePath']);
    include("../../".SITE_PATH."config/config.php");
    include('../../../peacockCMS.php');

    $username = $_SESSION['username'];
    $peacock = new Peacock;
    $peacock->checkUser($username);

    $Theme = $peacock->getSiteTheme();
    if ($Theme != null){
        include("../../".SITE_PATH."themes/".$Theme."/Config/config.php");
    }

if (!empty($_POST['imagelist'])){
	
	$sqlconnect = new Connectdb;
	$db = $sqlconnect->connectTo();
	mysqli_query($db,'TRUNCATE TABLE simpleGallery');

	$sql = "SELECT * FROM pages";
	$query = mysqli_query($db,$sql);
	$checkGalleryPageExist = false;
	while ($get_data = mysqli_fetch_assoc($query)){
		if ($get_data['additional3'] == 'SimpleGallery'){
			$checkGalleryPageExist = true;
            break;
		}
	}
	
	if ($checkGalleryPageExist == false){
        if ($simpleGalleryFile == null){
            $galleryFilename = 'Gallery.php';   
        }else{
            $galleryFilename = $simpleGalleryFile;
        }
		mysqli_query($db,"INSERT INTO pages (pagename,additional,additional3,pagetype,draft,status) VALUES ('Gallery','$galleryFilename','SimpleGallery','relink','no','active')");
        $id = $db->insert_id;
        $q = mysqli_query($db,"SELECT * FROM pages");
        while($get_data = mysqli_fetch_assoc($q)){
            if ($get_data['additional3'] == 'SimpleGallery'){
                mysqli_query($db,"UPDATE pages SET additional2='default-EditPage.php?id=$id' WHERE id=$id");
            }
        }
	}
	
	foreach($_POST['imagelist'] as $image){
		mysqli_query($db,"INSERT INTO simpleGallery (ImageFile) VALUES ('$image')");
	}
	
	$db->close();
	
	
	
	header("location:../../controlpanel.php");
}


?>