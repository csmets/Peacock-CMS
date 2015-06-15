<?php
    include_once('peacock/plugins/SimpleGallery/SimpleGalleryFunctions.php');
	$gallery = new SimpleGallery;	
	$Pageid = $gallery->getGalleryPageId();
	include_once ("peacock/plugins/SimpleGallery/GallerySettings.php");

    $analytics = new PageAnalytics;
	$analytics->addCount('pages', $Pageid);
?>
<!DOCTYPE html>
<!--[if lt IE 9 ]>     <html class="no-js lt-ie10 lt-ie9"> <![endif]-->
<!--[if IE 9 ]>        <html class="no-js ie9 lt-ie10"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title><?php echo $peacock->getSiteName() . " | " . $peacock->getPageName($Pageid,true); ?></title>    
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php 
            $peacock->removePageMargins();
        ?>  
        <!-- Google Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,400italic|Roboto:300,400,600' 
              rel='stylesheet' type='text/css' />
        <link href="view/themes/Eagle/css/style.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="view/css/bootstrap.css">
        <script src="view/js/jquery.localscroll.js" type="text/javascript" charset="utf-8"></script>
        <script src="view/js/jquery.scrollto.js" type="text/javascript" charset="utf-8"></script>
        <script src="view/js/bootstrap.js" type="text/javascript" charset="utf-8"></script>
    </head>

    <body>
        
        <?php include("includes/header.php"); ?>
        
        <div class="GalleryContainer" style="padding-top:60px">
            <?php echo $peacock->getPageContent($Pageid); ?>
            <div id="GalleryContent" class="GalleryImages"></div>
            
            <?php
                if ($total_nums>$rowsperpage){
                    echo "<br><br><center>";
                    echo '<input id="loadmore" class="LargeBtn" type="button" value="Load More">
                    <input id="pages" type="hidden" value="'.$total_pages.'">';
                    echo "</center>";
                }
            ?>
            </center>
        </div>  
        

        <?php include("includes/footer.php"); ?>
        
        <script>
            $(document).ready(function(){
                var page = 2;
                var pages = $("#pages").val(); //Total Number of Pages
                $("#GalleryContent").load("peacock/plugins/SimpleGallery/ImageResults.php");
                $("#loadmore").click(function(){
                    var next = page++;
                    $.get("peacock/plugins/SimpleGallery/ImageResults?page="+next, function(data){
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