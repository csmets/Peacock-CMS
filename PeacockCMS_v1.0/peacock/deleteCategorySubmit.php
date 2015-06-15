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
    
    $categoryID = $_GET['id'];

    $sqlconnect = new Connectdb;
    $db = $sqlconnect->connectTo();
    mysqli_query($db,"DELETE FROM categories WHERE id='$categoryID'");

    $SendToDatabase = "UPDATE blog SET category='1' WHERE category='$categoryID'";

    mysqli_query($db,$SendToDatabase);
    $db->close();
    header( 'Location: controlpanel.php' ) ;
?>