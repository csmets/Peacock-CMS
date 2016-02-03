<?php
/**
 * @license Copyright (c) 2014 - 2016, Peacock CMS by Clyde Smets <clyde@peacockcms.com>
 * Peacock CMS is under the GNU - General Public License V3.
 */

    session_start();
    include('initPeacock.php');

    $username = $_SESSION['username'];
    $peacock = new Peacock;
    $User = new User($username);
    $User->checkUser();

    $folder = $_REQUEST['folder'];

    $sqlconnect = new Connectdb;
    $db = $sqlconnect->connectTo();
    $data = mysqli_query($db,"SELECT * FROM images");

    $string = "<option value='none'>none</option>";

    while($get_data = mysqli_fetch_assoc($data)){
        if ($get_data['imageFolder'] == $folder){
            $imageName = $get_data["imagename"];
            $imageURL = $get_data["image"];
            $imageText = $imageURL;
            if ($imageName != null){
                $imageText = $imageName;
            }
            $string .= "<option value='".$imageURL."'>".$imageText."</option>";
        }
        if ($folder == null){
          $string .= "<option value='".$imageURL."'>".$imageText."</option>";
        }
    }
    echo $string;
?>
