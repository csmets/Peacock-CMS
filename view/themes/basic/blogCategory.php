<?php
    $Category = $_GET['id'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo $peacock->getSiteName() . " | Blog | " . $peacock->getCategory($Category); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='http://fonts.googleapis.com/css?family=Arvo|Josefin+Slab:300,400' rel='stylesheet' type='text/css'>
        <link href="/view/themes/basic/css/basicPageStyle.css" rel="stylesheet" type="text/css" />
        <link href="/view/themes/basic/css/bootstrap.min.css" rel="stylesheet">
        <script type="text/javascript" src="/view/themes/basic/js/jquery-1.11.0.min.js"></script>
        <?php $peacock->removePageMargins(); ?>
    </head>

    <body>
    <div class="basicPageWrapper">
        <?php include ("includes/blogLinks.php") ?>
        <div class="basicContentWrapper">
            <?php echo "<h1>Posts for ".$peacock->getCategory($Category)."</h1>"; ?>
            <div class="categoryPosts">
                <?php $peacock->displayBlogCategoryPosts($Category); ?>
            </div>
        </div>
        <?php include("includes/footer.php"); ?>
    </div>
    </body>
</html>
