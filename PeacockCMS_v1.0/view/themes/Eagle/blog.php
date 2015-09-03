<?php
    include_once('peacock/plugins/FavouritePosts/FavouritePostsFunction.php');
    $favouritePosts = new FavouritePosts;


    $Pageid = 2;

    $analytics = new PageAnalytics;
	$analytics->addCount('pages', $Pageid);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo $peacock->getSiteName() . " | " . $peacock->getPageName($Pageid,true); ?></title>    
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php 
            $peacock->removePageMargins();
        ?>  
        <!-- Google Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,400italic|Roboto:300,400,600' 
              rel='stylesheet' type='text/css' />
        <link href="view/themes/Eagle/css/style.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="view/css/bootstrap.css">
        <script src="view/js/jquery.localscroll.js" type="text/javascript" charset="utf-8"></script>
        <script src="view/js/jquery.scrollto.js" type="text/javascript" charset="utf-8"></script>
        <script src="view/js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
    </head>

    <body>
        
        <?php include("includes/header.php"); ?>
        
        <!-- Blog Starts -->	
		<div class="blog block" style="padding-top:40px;">
			<!-- Container -->
			<div class="container">
				<div class="row">
					<div class="col-md-8">
						<!-- Blog Item -->
						<div class="blog-item">
							<!-- Generated Blog Posts / Content -->
							<!-- Blog Post -->
							<?php					
								$posts = array();

                                @$page = $_GET['page'];							
                                if (!$page){
                                    $page = 1;
                                }							
                                $limit = 5;

                                $pagination = new BlogPagination($page,$limit);

                                $posts = $pagination->getPosts();

                                foreach ($posts as $ID){
									if ($peacock->checkPostIDExistsNoDrafts($ID) == TRUE){
										echo '<div class="blog-content">';
										echo '<h4><a href="blogPost.php?postID='.$ID.'">'.$peacock->getPostName($ID).'</a></h4>';
										echo '<div class="blog-meta">';
										echo '<i class="glyphicon glyphicon-calendar"></i> '
                                            .substr($peacock->getPostDate($ID, false), 0, 10).'&nbsp;&nbsp;';
										echo '<i class="glyphicon glyphicon-user"></i> '
                                            .$peacock->getPostAuthorName($peacock->getPostAuthor($ID,false)).'&nbsp;&nbsp;';
										echo '<i class="glyphicon glyphicon-tag"></i> '.$peacock->getPostCategory($ID, false);
										echo '</div>';
										echo substr($peacock->getPostContent($ID, FALSE), 0, 600);
										echo '<p>&nbsp;</p>';
                                        echo '<p align="right">';
										echo '<a href="blogPost.php?postID='.$ID.'" class="readMoreBtn">Read More...</a></p>';
										echo '<hr>';
										echo '</div>';
									}
								}

                                echo '<div>
                                        <ul class="pagination">';

                                $pageCount = $pagination->getTotalPages();
                                for ($i = 1; $i <= $pageCount; $i++){
                                    if ($i == $page){
                                        echo '<li class="active"><a href="blog.php?page='.$i.'">'.$i.'</a></li>';
                                    } else {
                                        echo '<li><a href="blog.php?page='.$i.'">'.$i.'</a></li>';
                                    }
                                }

                                echo '</ul>
                                </div>';

                                
							?>
						</div>
					</div>
					<div class="col-md-4">
						<!-- Sidebar -->
						<div class="sidebar">
							<!-- Widgets -->
							<div class="widgets">
								<!-- Heading -->
								<h4>Search</h4>
								<!-- Widgets Content -->
								<div class="widgets-content">
									<!-- Input Group -->
									<form action="Search.php" method="POST">
										<input type="text" name='query'
                                               class="searchTextBox searchIcon" placeholder="Search for Posts">
										<input type="submit" class='searchButton' value="Search"/>
									</form>
								</div>
							</div>
                            
                            <?php

                            $favArray = array();
                            $favArray = $favouritePosts->getFavouritePosts();
                            
                            if ($favArray != null){
                                echo '<!-- Widgets -->
                                <div class="widgets">
                                    <h4>Must Reads</h4>
                                    <!-- Widgets Content -->
                                    <div class="widgets-content">
                                        <!-- List -->';

                                            foreach($favArray as $post){
                                                echo $post;
                                                echo "<br>";
                                            }


                                echo'	</div>
                                </div>';
                            }
                            ?>
                            
							<!-- Widgets -->
							<div class="widgets">
								<h4>Categories</h4>
								<!-- Widgets Content -->
								<div class="widgets-content">
									<ul class="list-inline">
										<!-- List -->
										<?php $peacock->blogCategoryLinks('',false); ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
        

        <?php include("includes/footer.php"); ?>
        
    </body>
</html>