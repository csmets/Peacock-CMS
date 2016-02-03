<script src="plugins/lightbox/js/jquery-1.11.0.min.js"></script>
<script src="plugins/lightbox/js/lightbox.min.js"></script>
<link href="plugins/lightbox/css/lightbox.css" rel="stylesheet" />
<link rel="stylesheet" href="plugins/lightbox/css/plightbox.css">

<?php

	include('peacockCMS.php');
	$peacock = new Peacock;
	
	@$PageName = $_GET['name'];
	
	include_once('plugins/SimpleGallery/SimpleGalleryFunctions.php');
	
	$gallery = new Gallery;
	
	$Pageid = $peacock->getPageID($PageName);
	
	include_once ("plugins/SimpleGallery/GallerySettings.php");
	
?>

<!DOCTYPE html>
<html>
	
	
	<head>
		<title><?php echo $peacock->getSiteName() . " | " . $peacock->getPageName($Pageid); ?></title>
		<?php 
		    $peacock->removePageMargins();
		?>
		<link href="themes/MVWB/css/MVWBstyle.css" rel="stylesheet" type="text/css" />
		<link href="font/css/open-iconic.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Alegreya+Sans:300,400' rel='stylesheet' type='text/css'>
		<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
		
	</head>
	
	
	
	
	
	<!-- The Meat of the Page is in here -->
	<body>
		
		
		
			<!-- Navigation Bar -->
			<div id="pageheaderWrapper">
				<a href='index.php' class="pageheaderTitle">
					<?php 
						
						if ($peacock->getSiteImage() != null){
							echo "<img valign='middle' class='pageHeaderImg' src='siteImage/".$peacock->getSiteImage()."'>";
						}
						
						echo $peacock->getSiteName();
						
					?>
				
				</a>
				<?php echo $peacock->displayPageLinks('','pagelinks', ''); ?>
				<div class="headerLinksMenu"><span class="oi" data-glyph="menu">&nbsp;</span><?php echo $peacock->displayPageLinks('','', ''); ?></div>
			</div>
			
			
			
			<div class='GalleryBGI' style='background-image:url(image/<?php echo $peacock->getPageImage($Pageid) ?>)'></div>


			<br>
			<br>
			<br>
			<?php echo $peacock->getPageContent($Pageid); ?>
			
			<center>
			<div id="GalleryContent"></div>
			
			<?php
			
				if ($total_nums>$rowsperpage){
					echo '<input id="loadmore" class="LoadBtn" type="button" value="Load More"> <input id="pages" type="hidden" value="'.$total_pages.'">';
				}
			
			?>
			</center>
		
			<?php include_once('themes/MVWB/footer.php') ?>
		

	
    <script>
    
    
    	$(document).ready(function(){
    	
	    	var ActiveMenu = false;
	    	
	    	$(".headerLinksMenu").click(function(){
	    		if (ActiveMenu == false){
	    			$(".headerLinksMenu ul").css('display','block');
	    			ActiveMenu = true;
	    		}else{
	    			$(".headerLinksMenu ul").css('display','none');
	    			ActiveMenu = false;
	    		}
	    	});
	    	
	    });
	    
	    
    </script>
    
    <script>
			
			$(document).ready(function(){
				
				var page = 2;
				var pages = $("#pages").val(); //Total Number of Pages
				
				
				$("#GalleryContent").load("plugins/SimpleGallery/ImageResults.php");
				
				$("#loadmore").click(function(){
					var next = page++;
					$.get("plugins/SimpleGallery/ImageResults.php?page="+next, function(data){
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