<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo $peacock->getSiteName() . " | Create Post"; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php
            $peacock->removePageMargins();
        ?>
        <!-- Google Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,400italic|Roboto:300,400,600'
              rel='stylesheet' type='text/css' />
        <link href="view/themes/Eagle/css/style.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="/view/themes/Eagle/css/bootstrap.css">
        <script src="/view/themes/Eagle/js/jquery-1.11.0.min.js"></script>
        <script src="/view/themes/Eagle/js/jquery.localscroll.js" type="text/javascript" charset="utf-8"></script>
        <script src="/view/themes/Eagle/js/jquery.scrollto.js" type="text/javascript" charset="utf-8"></script>
        <script src="/view/themes/Eagle/js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
    </head>

    <body>

        <?php $InlineEditor->run(false, 0); ?>


        <!-- Blog Starts -->

		<div class="blog block" style="padding-top:80px;">
			<!-- Container -->
			<div class="container">
				<div class="row">
					<div class="col-md-8">
						<!-- Blog Item -->
						<div class="blog-item">
							<!-- Blog Content -->
							<div class="blog-content">
								<!-- Heading -->
								<div id="SaveTitleContent" class="Editable">
									<h4>Blog Post Title</h4>
								</div>
								<!-- Blog Meta -->
								<div class="blog-meta">
									<!-- Meta Icons -->
									<i class="glyphicon glyphicon-calendar"></i> --/--/----&nbsp;&nbsp;
									<i class="glyphicon glyphicon-user"></i> <?php echo $peacock->getPostAuthorName($username); ?>&nbsp;&nbsp;
									<i class="glyphicon glyphicon-tag"></i> <a href="#">NONE</a>&nbsp;&nbsp;
								</div>

								<div id="SaveContent" class="Editable-1">
									Click here to start creating your post.
								</div>

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
										<input type="text" name='query' class="searchTextBox searchIcon" placeholder="Search for Posts">
										<input type="submit" class='searchButton' value="Search"/>
								</div>
							</div>
							<!-- Widgets -->
							<div class="widgets">
								<h4>Categories</h4>
								<!-- Widgets Content -->
								<div class="widgets-content">
									<ul class="list-inline">
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
