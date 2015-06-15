<?php
	$Pageid = 3;

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



		<!-- Contact starts -->
		<div class="contact block">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-sm-6">
						<div class="formdetails well">
							<form class="form-horizontal" role="form">
								<fieldset>
									<legend>Contact Form</legend>
									<div class="form-group">
										<label for="inputName" class="col-lg-3 control-label">Name</label>
										<div class="col-lg-9">
										  <input type="name" class="form-control" id="inputName" placeholder="">
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail" class="col-lg-3 control-label">Email</label>
										<div class="col-lg-9">
										  <input type="email" class="form-control" id="inputEmail" placeholder="">
										</div>
									</div>
									
									<div class="form-group">
										<label for="inputComment" class="col-lg-3 control-label">Comment</label>
										<div class="col-lg-9">
										  <textarea class="form-control" rows="3"></textarea>
										</div>
									</div>
									<div class="form-group">
										<div class="col-lg-offset-3 col-lg-9">
											<p><input type="checkbox" name="human" id="human"> I acknowledge that the above details are correct.</p>
											<p>&nbsp;</p>
											<button type="submit" class="btn btn-danger">Submit</button>
										</div>
									</div>
								</fieldset>
							</form>
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="well">
							
								<fieldset>
									<?php echo $peacock->getPageContent(3); ?>
								</fieldset>
					
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- contact ends -->



		
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