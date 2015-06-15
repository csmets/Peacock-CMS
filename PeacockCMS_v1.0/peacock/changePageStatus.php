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
	
	$pageID = $_GET['id'];
	$pageStatus = $_GET['status'];
	
	if ($pageID != null && ($pageStatus == 'hidden' || $pageStatus == 'active' || $pageStatus == 'disable')){
		$peacock->setActiveStatus($pageID, $pageStatus);
		header("location:controlpanel.php");
	}else{
		echo "NO PAGE ID OR INCORRECT STATUS GIVEN";
	}
?>