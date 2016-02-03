<?php
	session_start();
  include("../../../config/config.php");
  include('../../../peacockCMS.php');
	include('../../../src/CLASS_user.php');

  $username = $_SESSION['username'];
	$user = new User($username);
	$user->checkUser();
  $peacock = new Peacock;

	//Open Theme config to check if there is a custom gallery file name allocated
	//Custom file name is assigned to $simpleGalleryFile if NULL, Default = Gallery.php
	include('../../../view/themes/'.$peacock->getSiteTheme().'/config/config.php');

	if (!empty($_POST['imagelist'])){
		$DBC = new DatabaseConnection;

		$DBC->query('TRUNCATE TABLE simpleGallery');

		$checkGalleryPageExist = false;
		$pages = $DBC->fetch("SELECT * FROM pages");
		foreach($pages as $page){
			if ($page['additional3'] == 'SimpleGallery'){
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
					$DBC->query("INSERT INTO pages (pagename,additional,additional3,pagetype,draft,status) VALUES ('Gallery','$galleryFilename','SimpleGallery','relink','no','active')");
	        $id = $DBC->last_id_used;
	        foreach($pages as $page){
	            if ($page['additional3'] == 'SimpleGallery'){
	                $DBC->query("UPDATE pages SET additional2='default-EditPage.php?id=$id' WHERE id=$id");
	            }
	        }
		}

		foreach($_POST['imagelist'] as $image){
			$DBC->query("INSERT INTO simpleGallery (ImageFile) VALUES ('$image')");
		}

	}
	header("location:../../dashboard.php");

?>
