<!-- Favourite Posts Dialog Box -->

<?php

	//Create Table required for plugin if table doesn't exist!
	$peacockCMS = new Peacock;
	if ($peacockCMS->tableExist('favouritePosts') == FALSE){
		$sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
		$sql = "
			CREATE TABLE favouritePosts(
			
				id INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY(id),
				postID INT(100),
                postOrder INT(100)
			
			)
		
		";
		mysqli_query($db,$sql);
		$db->close();
	}
	
	
	include_once("plugins/FavouritePosts/FavouritePostsFunction.php");
	$favouritePosts = new FavouritePosts;

?>





<div class="pContentBox">
    <div class="pContentBoxHeader" name="FavPostsHeader">
        &nbsp;&nbsp;<span class="oi" data-glyph="loop-circular"></span>&nbsp;
        <a class="ph1">Favourite Posts</a>
        <div class='pBoxToggle' id="FavPostsHide">-</div>
        <div class='pBoxToggle' id="FavPostsOpen">+</div>
    </div>

    <div class="pContentBoxContent" name="FavPostsContent">
        
        <?php 
        	$favouritePosts->fetchList();
        ?>
        
        <p align="right">
            <a class="pContentbtn" name="AddFavPostsBtn">
            	Add Posts
            </a>
            <a class="pContentbtn" name="ArrangeFavPostsBtn">
            	Arrange Posts
            </a>
        </p>
    </div>
</div>




<!--  Add Posts -->
<div id="AddFavPosts" class="pDialogBox" style="width:480px; height:180px;"> 	
    <div class="pDialogBoxHeader">
        &nbsp;&nbsp;<span class="oi" data-glyph="plus"></span>&nbsp;Choose Posts
    </div>

    <div class="pDialogBoxContent">
        Select a post you wish to add: <?php $favouritePosts->displayPostSelectList() ?>
        <a href="#" id="FavPostsSubmit" class="pDialogBoxButton">Add Post</a>
    </div>
</div>


<!-- Arrange Pages -->
<div id="ArrangeFavPosts" class="pDialogBox" style="width:400px; height:50%;">
    <div class="pDialogBoxHeader">
        &nbsp;&nbsp;<span class="oi" data-glyph="list"></span>&nbsp;Arrange Favourite Posts
    </div>
    <div class="pDialogBoxContent">         		
        <p>Drag the items up and down to sort.</p>               	
        <ul class='pMoveableBox' id='pMoveableFavPostsBox'>
        <?php
            $data = mysqli_query($db,"SELECT * FROM favouritePosts ORDER BY postOrder");
            $favPostOrder = 0;
            while ($get_data = mysqli_fetch_assoc($data)){  
                echo "<li id='favPostItem_".$get_data['postID']."'>".$peacockCMS->getPostName($get_data['postID'],true)."</li>";  
            }
        ?>
        </ul>
        <br>
        <center>
            <a href="#" id="ArrangeFavPostsSubmit" class="pDialogBoxButton">Save</a>
        </center>                		
    </div>      	
</div>



<script>
	$(document).ready(function()  {
        
        $("#AddFavPosts, #ArrangeFavPosts").hide();
        
        $("a[name=ArrangeFavPostsBtn]").click(function(){
        	$("#dialog-overlay, #ArrangeFavPosts").fadeIn("slow")
        });
        
        $( "#pMoveableFavPostsBox" ).sortable();
			$('#ArrangeFavPostsSubmit').click(function(){
				var data = $('#pMoveableFavPostsBox').sortable('serialize');
				$.post('plugins/FavouritePosts/FavouritePostsArrange.php',{"data":data}, function(){
					location.reload();
				});
		});
        
        $("a[name=AddFavPostsBtn]").click(function(){
        	$("#dialog-overlay, #AddFavPosts").fadeIn("slow")
        });
        
        $("#FavPostsSubmit").click(function(){
        	var AddPost = $("#listOfSelectablePosts").val();
        	$.post('plugins/FavouritePosts/FavouritePostsSubmit.php',{
        		"AddPost" : AddPost
        	}, function(){
        		location.reload();
        	});
        });
        
        $("#dialog-overlay").click(function () {
       		$("#AddFavPosts, #ArrangeFavPosts").fadeOut("fast");
       		return false;
       	});
		
		var ProjectsRanOnce = false;
		
		if ($.cookie('FavPostsCookie') == null){
            $.cookie('FavPostsCookie','close');
        }
	        
	    if (($.cookie('FavPostsCookie') == 'open') && (ProjectsRanOnce == false)){
	        $("div[name=FavPostsContent]").show();
            $("#FavPostsHide").show();
            $("#FavPostsOpen").hide();
	        RanOnce = true;
	    }
	    if (($.cookie('FavPostsCookie') == 'close') && (ProjectsRanOnce == false)){
	        $("div[name=FavPostsContent]").hide();
            $("#FavPostsHide").hide();
            $("#FavPostsOpen").show();
	        RanOnce = true;
	    }
	    $("div[name=FavPostsHeader]").click(function(){
	            $("div[name=FavPostsContent]").toggle();
	            
	            if ($.cookie('FavPostsCookie') == 'open'){
	                var cookie = 'close';
	                $.cookie('FavPostsCookie',cookie );
                    $("#FavPostsHide").hide();
                    $("#FavPostsOpen").show();
	            }
	            else
	            {
	                var cookie = 'open';
	                $.cookie('FavPostsCookie',cookie );
                    $("#FavPostsHide").show();
                    $("#FavPostsOpen").hide();
	            }
	    });
	});
</script>
