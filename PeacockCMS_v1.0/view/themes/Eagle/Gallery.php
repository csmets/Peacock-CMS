<?php
    include_once('peacock/plugins/Gallery/GalleryFunctions.php');
    $gallery = new Gallery;
    $Pageid = $gallery->getGalleryPageId();
    @$folder = $_GET['folder'];

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
        <script src="view/js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
    </head>

    <body>
        
        <?php include("includes/header.php"); ?>
        
        <div class="GalleryContentWrapper">	
            
            <?php echo $peacock->getPageContent($Pageid); ?>
            
            <div class="GallerySubFolders">
                <ul>
                <?php $gallery->displayFolderList(false, $folder, 'GallerySubFolderSelect') ?>
                </ul>
            </div>

            <div class="GalleryContent">
                <center>
                <?php 
                    $gallery->createLazyGallery($folder, false, true);
                ?>
                </center>
            </div>
        </div>
        

        <?php include("includes/footer.php"); ?>
        
        <script>
                $("img.lazy").lazyload({
                    effect : "fadeIn"
                });
        </script>
        
    </body>
</html>