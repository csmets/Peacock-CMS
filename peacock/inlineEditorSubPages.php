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


    $sqlconnect = new Connectdb;
    $db = $sqlconnect->connectTo();
    $data = mysqli_query($db,"SELECT * FROM pages");

    while($get_data = mysqli_fetch_assoc($data)){
        $pagename = $get_data['pagename'];
        $linkValue = "page.php?page=".$get_data['id'];
        if ($get_data['pagetype'] == 'subpage'){
            $string .= "<option value='".$linkValue."'>".$pagename."</option>";
        }
    }
    echo $string;
?>
