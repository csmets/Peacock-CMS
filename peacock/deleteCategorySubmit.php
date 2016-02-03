<?php
/**
 * @license Copyright (c) 2014 - 2016, Peacock CMS by Clyde Smets <clyde@peacockcms.com>
 * Peacock CMS is under the GNU - General Public License V3.
 */

    session_start();
    include('initPeacock.php');

    $username = $_SESSION['username'];
    $user = new User($username);
    $user->checkUser();
    $peacock = new Peacock;
    $categoryID = $_POST['id'];

    $sqlconnect = new Connectdb;
    $db = $sqlconnect->connectTo();
    mysqli_query($db,"DELETE FROM categories WHERE id='$categoryID'");

    $SendToDatabase = "UPDATE blog SET category='1' WHERE category='$categoryID'";

    mysqli_query($db,$SendToDatabase);
    $db->close();

    echo "success";
?>
