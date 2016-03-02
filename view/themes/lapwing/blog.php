<?php
	$Pageid = 2;

    $analytics = new PageAnalytics;
	$analytics->addCount('pages', $Pageid);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<!-- Title here -->
		<title><?php echo $peacock->getSiteName() . " | " . $peacock->getPageName($Pageid, true); ?></title>
		<!-- Description, Keywords and Author -->
		<meta name="author" content="PeacockCMS">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Styles -->
		<!-- Bootstrap CSS -->
		<link href="/view/themes/lapwing/css/bootstrap.min.css" rel="stylesheet">
		<!-- Font awesome CSS -->
		<link href="/view/themes/lapwing/css/font-awesome.min.css" rel="stylesheet">
		<!-- Pretty Photo CSS -->
		<link href="/view/themes/lapwing/css/prettyPhoto.css" rel="stylesheet">
		<!-- Custom CSS -->
		<link href="/view/themes/lapwing/css/style.css" rel="stylesheet">
		<!-- Favicon -->
		<link rel="shortcut icon" href="#">
		<script type="text/javascript" src="/view/themes/lapwing/js/jquery.js"></script>
	</head>

	<body>
		<?php include_once("includes/header.php"); ?>
		<!-- Blog Starts -->
		<div class="blog block">
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

										$limit = $peacock->getPostCharLimit($ID);

										if ($limit == 0){
											$limit = 600;
										}

										echo '<div class="blog-content">';
											echo '<h4><a href="/blogPost/'.$ID.'">'.$peacock->getPostName($ID).'</a></h4>';
											echo '<div class="blog-meta">';
											echo '<i class="fa fa-calendar calender"></i> '
	                                            .substr($peacock->getPostDate($ID, false), 0, 10).'&nbsp;&nbsp;';
											echo '<i class="fa fa-user user"></i> '
	                                            .$peacock->getPostAuthorName($peacock->getPostAuthor($ID,false)).'&nbsp;&nbsp;';
											echo '<i class="fa fa-folder-open folder"></i> '.$peacock->getPostCategory($ID, false);
											echo '</div>';
											echo substr($peacock->getPostContent($ID, FALSE), 0, $limit);
											echo '<p>&nbsp;</p>';
											echo '<a href="/blogPost/'.$ID.'" class="btn btn-sm btn-danger">Read More...</a>';
											echo '<hr>';
										echo '</div>';
									}
								}

                                echo '<div>
                                        <ul class="pagination">';

                                $pageCount = $pagination->getTotalPages();
                                for ($i = 1; $i <= $pageCount; $i++){
                                    if ($i == $page){
                                        echo '<li class="active"><a href="/blog/'.$i.'">'.$i.'</a></li>';
                                    } else {
                                        echo '<li><a href="/blog/'.$i.'">'.$i.'</a></li>';
                                    }
                                }

                                echo '</ul>
                                </div></div>';

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
									<form action="/Search" method="POST">
										<input type="text" name='query'
                                               class="form-control searchTextBox searchIcon" placeholder="Search for Posts">
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
                            <!-- Widgets -->
							<div class="widgets">
								<h4>Blog Posts</h4>
								<!-- Widgets Content -->
								<div class="widgets-content">
									<ul class="list-inline">
										<!-- List -->
										<?php $peacock->displayBlogPostYearList(); ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Footer starts -->
		<?php include_once("includes/footer.php"); ?>
		<!-- Footer Ends -->

		<!-- Scroll to top -->
		<span class="totop"><a href="#.home"> <i class="fa fa-chevron-up"></i> </a></span>

		<!-- Javascript files -->
		<!-- Bootstrap JS -->
		<script src="/view/themes/lapwing/js/bootstrap.min.js"></script>
		<!-- Respond JS for IE8 -->
		<script src="/view/themes/lapwing/js/respond.min.js"></script>
		<!-- HTML5 Support for IE -->
		<script src="/view/themes/lapwing/js/html5shiv.js"></script>
		<!-- Custom JS -->
		<script src="/view/themes/lapwing/js/custom.js"></script>
	</body>
</html>
