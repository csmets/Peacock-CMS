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
    
    $Username = $_SESSION['username'];
    $EditorType = $_GET['editor'];

    if ($EditorType == 'advance' || $EditorType == 'standard'){
        $SendToDatabase = "UPDATE users SET editortype='$EditorType' WHERE username='$Username'";

        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        mysqli_query($db,$SendToDatabase);
        $db->close();
        header("location:controlpanel.php");
    }
    else{
       echo "ERROR! Invalid Entry";
    }

    
?>