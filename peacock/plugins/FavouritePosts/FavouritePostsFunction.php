<?php

class FavouritePosts{

    public function fetchList(){
        $sqlconnect = new Connectdb;
	    $db = $sqlconnect->connectTo();
        $data = mysqli_query($db,"SELECT * FROM favouritePosts ORDER BY postOrder");

        $peacock = new Peacock;
        $list = "";
        while ($get_data = mysqli_fetch_assoc($data)){
            $postID = $get_data['postID'];
            $postTitle = $peacock->getPostName($postID,true);
            $list .= $postTitle."<a href='plugins/FavouritePosts/FavouritePostsRemove.php?id=".$get_data['postID']."' class='pDeleteLinkButton'>Remove</a><br><br>";
        }
        return $list;
    }

    public function displayPostSelectList(){
        $sqlconnect = new Connectdb;
	    $db = $sqlconnect->connectTo();
        $data = mysqli_query($db,"SELECT * FROM blog");

        echo "<select id='listOfSelectablePosts' >";

        while ($get_data = mysqli_fetch_assoc($data)){
            if ($get_data['draft'] != 'yes'){
                echo "<option value='".$get_data['id']."'>".$get_data['posttitle']."</option>";
            }
        }
        echo "</select>";
    }

    public function getFavouritePosts($idOnly = false){
        $sqlconnect = new Connectdb;
	    $db = $sqlconnect->connectTo();
        $data = mysqli_query($db,"SELECT * FROM favouritePosts ORDER BY postOrder");

        $peacock = new Peacock;

        $favPosts = array();

        while($get_data = mysqli_fetch_assoc($data)){
            $postID = $get_data['postID'];
            if ($idOnly == true){
                $favPosts[] = $postID;
            } else {
                $postTitle = $peacock->getPostName($postID,true);
                $favPosts[] = "<a href='blogPost.php?postID=".$postID."'>".$postTitle."</a>";
            }
        }

        return $favPosts;
    }

}

?>
