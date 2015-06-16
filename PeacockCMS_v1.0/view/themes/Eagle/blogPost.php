<?php
    include_once('peacock/plugins/FavouritePosts/FavouritePostsFunction.php');
    $favouritePosts = new FavouritePosts;

    $EditId = $_GET['postID'];

    $analytics = new PageAnalytics;
	$analytics->addCount('blog', $EditId);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo $peacock->getSiteName() . " | " . $peacock->getPostName($EditId,true); ?></title>    
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
        <!-- Place this tag in your head or just before your close body tag. -->
<script src="https://apis.google.com/js/platform.js" async defer></script>
    </head>

    <body>
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.3";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
        
        <?php include("includes/header.php"); ?>

        <!-- Blog Starts -->
		<div class="blog block" style="padding-top:40px;">
			<!-- Container -->
			<div class="container">
				<div class="row">
					<div class="col-md-8">
						<!-- Blog Item -->
						<div class="blog-item">
							<!-- Blog Content -->
							<div class="blog-content">
								<!-- Heading -->
								<?php echo $peacock->getPostName($EditId); ?>
								<!-- Blog Meta -->
								<div class="blog-meta">
									<!-- Meta Icons -->
									<i class="glyphicon glyphicon-calendar"></i> <?php echo substr($peacock->getPostDate($EditId, true), 0, 10); ?>&nbsp;&nbsp;
									<i class="glyphicon glyphicon-user"></i> <?php echo $peacock->getPostAuthorName($peacock->getPostAuthor($EditId,true)) ?>&nbsp;&nbsp;
									<i class="glyphicon glyphicon-tag"></i> <?php echo $peacock->getPostCategory($EditId, true); ?>&nbsp;&nbsp;
                                    
								</div>
                                
                                <div style="text-align:right">
	<a class="fb-share-button" data-href="" data-layout="button_count"></a>
                                <a href="https://twitter.com/share" class="twitter-share-button">Tweet</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

<!-- Place this tag where you want the share button to render. -->
<a class="g-plus" data-action="share" data-annotation="bubble"></a></div>
								<?php echo $peacock->getPostContent($EditId); ?>

								<hr>
							</div>
							<!-- Blog Content -->

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
                            <!-- Widgets -->
							<div class="widgets">
								<h4>Must Reads</h4>
								<!-- Widgets Content -->
								<div class="widgets-content">
                                    <!-- List -->
                                    <?php

                                        $favArray = array();
                                        $favArray = $favouritePosts->getFavouritePosts();

                                        foreach($favArray as $post){
                                            echo $post;
                                            echo "<br>";
                                        }

                                    ?>
								</div>
							</div>
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