<?php
/**
 * @license Copyright (c) 2014 - 2016, Peacock CMS by Clyde Smets <clyde@peacockcms.com>
 * Peacock CMS is under the GNU - General Public License V3.
 */

    session_start();
    include('initPeacock.php');

    $username = $_SESSION['username'];
    $peacock = new Peacock;
    $peacock->checkUser($username);

    $name = $_FILES['file']['name'];
    $size = $_FILES['file']['size'];
    $type = $_FILES['file']['type'];
    $extention = strtolower(substr($name, strpos($name, '.') + 1));
    $maxFileSize = 6291456;

    $temp_name = $_FILES['file']['tmp_name'];
	
	$folder = $_POST['folder'];

    if(isset($name)){
        if(!empty($name)){
            
            if (($extention == 'jpg' || $extention == 'jpeg' || $extention == 'png' || $extention == 'gif') && ($type=='image/jpeg'||$type=='image/png'||$type=='image/gif')){
                if ($size<=$maxFileSize){
                    $location = 'image/';
                    $sqlconnect = new Connectdb;
                    $db = $sqlconnect->connectTo();
					if ($folder != null){
						mysqli_query($db,"INSERT INTO images (image, imageFolder) VALUES ('$name', '$folder')");
					}else{
						mysqli_query($db,"INSERT INTO images (image) VALUES ('$name')");
					}
                    move_uploaded_file($temp_name, $location.$name);
                    $db->close();
					if ($folder != null){
						header("location:viewImages.php?folder=$folder&message=SUCESS!");
					}else{
						header("location:dashboard.php?message=SUCESS!");
					}
                }
                else {
                	if ($folder != null){
                		$UploadErrorMessage = "location:viewImages.php?folder=$folder&message=Image file exceeds 6mb";
                	}else{
                    	$UploadErrorMessage = "location:dashboard.php?message=Image file exceeds 6mb";
					}
                    header($UploadErrorMessage);
                }
            }
            else{
            	if ($folder != null){
            		$UploadErrorMessage = "location:viewImages.php?folder=$folder&message=File type must be jpg / jpeg / png / gif";
            	}else{
            		$UploadErrorMessage = "location:dashboard.php?message=File type must be jpg / jpeg / png / gif";
            	}
                header($UploadErrorMessage);
            }
        }
        
        else{
        	if ($folder != null){
        		$UploadErrorMessage = "location:viewImages.php?folder=$folder&message=No file selected"; 
        	}else{
        		$UploadErrorMessage = "location:dashboard.php?message=No file selected"; 
        	}
            header($UploadErrorMessage);   
        }
    }
?>