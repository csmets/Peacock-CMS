<?php
    $PostId = $_GET['id'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo $peacock->getSiteName() . " | Edit ".$peacock->getPostName($PostId,true); ?></title>
        <!-- Description, Keywords and Author -->
        <meta name="author" content="PeacockCMS">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php $peacock->removePageMargins(); ?>
        <link href='http://fonts.googleapis.com/css?family=Arvo|Josefin+Slab:300,400' rel='stylesheet' type='text/css'>
        <link href="/view/themes/basic/css/basicPageStyle.css" rel="stylesheet" type="text/css" />
        <link href="/view/themes/basic/css/bootstrap.min.css" rel="stylesheet">
        <script type="text/javascript" src="/view/themes/basic/js/jquery-1.11.0.min.js"></script>
    </head>

    <body>
        <?php $InlineEditor->run(false, $PostId); ?>

        <div class="basicPageWrapper" style='padding-top:70px'>
            <div class="basicLinksbar">
                <?php
                    if($peacock->getSiteImage() != null){
                        echo "<center><img src='/view/siteImage/".$peacock->getSiteImage()."' width='100px'><br>";
                    }
                    echo "<h2>".$peacock->getSiteName()."</h2></center>";
                ?>
                <img src="/view/themes/basic/Images/BasicPageColorsBW.png" height="3px" width="200px">
                <br>
                <?php
                    $peacock->previewPageLinks('','BasicPageBtn','');
                ?>
                <br>
            </div>
            <div class="basicContentWrapper">
                <ul class='BasicBlogHeadStyle'>
                    <li>
                        <h1>
                        <div id="SaveTitleContent" class="Editable">
                            <?php echo $peacock->getPostName($PostId); ?>
                        </div>
                        </h1>
                    </li>
                    <li>
                        By: <?php echo $peacock->getPostAuthor($PostId, true); ?>
                        Category: <?php echo $peacock->getPostCategory($PostId, true); ?>
                        Posted on: <?php echo $peacock->formatDate(substr($peacock->getPostDate($PostId, true), 0, -9)); ?>
                        Views: <?php echo $peacock->getPostViews($PostId, true); ?>
                    </li>
                </ul>
                <div class="basicBodyText">
                    <div id="SaveContent" class="Editable-1">
                        <?php echo $peacock->getPostContent($PostId, true, true); ?>
                    </div>
                </div>
            </div>
            <?php include ("includes/footer.php");  ?>
        </div>
    </body>

</html>
