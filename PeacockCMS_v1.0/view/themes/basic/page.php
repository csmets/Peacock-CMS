<?php
    $Pageid = $_GET['page'];

    $analytics = new PageAnalytics;
	$analytics->addCount('pages', $Pageid);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo $peacock->getSiteName() . " | " . $peacock->getPageName($Pageid); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">        
        <?php $peacock->removePageMargins(); ?>            
        <link href='http://fonts.googleapis.com/css?family=Arvo|Josefin+Slab:300,400' rel='stylesheet' type='text/css'> 
        <link href="view/themes/basic/css/basicPageStyle.css" rel="stylesheet" type="text/css" />
        <link href="view/css/bootstrap.min.css" rel="stylesheet">
    </head>
        
    <body>        
        <div class="basicPageWrapper">
            <?php include ("includes/pageLinks.php") ?>
            <div class="basicContentWrapper">    
                <?php $peacock->getPageContent($Pageid); ?>
            </div>
            <?php include("includes/footer.php"); ?>            
        </div>
    </body>
</html>