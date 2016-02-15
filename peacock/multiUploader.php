<?php
/**
 * @license Copyright (c) 2014 - 2016, Peacock CMS by Clyde Smets <clyde@peacockcms.com>
 * Peacock CMS is under the GNU - General Public License V3.
 */

    session_start();
    include('initPeacock.php');

    $username = $_SESSION['username'];
    $peacock = new peacock;
    $peacock->CheckUser($username);

    $exceedCount = 0;


	if (isset($_FILES['files'])){

		$numOfImages = 0;


		foreach ($_FILES['files']['name'] as $imagename){
			if ($imagename != null){
				$numOfImages = $numOfImages + 1;
			}
		}

		for ($count = 0; $count < $numOfImages; $count++){

			$name = $_FILES['files']['name'][$count];
		    $size = $_FILES['files']['size'][$count];
		    $type = $_FILES['files']['type'][$count];
		    $extention = strtolower(substr($name, strpos($name, '.') + 1));
		    $maxFileSize = 6291456;

		    $temp_name = $_FILES['files']['tmp_name'][$count];

			$folder = $_POST['folder'];

		    if(isset($name)){
		        if(!empty($name)){

		            if (($extention == 'jpg' || $extention == 'jpeg' || $extention == 'png' || $extention == 'gif') && ($type=='image/jpeg'||$type=='image/png'||$type=='image/gif')){
		                if ($size<=$maxFileSize){
		                    $location = '../view/image/';
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
                            $exceedCount++;
                            $message = "";
                            if ($exceedCount > 1){
                                $message = $exceedCount." Image files exceed 6mb";
                            }else{
                                $message = "Image file exceeds 6mb";
                            }

		                	if ($folder != null){
		                		$UploadErrorMessage = "location:viewImages.php?folder=$folder&message=".$message;
		                	}else{
		                    	$UploadErrorMessage = "location:dashboard.php?message=".$message;
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


		    }

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
?>
