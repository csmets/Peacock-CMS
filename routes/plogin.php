<?php

class RouteTo{
  public function destination($url){
	$peacock =new Peacock;
	$Theme = $peacock->getSiteTheme();
	$values = explode("/",$url);
	$error = (isset($values[1])) ? $values[1] : null;
	if ($error != null){
	  //Page reference
	  $_GET['err'] = $error;
	}
	include("./peacock/plogin.php");
  }
}

?>
