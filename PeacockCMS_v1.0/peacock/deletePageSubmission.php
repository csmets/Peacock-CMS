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

    $PageName = $_GET['id'];
    $sqlconnect = new Connectdb;
    $db = $sqlconnect->connectTo();
    mysqli_query($db,"DELETE FROM pages WHERE id='$PageName'");
    $db->close();
    header( 'Location: controlpanel.php' );

?>