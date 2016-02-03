<?php
    $sqlconnect = new Connectdb;
    $db = $sqlconnect->connectTo();

    $analytics = new PageAnalytics;
	$analytics->addCount('pages', 3);

    @$formMessage = $_GET['message'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo $peacock->getSiteName() . " | " . $peacock->getPageName(3); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php $peacock->removePageMargins(); ?>
        <link href='http://fonts.googleapis.com/css?family=Arvo|Josefin+Slab:300,400' rel='stylesheet' type='text/css'>
        <link href="/view/themes/basic/css/basicPageStyle.css" rel="stylesheet" type="text/css" />
        <link href="/view/themes/basic/css/bootstrap.min.css" rel="stylesheet">
        <script type="text/javascript" src="/view/themes/basic/js/jquery-1.11.0.min.js"></script>
    </head>

    <body>
        <div class="basicPageWrapper">
            <?php include ("includes/pageLinks.php") ?>
            <div class="basicContentWrapper">
                <form method="post" action="sendcontact.php">
                  <h1 id="BodyTitle">Contact Message</h1>
                    <hr>
                    <?php echo $peacock->getPageContent(3); ?>
                    <?php echo "<p>".$formMessage."</p>"; ?>
                    <p>
                    <span>Your Name:</span><br />
                    <input class="ContactTextField" name="username" type="text" id="username" size="36" maxlength="32" value="" />
                    <br><span>Your Email: </span><br />
                    <input class="ContactTextField" name="email" type="text" id="email" size="36" maxlength="32" value="" />
                    <br><span>
                      Your Message:
                      </span><br />
                    <textarea class="ContactTextField" name="msg" id="msg" cols="45" rows="5"></textarea>
                    <br />
                    <p class="basicBodyText">Tick if you are human <input type="checkbox" name="human" id="human"></p>
                    <br>
                    <input type="submit" class="BasicButton" value="Send Now" />
                    </p>
                </form>
            </div>
            <?php include("includes/footer.php"); ?>
        </div>
    </body>
    <?php $db->close(); ?>
</html>
