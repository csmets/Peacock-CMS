<?php
/**
 * @license Copyright (c) 2014 - 2016, Peacock CMS by Clyde Smets <clyde@peacockcms.com>
 * Peacock CMS is under the GNU - General Public License V3.
 */

    session_start();
    include('initPeacock.php');

    $username = $_SESSION['username'];
    $peacock = new Peacock;
    $User = new User($username);
    $User->checkUser();

    $sqlconnect = new Connectdb;
    $db = $sqlconnect->connectTo();
    $data = mysqli_query($db,"SELECT * FROM imageFolders");

    while($get_data = mysqli_fetch_assoc($data)){
        $imageFolder = $get_data["folderName"];
        $string .= "<option value='".$imageFolder."'>".$imageFolder."</option>";
    }
    echo $string;
?>
