<?php
/**
 * @license Copyright (c) 2015, Peacock CMS - Clyde Smets. All rights reserved.
 * For licensing, see EULA.rtf
 */

    session_start();
    include('initPeacock.php');

    $username = $_SESSION['username'];
    $peacock = new Peacock;
    $peacock->checkUser($username);

    $folder = $_REQUEST['folder'];

    $sqlconnect = new Connectdb;
    $db = $sqlconnect->connectTo();
    $data = mysqli_query($db,"SELECT * FROM images");
    
    while($get_data = mysqli_fetch_assoc($data)){
        if ($get_data['imageFolder'] == $folder){
            $imageName = $get_data["imagename"];
            $imageURL = $get_data["image"];
            $imageText = $imageURL;
            if ($imageName != null){
                $imageText = $imageName;
            }
            $string .= "<option value='view/image/".$imageURL."'>".$imageText."</option>";
        }
    }
    echo $string;
?>