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

    $pageID = $_GET['id'];
    $status = $_GET['status'];

    $SentToDatabase = "UPDATE pages SET status='$status' WHERE id='$pageID'";

    $ErrorMessage = "No valid status";

    if ($pageID != null && $status != null){
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        mysqli_query($db,$SentToDatabase);
        $db->close();
        header("location:dashboard.php");
    }
    else {
        header("location:dashboard.php?message=$ErrorMessage");
    }

?>