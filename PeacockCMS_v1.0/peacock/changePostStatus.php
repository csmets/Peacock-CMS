<?php
/**
 * @license Copyright (c) 2015, Peacock CMS - Clyde Smets. All rights reserved.
 * For licensing, see EULA.rtf
 */

	session_start();
	
	$username = $_SESSION['username'];
	
    include('initPeacock.php');
	$peacock = new Peacock;
    $peacock->checkUser($username);
	
	$postID = $_GET['id'];
	$postStatus = $_GET['status'];
	
	if ($postID != null && ($postStatus == 'hidden' || $postStatus == 'active' || $postStatus == 'disable')){
		$peacock->setActivePostStatus($postID, $postStatus);
		header("location:controlpanel.php");
	}else{
		echo "NO PAGE ID OR INCORRECT STATUS GIVEN";
	}
?>