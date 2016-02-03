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

    $imageID = $_GET['id'];
    $imagename = $_GET['file'];
    $deletePath = "image/"+$imagename;
    unlink($deletePath);
    $sqlconnect = new Connectdb;
    $db = $sqlconnect->connectTo();
    mysqli_query($db,"DELETE FROM images WHERE id='$imageID'");
    $db->close();
    header( 'Location: dashboard.php' ) ;

?>