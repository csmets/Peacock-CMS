<?php

class RouteTo{
  public function destination($url){
    $peacock =new Peacock;
    $Theme = $peacock->getSiteTheme();
    $values = explode("/",$url);
    if (isset($values[1])){
      //Page reference
      if ($values[1] == 'page'){
        $_GET['page'] = $values[2];
      }
    }
    include("./view/themes/".$Theme."/blog.php");
  }
}

?>
