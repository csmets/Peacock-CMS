<?php

	require("plugins/FavouritePosts/FavouritePostsFunction.php");

	class FavouritePostsInit extends Plugin{

		public function query(){
			$query = "
				CREATE TABLE favouritePosts(

					id INT NOT NULL AUTO_INCREMENT,
					PRIMARY KEY(id),
					postID INT(100),
									postOrder INT(100)

				)
			";
			return $query;
		}

		public function title(){
			return 'Favourite Posts';
		}

		public function content(){
			$favouritePosts = new FavouritePosts;
			$array['content-body'] = '
				<div class="pages">'.$favouritePosts->fetchList().
				'
				</div>
				<div class="linkbar">
					<ul>
						<li><a name="AddFavPostsBtn">Add Posts</a></li>
						<li><a name="ArrangeFavPostsBtn">Arrange Posts</a></li>
					</ul>
				</div>
			';
			return $array;
		}

	}


	$favouritePostsInit = new FavouritePostsInit('favouritePosts');
	echo $favouritePostsInit->build();

	$favouritePosts = new FavouritePosts;
 ?>




<!--  Add Posts -->
<div id="AddFavPosts" class="dialogBox" style="width:480px">
    <div class="dialogBoxHeader">
      Choose Posts
    </div>

    <div class="dialogBoxBody">
        Select a post you wish to add: <?php $favouritePosts->displayPostSelectList() ?>
    </div>

		<div class="linkbar">
			<ul>
				<li id="FavPostsSubmit">
					Add Post
				</li>
			</ul>
		</div>
</div>


<!-- Arrange Pages -->
<div id="ArrangeFavPosts" class="dialogBox" style="width:400px;">
    <div class="dialogBoxHeader">
        Arrange Favourite Posts
    </div>
    <div class="dialogBoxBody">
        <p>Drag the items up and down to sort.</p>
        <ul class='MoveableBox' id='pMoveableFavPostsBox'>
        <?php
					$sqlconnect = new Connectdb;
	    		$db = $sqlconnect->connectTo();
            $data = mysqli_query($db,"SELECT * FROM favouritePosts ORDER BY postOrder");
            $favPostOrder = 0;
						$peacockCMS = new Peacock;
            while ($get_data = mysqli_fetch_assoc($data)){
                echo "<li id='favPostItem_".$get_data['postID']."'>".$peacockCMS->getPostName($get_data['postID'],true)."</li>";
            }
        ?>
        </ul>
    </div>
		<div class="linkbar">
			<ul>
				<li id="ArrangeFavPostsSubmit">
					Save
				</li>
			</ul>
		</div>
</div>



<script>
	$(document).ready(function()  {

        $("#AddFavPosts, #ArrangeFavPosts").hide();

        $("a[name=ArrangeFavPostsBtn]").click(function(){
        	$(".dialog-overlay, #ArrangeFavPosts").fadeIn("slow")
        });

        $( "#pMoveableFavPostsBox" ).sortable();
			$('#ArrangeFavPostsSubmit').click(function(){
				var data = $('#pMoveableFavPostsBox').sortable('serialize');
				$.post('plugins/FavouritePosts/FavouritePostsArrange.php',{"data":data}, function(){
					location.reload();
				});
		});

        $("a[name=AddFavPostsBtn]").click(function(){
        	$(".dialog-overlay, #AddFavPosts").fadeIn("slow")
        });

        $("#FavPostsSubmit").click(function(){
        	var AddPost = $("#listOfSelectablePosts").val();
        	$.post('plugins/FavouritePosts/FavouritePostsSubmit.php',{
        		"AddPost" : AddPost
        	}, function(){
        		location.reload();
        	});
        });

        $(".dialog-overlay").click(function () {
       		$("#AddFavPosts, #ArrangeFavPosts").fadeOut("fast");
       		return false;
       	});

	});
</script>
