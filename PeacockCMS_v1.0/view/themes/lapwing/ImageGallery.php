<?php
	include_once('peacock/plugins/SimpleGallery/SimpleGalleryFunctions.php');
	$simpleGallery = new SimpleGallery;	
	$Pageid = $simpleGallery->getGalleryPageId();
	include_once ("peacock/plugins/SimpleGallery/GallerySettings.php");

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



		<!-- Content -->
        <div class="container">
            <div class="about-us block">
            <?php
                echo $peacock->getPageContent($Pageid);
            ?>
            <br></br>
            <center>
            <div id="GalleryContent" class="GalleryImages"></div>
            <?php
                if ($total_nums>$rowsperpage){
                    echo "<br>";
                    echo '<input id="loadmore" class="btn btn-danger" type="button" value="Load More">
                    <input id="pages" type="hidden" value="'.$total_pages.'">';
                }
            ?>
            </center>
            </div>
        </div>
		<!-- Content -->
        
        
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
        
        <script>
            $(document).ready(function(){
                var page = 2;
                var pages = $("#pages").val(); //Total Number of Pages
                $("#GalleryContent").load("peacock/plugins/SimpleGallery/ImageResults.php");
                $("#loadmore").click(function(){
                    var next = page++;
                    $.get("peacock/plugins/SimpleGallery/ImageResults.php?page="+next, function(data){
                        if (next == pages){
                            $("#loadmore").remove();
                        }
                        $("#GalleryContent").append(data);
                    });
                });
            }); 			
        </script>
	</body>	
</html>