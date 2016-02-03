<?php
    session_start();
    require("../../../config/config.php");
    require('../../../peacockCMS.php');
    require('../../../src/CLASS_user.php');

    $username = $_SESSION['username'];
    $user = new User($username);
    $user->checkUser();
    $peacock = new Peacock;

    $data = $_REQUEST['data'];
    parse_str($data, $str);
    $menu = $str['favPostItem'];

    $sqlconnect = new Connectdb;
    $db = $sqlconnect->connectTo();

    foreach ($menu as $key => $value){
        $key = $key + 1;
        $sendToDatabase = "UPDATE favouritePosts SET postOrder='$key' WHERE postID='$value'";
        mysqli_query($db,$sendToDatabase);
    }
	$db->close();
?>
