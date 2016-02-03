<?php
/**
 * @license Copyright (c) 2014 - 2016, Peacock CMS by Clyde Smets <clyde@peacockcms.com>
 * Peacock CMS is under the GNU - General Public License V3.
 */

session_start();

$username = $_POST['username'];
$password = $_POST['password'];
include("../config/config.php");
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
		$_SESSION['username'] = strtolower($username);
    $db->close();
		header("location:dashboard.php");
	}
	else{

		//Try old existing user passwords.
		$password = md5($_POST['password']);
		$SQL = "SELECT * FROM `users` WHERE username='$username' AND password='$password'";
		$Result = mysqli_query($db,$SQL);
		$numrows = mysqli_num_rows($Result);
		if ($numrows == 1){
			$_SESSION['username'] = $username;
	    $db->close();
			header("location:dashboard.php");
		}
		else{
			$errorMessage = "Username or Password is incorrect";
	    header("location:../plogin.php?err=$errorMessage");
		}


	}
}
else{
	$errorMessage = "Please enter your Username / Password";
	header("location:/plogin.php?err=$errorMessage");
}

?>
