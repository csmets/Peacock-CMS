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
        <link href="/view/themes/Eagle/css/style.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="/view/themes/Eagle/css/bootstrap.css">
        <script src="/view/themes/Eagle/js/jquery-1.11.0.min.js"></script>
        <script src="/view/themes/Eagle/js/jquery.localscroll.js" type="text/javascript" charset="utf-8"></script>
        <script src="/view/themes/Eagle/js/jquery.scrollto.js" type="text/javascript" charset="utf-8"></script>
        <script src="/view/themes/Eagle/js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
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
							<div class="searchResults">

								<h2>Search Results:</h2>

							<?php

								//Search Results
                                if ($result != null){

                                    foreach ($result as $post){
                                        echo '<ul>';
                                        echo '<a href="/blogPost/'.$post.'/'.$peacock->getPostName($post,true).'">';
                                        echo '<li>'.$peacock->getPostName($post).'</li>';
                                        echo '<li>'.$peacock->limitText($peacock->getPostContent($post),200).'</li>';
                                        echo '</a>';
                                        echo '</ul>';
                                    }

                                } else{
                                    echo "No Search Results.";
                                }


							?>

							</div>
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
