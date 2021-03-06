<?php
/**
 * @license Copyright (c) 2014 - 2016, Peacock CMS by Clyde Smets <clyde@peacockcms.com>
 * Peacock CMS is under the GNU - General Public License V3.
 */

    session_start();
    include('initPeacock.php');

    $username = $_SESSION['username'];
    $User = new User($username);
    $User->checkUser();

    @$existingImage = $_REQUEST['image'];

    $db = new DatabaseConnection;
    $queryImageFolders = "SELECT * FROM imageFolders";
    $dataImageFolders = $db->fetch($queryImageFolders);

    $output = "";

    if ($existingImage != null){
      $queryImage = "SELECT * FROM images WHERE image='$existingImage'";
      $dataImage = $db->fetch($queryImage,1);
      $existingImageFolder = $dataImage['imageFolder'];
      $output .= "<option value='".$existingImageFolder."'>".$existingImageFolder."</option>";
      $folder = $existingImageFolder;
    }

    foreach($dataImageFolders as $imageFolder){
        $folderName = $imageFolder["folderName"];
        if ($existingImageFolder != $folderName){
          $output .= "<option value='".$folderName."'>".$folderName."</option>";
        }
    }
    echo $output;
    return $folder;
?>
