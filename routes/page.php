<?php

class RouteTo{
  public function destination($url){
    $peacock =new Peacock;
    $Theme = $peacock->getSiteTheme();
    $values = explode("/",$url);
    if ($values[1] != null){
      //Page reference
      $_GET['page'] = $values[1];
    }
    include("./view/themes/".$Theme."/page.php");
  }
}

?>
