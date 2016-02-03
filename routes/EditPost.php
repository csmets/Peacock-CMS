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
      //Page reference
      $_GET['id'] = $values[1];
    }
    if ($values[2] == 'draft'){
      $_GET['draft'] = 'yes';
    }
    $_GET['type'] = 'blogPost';
    $InlineEditor = new InlineEditor;
    echo '<link href="/peacock/css/PeacockStyles.css" rel="stylesheet" type="text/css" />';
    include("view/themes/".$Theme."/EditPost.php");
  }
}

?>
