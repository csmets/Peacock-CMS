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
    
    $Username = $_SESSION['username'];
    $EditorType = $_GET['editor'];

    if ($EditorType == 'advance' || $EditorType == 'standard'){
        $SendToDatabase = "UPDATE users SET editortype='$EditorType' WHERE username='$Username'";

        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        mysqli_query($db,$SendToDatabase);
        $db->close();
        header("location:dashboard.php");
    }
    else{
       echo "ERROR! Invalid Entry";
    }

    
?>