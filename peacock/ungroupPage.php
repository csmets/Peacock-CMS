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
    $groupID = $_GET['grpID'];
    $sqlconnect = new Connectdb;
    $db = $sqlconnect->connectTo();
    mysqli_query($db,"UPDATE pages SET groupID='0', isGrouped='false' WHERE id='$pageID'");
    $db->close();
    header( 'Location: editPageGroup.php?grpID=' );

?>