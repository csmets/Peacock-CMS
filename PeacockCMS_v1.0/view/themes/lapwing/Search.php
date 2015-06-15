<?php

	$query = $_POST['query'];
	
	$search = new Search;
	$search->linkTo = "blogPost.php?postID=";
	$result = $search->searchForResult($query); 

?>

<?php
	$Pageid = PAGE_ID;
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

							<div class="searchResults">

								<h2>Search Results:</h2>

							<?php

								//Search Results

								echo $result;


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