<?php

class FavouritePosts{
    
    public function fetchList(){
        $sqlconnect = new Connectdb;
	    $db = $sqlconnect->connectTo(); 
        $data = mysqli_query($db,"SELECT * FROM favouritePosts ORDER BY postOrder");
        
        $peacock = new Peacock;
        
        while ($get_data = mysqli_fetch_assoc($data)){
            $postID = $get_data['postID'];
            $postTitle = $peacock->getPostName($postID,true);
            echo $postTitle."<a href='plugins/FavouritePosts/FavouritePostsRemove.php?id=".$get_data['postID']."' class='pDeleteLinkButton'>Remove</a><br><br>";
        }
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
    
}

?>