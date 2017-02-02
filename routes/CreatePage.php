<?php

class RouteTo{
  public function destination($url){
    //session_start();
    $username = $_SESSION['username'];
    $peacock = new Peacock;
    $peacock->checkUser($username);

    $Theme = $peacock->getSiteTheme();
    $values = explode("/",$url);
    if ($values[1] != null){
      //Page Type
      $_GET['type'] = $values[1];
    }
    if (@$values[2] != null){
      //Page Template
      $_GET['template'] = $values[2];
    }
    if (@$values[3] == 'yes'){
      $_GET['e'] = 'yes';
    }

    $InlineEditor = new InlineEditor;
    
    echo '<link href="/peacock/css/PeacockStyles.css" rel="stylesheet" type="text/css" />';
    include("./view/themes/".$Theme."/CreatePage.php");
  }
}

?>
