<?php
	$EditPage = $_GET['id'];
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<!-- Title here -->
		<title><?php echo $peacock->getSiteName() . " | Edit " . $peacock->getPageName($EditPage, true);  ?></title>
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

		<?php

			if ($EditPage == 1){
				$InlineEditor->run(true, $EditPage);
			}else{
				$InlineEditor->run(false, $EditPage);
			}

		?>


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
			<?php
			if ($EditPage != 1){
				echo "<!-- Hero starts -->
					<div class='hero inner-page'>
						<div class='container'>
							<div class='row'>
								<div class='col-md-12'>
									<div class='intro'>
										<div id='SaveTitleContent' class='Editable'>
											".$peacock->getPageName($EditPage)."
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>";
			}

			?>
			<!-- Hero ends -->


		</div>
		<!-- Top Ends -->



		<!-- Content -->
		<?php

			if ($EditPage != 1){
				echo "<div class='content block' id='SaveContent'>";
					echo $peacock->getPageContent($EditPage);
				"</div>";
			}else{
				echo '<div id="SaveContent">';
				echo $peacock->getPageContent($EditPage);
				echo '</div>';
			}

		?>
		<!-- Content -->



		<!-- Footer starts -->

		<?php include_once("includes/footer.php"); ?>

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
