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

    if ($existingImage != null){
      $queryImage = "SELECT * FROM images WHERE image='$existingImage'";
      $dataImage = $db->fetch($queryImage,1);
      $existingImageFolder = $dataImage['imageFolder'];
      $folder = $existingImageFolder;
    }

    echo $folder;
?>
