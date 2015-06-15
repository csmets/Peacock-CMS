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
		<title><?php echo $peacock->GetSiteName() . " | " . $peacock->GetPageName($Pageid); ?></title>
		<?php $peacock->RemovePageMargins(); ?>
		<link href='http://fonts.googleapis.com/css?family=Arvo|Josefin+Slab:300,400' rel='stylesheet' type='text/css'>
        <link href="view/themes/basic/css/basicPageStyle.css" rel="stylesheet" type="text/css" />
        <link href="view/css/bootstrap.min.css" rel="stylesheet">
	</head>	
	<!-- The Meat of the Page is in here -->
	<body>
        <div class="basicPageWrapper">           
            <?php include ("includes/pageLinks.php") ?>            
            <div class="basicContentWrapper">
                <?php echo $peacock->getPageContent($Pageid); ?>
                <div id="GalleryContent" class="GalleryImages"></div>
                <?php
                    if ($total_nums>$rowsperpage){
                        echo '<input id="loadmore" class="LoadBtn" type="button" value="Load More">
                        <input id="pages" type="hidden" value="'.$total_pages.'">';
                    }
                ?>
            </div>            
            <?php include("includes/footer.php"); ?>
        </div>
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