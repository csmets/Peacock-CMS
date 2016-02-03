<?php
	$PostId = $_GET['id'];
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<!-- Title here -->
		<title><?php echo $peacock->getSiteName() . " | Edit ".$peacock->getPostName($PostId,true); ?></title>
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

		<script type="text/javascript" src="/view/themes/lapwing/js/jquery.js"></script>

		<!-- Favicon -->
		<link rel="shortcut icon" href="#">
	</head>

	<body>

		<?php $InlineEditor->run(false, $PostId); ?>

		<!-- Top Starts -->
		<div class="top" style="background-image:url(/view/image/lapwingBGimg.jpg);">


			<!-- Header Starts -->

			<header>
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<div class="logo">
								<h1>
									<a href="index.php"><?php echo $peacock->getSiteName(); ?></a>
								</h1>
							</div>
						</div>
						<div class="navigation pull-right">
							<?php $peacock->getSiteLinks(); ?>
						</div>
					</div>
				</div>
			</header>

			<!-- Header Ends -->

			<!-- Hero starts -->
			<div class='hero inner-page'>
				<div class='container'>
					<div class='row'>
						<div class='col-md-12'>
							<div class='intro'>
								<h2><?php echo $peacock->getPageName($Pageid); ?></h2>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Hero ends -->



		</div>
		<!-- Top Ends -->



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
								<div id="SaveTitleContent" class="Editable-1">
									<?php echo $peacock->getPostName($PostId); ?>
								</div>
								<!-- Blog Meta -->
								<div class="blog-meta">
									<!-- Meta Icons -->
									<i class="fa fa-calendar calender"></i> <?php echo substr($peacock->getPostDate($PostId, true), 0, 10); ?>&nbsp;&nbsp;
									<i class="fa fa-user user"></i> <?php echo $peacock->getPostAuthorName($peacock->getPostAuthor($PostId,true)) ?>&nbsp;&nbsp;
									<i class="fa fa-folder-open folder"></i> <?php echo $peacock->getPostCategory($PostId, true); ?>&nbsp;&nbsp;
								</div>

								<div id="SaveContent" class="Editable-2">
									<?php echo $peacock->getPostContent($PostId, true, true); ?>
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
										<input type="text" name='query' class="form-control searchTextBox searchIcon" placeholder="Search for Posts">
										<input type="submit" class='searchButton' value="Search"/>
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





		<!-- Footer starts -->

		<footer>
			<div class="container">

				<!-- Social -->
				<div class="social text-center">
					<!-- Social Media Icons -->
					<a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
					<a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
					<a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
					<a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
				</div>

				<div class="row">
					<div class="col-md-12">

						<hr>
						<div class="copy text-center">
							&copy; 2016 <?php echo $peacock->getSiteName(); ?> - Designed by <a href="http://peacockcms.com">Peacock CMS</a>
						</div>
					</div>
				</div>

			</div>
		</footer>

		<!-- Footer Ends -->

		<!-- Scroll to top -->

		<span class="totop"><a href="#.home"> <i class="fa fa-chevron-up"></i> </a></span>

		<!-- Javascript files -->
		<!-- jQuery -->
		<!-- <script src="themes/lapwing/js/jquery.js"></script> -->
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
