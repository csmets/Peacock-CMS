<?php

class RouteTo{
  public function destination($url){
    $peacock =new Peacock;
    $Theme = $peacock->getSiteTheme();
    include("./view/themes/".$Theme."/contact.php");
  }
}

?>
