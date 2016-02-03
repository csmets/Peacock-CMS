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

    if(isset($name)){
        if(!empty($name)){
            
            if (($extention == 'jpg' || $extention == 'jpeg' || $extention == 'png' || $extention == 'gif') && ($type=='image/jpeg'||$type=='image/png'||$type=='image/gif')){
                if ($size<=$maxFileSize){
                    if ($peacock->getSiteImage() != null){
                        $deletePath = "siteImage/".$peacock->getSiteImage();
                        unlink($deletePath);
                    }
                    $location = SITE_PATH.'siteImage/';
                    $SendToDatabase = "UPDATE site SET image='$name' WHERE id='1'";
                    $sqlconnect = new Connectdb;
                    $db = $sqlconnect->connectTo();
                    mysqli_query($db,$SendToDatabase);
                    move_uploaded_file($temp_name, $location.$name);
                    $db->close();
                    header("location:dashboard.php?imessage=SUCESS!");
                }
                else {
                    $UploadErrorMessage = "location:dashboard.php?imessage=Image file exceeds 6mb";
                    header($UploadErrorMessage);
                }
            }
            else{
                $UploadErrorMessage = "location:dashboard.php?imessage=File type must be jpg / jpeg / png / gif";
                header($UploadErrorMessage);
            }
        }
        
        else{
            $UploadErrorMessage = "location:dashboard.php?imessage=No file selected"; 
            header($UploadErrorMessage);   
        }
    }
?>