<?php
    $EditPage = $_GET['id'];
?>
<!DOCTYPE html>
<!--[if lt IE 9 ]>     <html class="no-js lt-ie10 lt-ie9"> <![endif]-->
<!--[if IE 9 ]>        <html class="no-js ie9 lt-ie10"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title><?php echo $peacock->getSiteName() . " | ".$peacock->getPageName($EditPage); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php
            $peacock->removePageMargins();
        ?>
        <!-- Google Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,400italic|Roboto:300,400,600'
              rel='stylesheet' type='text/css' />
        <link href="/view/themes/Eagle/css/style.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="/view/themes/Eagle/css/bootstrap.css">
        <script src="/view/themes/Eagle/js/jquery-1.11.0.min.js"></script>
        <script src="/view/themes/Eagle/js/jquery.localscroll.js" type="text/javascript" charset="utf-8"></script>
        <script src="/view/themes/Eagle/js/jquery.scrollto.js" type="text/javascript" charset="utf-8"></script>
        <script src="/view/themes/Eagle/js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
    </head>

    <body>

        <?php $InlineEditor->run(true, $EditPage); ?>


        <div id="SaveContent">

            <?php
                echo $peacock->getPageContent($EditPage);
            ?>

        </div>

        <?php include("includes/footer.php"); ?>

    </body>
</html>
