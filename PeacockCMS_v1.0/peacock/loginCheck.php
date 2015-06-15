<?php
/**
 * @license Copyright (c) 2015, Peacock CMS - Clyde Smets. All rights reserved.
 * For licensing, see EULA.rtf
 */

session_start();

$username = $_POST['username'];
$password = $_POST['password'];
$path = $_POST['path'];
$sitePath = "../view/".$path;
include($sitePath."config/config.php");
include("../peacockCMS.php");

if ($username && $password){
	//If information is gathered from database
	
	//$password = md5($password); LEGACY
	$password = hash('ripemd256',$password);
	$SQL = "SELECT * FROM `users` WHERE username='$username' AND password='$password'";
    $sqlconnect = new Connectdb;
    $db = $sqlconnect->connectTo();
	$Result = mysqli_query($db,$SQL);
	$numrows = mysqli_num_rows($Result);
	if ($numrows == 1){
		if ($_COOKIE['sitePath'] =! null){
			setcookie ("sitePath", "", time()-3600*24);
		}
		setcookie("sitePath",$sitePath,time()+3600*24);
		$_SESSION['username'] = strtolower($username);
        $db->close();
		header("location:controlpanel.php");
	}
	else{
        
		//Try old existing user passwords.
		$password = md5($_POST['password']);
		$SQL = "SELECT * FROM `users` WHERE username='$username' AND password='$password'";
		$Result = mysqli_query($db,$SQL);
		$numrows = mysqli_num_rows($Result);
		if ($numrows == 1){
			if ($_COOKIE['sitePath'] =! null){
			setcookie ("sitePath", "", time()-3600*24);
			}
			setcookie("sitePath",$sitePath,time()+3600*24);
			$_SESSION['username'] = $username;
	        $db->close();
			header("location:controlpanel.php");
		}
		else{
			$errorMessage = "Username or Password is incorrect";
	        header("location:../".$path."plogin.php?err=$errorMessage");
		}


	}
}
else{
	$errorMessage = "Please enter your Username / Password";
	header("location:../".$path."plogin.php?err=$errorMessage");
}

?>