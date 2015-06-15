<?php
	session_start();
    define("SITE_PATH", $_COOKIE['sitePath']);
    include("../../".SITE_PATH."config/config.php");
    include('../../../src/CLASS_Connectdb.php');
    include("../../../src/CLASS_peacock.php");
	
    $username = $_SESSION['username'];
    $peacock = new Peacock;
    $peacock->checkUser($username);

	if (isset($_REQUEST['data'])){
	
		$data = $_REQUEST['data'];
		parse_str($data, $str);
		$menu = $str['item'];
		
		$sqlconnect = new Connectdb;
	    $db = $sqlconnect->connectTo();
		
		foreach ($menu as $key => $value){
			$key = $key + 1;
			$sendToDatabase = "UPDATE gallery SET imageOrder='$key' WHERE id='$value'";
			mysqli_query($db,$sendToDatabase);
		}
			
	    $db->close();
   }else{
   	header("location:../../controlpanel.php");
   }

?>