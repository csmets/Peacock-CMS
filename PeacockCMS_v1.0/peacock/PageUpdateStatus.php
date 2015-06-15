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

    $pageID = $_GET['id'];
    $status = $_GET['status'];

    $SentToDatabase = "UPDATE pages SET status='$status' WHERE id='$pageID'";

    $ErrorMessage = "No valid status";

    if ($pageID != null && $status != null){
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        mysqli_query($db,$SentToDatabase);
        $db->close();
        header("location:controlpanel.php");
    }
    else {
        header("location:controlpanel.php?message=$ErrorMessage");
    }

?>