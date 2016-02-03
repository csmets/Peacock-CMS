<?php
/**
 * @license Copyright (c) 2014 - 2016, Peacock CMS by Clyde Smets <clyde@peacockcms.com>
 * Peacock CMS is under the GNU - General Public License V3.
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
		header("location:dashboard.php");
	}else{
		echo "NO PAGE ID OR INCORRECT STATUS GIVEN";
	}
?>