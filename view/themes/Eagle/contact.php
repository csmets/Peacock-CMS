<?php
    $Pageid = 3;
    @$formMessage = $_GET['message'];

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
        <link rel="stylesheet" type="text/css" href="/view/themes/Eagle/css/bootstrap.css">
        <script src="/view/themes/Eagle/js/jquery-1.11.0.min.js"></script>
        <script src="/view/themes/Eagle/js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
    </head>

    <body>

        <?php include("includes/header.php"); ?>

        <div class="PageContainer">
            <form method="post" action="sendcontact.php">
                <h1><?php echo $peacock->getPageName($Pageid,true); ?></h1>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <?php echo "<p>".$formMessage."</p>"; ?>
                        <p>
                        <span>Your Name:</span><br />
                        <input class="textfield" name="username" type="text" id="username" size="36" maxlength="32" value="" />
                        <br><span>Your Email: </span><br />
                        <input class="textfield" name="email" type="text" id="email" size="36" maxlength="32" value="" />
                        <br><span>
                          Your Message:
                          </span><br />
                        <textarea class="textfield" name="msg" id="msg" cols="45" rows="5"></textarea>
                        <br />
                        <p class="basicBodyText"><input type="checkbox" name="human" id="human"> I acknowledge the above details are correct.</p>
                        <br>
                        <input type="submit" class="sendBtn" value="Send Now" />
                        </p>
                    </div>
                    <div class="col-md-6">
                        <?php echo $peacock->getPageContent($Pageid); ?>
                    </div>
                </div>
            </form>
        </div>
        <?php include("includes/footer.php"); ?>

    </body>
</html>
