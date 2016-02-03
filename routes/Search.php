<?php

class RouteTo{
  public function destination($url){
    $peacock =new Peacock;
    $Theme = $peacock->getSiteTheme();

    $query = $_POST['query'];
  	$Pageid = 2;
  	$search = new Search;
  	$search->linkTo = "blogPost.php?postID=";
    $result = array();
  	$result = $search->searchForResult($query);

    include("./view/themes/".$Theme."/Search.php");
  }
}

?>
