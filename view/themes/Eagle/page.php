<?php
    $Pageid = $_GET['page'];

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
        <link href="/view/themes/Eagle/css/style.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="/view/themes/Eagle/css/bootstrap.css">
        <script src="/view/themes/Eagle/js/jquery-1.11.0.min.js"></script>
        <script src="/view/themes/Eagle/js/jquery.localscroll.js" type="text/javascript" charset="utf-8"></script>
        <script src="/view/themes/Eagle/js/jquery.scrollto.js" type="text/javascript" charset="utf-8"></script>
        <script src="/view/themes/Eagle/js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
    </head>

    <body>

        <?php include("includes/header.php"); ?>

        <?php
            echo $peacock->getPageContent($Pageid);
        ?>


        <?php include("includes/footer.php"); ?>



    <script src="/view/themes/Eagle/js/jquery.imageScroll.min.js"></script>
    <script>

        function getParameterByName(name) {
            name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
            var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
                results = regex.exec(location.search);
            return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
        }

        $(document).ready(function(){

            var ContactMsg = getParameterByName('message');

            if (ContactMsg != ''){
                $("#contactMessage").show();
                $("#contactMessage").text(ContactMsg);
            }
            else{
                $("#contactMessage").hide();
            }
        });

        $.localScroll();

       function get_browser(){
            var ua=navigator.userAgent,tem,M=ua.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i) || [];
            if(/trident/i.test(M[1])){
                tem=/\brv[ :]+(\d+)/g.exec(ua) || [];
                return 'IE '+(tem[1]||'');
                }
            if(M[1]==='Chrome'){
                tem=ua.match(/\bOPR\/(\d+)/)
                if(tem!=null)   {return 'Opera '+tem[1];}
                }
            M=M[2]? [M[1], M[2]]: [navigator.appName, navigator.appVersion, '-?'];
            if((tem=ua.match(/version\/(\d+)/i))!=null) {M.splice(1,1,tem[1]);}
            return M[0];
        }

        function get_browser_version(){
            var ua=navigator.userAgent,tem,M=ua.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i) || [];
            if(/trident/i.test(M[1])){
                tem=/\brv[ :]+(\d+)/g.exec(ua) || [];
                return 'IE '+(tem[1]||'');
                }
            if(M[1]==='Chrome'){
                tem=ua.match(/\bOPR\/(\d+)/)
                if(tem!=null)   {return 'Opera '+tem[1];}
                }
            M=M[2]? [M[1], M[2]]: [navigator.appName, navigator.appVersion, '-?'];
            if((tem=ua.match(/version\/(\d+)/i))!=null) {M.splice(1,1,tem[1]);}
            return M[1];
        }


        if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
            $('.img-holder').imageScroll({
               parallax: false
            });
        }else{
            var browser = get_browser();
            var version = get_browser_version();
            if ((browser == 'IE') && (version > 10)){
                $('.img-holder').imageScroll({
                   parallax: false
                });
            }else{
                $('.img-holder').imageScroll();
           }
        }
    </script>

    </body>
</html>
