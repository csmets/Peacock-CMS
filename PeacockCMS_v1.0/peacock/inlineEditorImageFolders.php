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

    $sqlconnect = new Connectdb;
    $db = $sqlconnect->connectTo();
    $data = mysqli_query($db,"SELECT * FROM imageFolders");
    
    while($get_data = mysqli_fetch_assoc($data)){
        $imageFolder = $get_data["folderName"];
        $string .= "<option value='".$imageFolder."'>".$imageFolder."</option>";
    }
    echo $string;
?>