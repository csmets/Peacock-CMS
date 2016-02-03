<?php

class RouteTo{
  public function destination($url){
    //session_start();
    $username = $_SESSION['username'];
    $peacock = new Peacock;
    $peacock->checkUser($username);

    $Theme = $peacock->getSiteTheme();

    $_GET['type'] = 'blogPost';
    
    $InlineEditor = new InlineEditor;
    echo '<link href="/peacock/css/PeacockStyles.css" rel="stylesheet" type="text/css" />';
    include("view/themes/".$Theme."/CreatePost.php");
  }
}

?>
