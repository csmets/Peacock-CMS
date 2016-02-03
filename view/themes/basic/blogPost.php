<?php
    $ID = $_GET['postID'];

    $analytics = new PageAnalytics;
	$analytics->addCount('blog', $ID);
?>
<?php
    include("includes/navbar.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo $peacock->getSiteName() . " | Blog | " . $peacock->getPostName($ID,true); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='http://fonts.googleapis.com/css?family=Arvo|Josefin+Slab:300,400' rel='stylesheet' type='text/css'>
        <link href="/view/themes/basic/css/basicPageStyle.css" rel="stylesheet" type="text/css" />
        <link href="/view/themes/basic/css/bootstrap.min.css" rel="stylesheet">
        <script type="text/javascript" src="/view/themes/basic/js/jquery-1.11.0.min.js"></script>
        <?php $peacock->removePageMargins(); ?>
        <!-- Place this tag in your head or just before your close body tag. -->
<script src="https://apis.google.com/js/platform.js" async defer></script>
    </head>

    <body>
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.3";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>


        <div class="basicPageWrapper">
            <?php include ("includes/blogLinks.php") ?>
            <div class="basicContentWrapper">
                <?php
                    $LatestPostID = $peacock->getLastPostID();

                    if ($ID != null){

                        //Display navigation to older posts if it exists
                        if ($peacock->checkPostIDExistsNoDrafts($ID) == true){
                            displayBlogNavLinks ($ID, 'BasicBlogNavStyle');
                        }

                        echo "<div class='blogPost'>";

                        //Display the blog post header
                        echo "<h1>".$peacock->getPostName($ID)."</h1>";
                        echo "<p><b>Author:</b> ".$peacock->getPostAuthorName($peacock->getPostAuthor($ID))
                            .", <b>Category:</b> ".$peacock->getPostCategory($ID)
                            .", <b>Posted on:</b> ".$peacock->formatDate(substr($peacock->getPostDate($ID), 0, -9))
                            .", <b>Views:</b> ".$peacock->getPostViews($ID)
                            ."</p>";
                        ?>

                	<a class="fb-share-button" data-href="" data-layout="button_count"></a>
                                <a href="https://twitter.com/share" class="twitter-share-button">Tweet</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

<!-- Place this tag where you want the share button to render. -->
<a class="g-plus" data-action="share" data-annotation="bubble"></a><br><br>

                <?php
                        echo $peacock->getPostContent($ID)."</div>";

                        //Display navigation to older posts if it exists (footer)
                        if ($peacock->checkPostIDExistsNoDrafts($ID) == true){
                            displayBlogNavLinks ($ID, 'BasicBlogNavStyle');
                        }

                    }else{
                        echo "No Posts Exist";
                    }
                ?>
            </div>
            <?php include("includes/footer.php"); ?>
        </div>
    </body>
</html>
