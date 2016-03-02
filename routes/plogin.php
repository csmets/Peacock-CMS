<?php

class RouteTo{
  public function destination($url){
    $peacock =new Peacock;
    $Theme = $peacock->getSiteTheme();
    $values = explode("/",$url);
    if ($values[1] != null){
      //Page reference
      $_GET['err'] = $values[1];
    }
    include("./peacock/plogin.php");
  }
}

?>
