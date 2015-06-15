<?php
	$Pageid = 2;
	$PostId = $_GET['postID'];

    $analytics = new PageAnalytics;
	$analytics->addCount('blog', $PostId);
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<!-- Title here -->
		<title><?php echo $peacock->getSiteName() . " | " . $peacock->getPostName($PostId, true); ?></title>
		<!-- Description, Keywords and Author -->
		<meta name="author" content="PeacockCMS">
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<!-- Styles -->
		<!-- Bootstrap CSS -->
		<link href="view/themes/lapwing/css/bootstrap.min.css" rel="stylesheet">
		<!-- Font awesome CSS -->
		<link href="view/themes/lapwing/css/font-awesome.min.css" rel="stylesheet">	
		<!-- Pretty Photo CSS -->
		<link href="view/themes/lapwing/css/prettyPhoto.css" rel="stylesheet">
		<!-- Custom CSS -->
		<link href="view/themes/lapwing/css/style.css" rel="stylesheet">
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="#">

		<script src="view/js/jquery-1.11.0.min.js"></script>
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

		<?php include_once("includes/header.php"); ?>



		<!-- Blog Starts -->
		
		<div class="blog block">
			<!-- Container -->
			<div class="container">
				<div class="row">
					<div class="col-md-8">
						<!-- Blog Item -->
						<div class="blog-item">
							<!-- Blog Content -->
							<div class="blog-content">
								<!-- Heading -->
								<?php echo $peacock->getPostName($PostId, false); ?>
								<!-- Blog Meta -->
								<div class="blog-meta">
									<!-- Meta Icons -->
									<i class="fa fa-calendar calender"></i> <?php echo substr($peacock->getPostDate($PostId, true), 0, 10); ?>&nbsp;&nbsp;
									<i class="fa fa-user user"></i> <?php echo $peacock->getPostAuthorName($peacock->getPostAuthor($PostId,false)) ?>&nbsp;&nbsp;
									<i class="fa fa-folder-open folder"></i> <?php echo $peacock->getPostCategory($PostId, true); ?>&nbsp;&nbsp;
								</div>
								<a class="fb-share-button" data-href="" data-layout="button_count"></a>
                                <a href="https://twitter.com/share" class="twitter-share-button">Tweet</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

<!-- Place this tag where you want the share button to render. -->
<div class="g-plus" data-action="share" data-annotation="bubble"></div>
								<?php echo $peacock->getPostContent($PostId, true); ?>

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
										<input type="text" name='query' class="form-control searchTextBox searchIcon" placeholder="Search for Posts">
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




		<?php include_once("includes/footer.php"); ?>

		
			
		<!-- Scroll to top -->
		
		<span class="totop"><a href="#.home"> <i class="fa fa-chevron-up"></i> </a></span> 
		
		<!-- Javascript files -->
		<!-- jQuery -->
		<!-- <script src="themes/lapwing/js/jquery.js"></script> -->
		<!-- Bootstrap JS -->
		<script src="view/themes/lapwing/js/bootstrap.min.js"></script>
		<!-- Respond JS for IE8 -->
		<script src="view/themes/lapwing/js/respond.min.js"></script>
		<!-- HTML5 Support for IE -->
		<script src="view/themes/lapwing/js/html5shiv.js"></script>
		<!-- Custom JS -->
		<script src="view/themes/lapwing/js/custom.js"></script>
	</body>	
</html>