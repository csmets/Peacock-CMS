<!DOCTYPE html>
<html>
    <head>
        <title>Basic Template Creator</title>
        <link href='http://fonts.googleapis.com/css?family=Arvo|Josefin+Slab:300,400' rel='stylesheet' type='text/css'>
        <link href="view/themes/basic/css/basicPageStyle.css" rel="stylesheet" type="text/css" />    
        <link href="view/css/bootstrap.min.css" rel="stylesheet">
        <?php $peacock->removePageMargins(); ?>
    </head>

    <body>
        <?php
            $peacock->runPeacockEditor(true, 0)
        ?>  
        <div class="basicPageWrapper" style='padding-top:70px'>       
            <div class="basicLinksbar">
                <?php
                    if($peacock->getSiteImage() != null){
                        echo "<center><img src='view/siteImage/".$peacock->getSiteImage()."' width='100px'><br>";
                    }
                    echo "<h2>".$peacock->getSiteName()."</h2></center>";
                ?>
                <img src="view/themes/basic/Images/BasicPageColorsBW.png" height="3px" width="200px">
                <br>
                <?php
                    $peacock->previewPageLinks('','BasicPageBtn','');
                ?>
                <br>
            </div>
            <div class="basicContentWrapper">
                <div id="SaveContent" class="Template-Editable" style="min-height:200px;">
                    <?php
                        $peacock->getTemplateContent();   
                    ?>
                </div>
            </div>
            <?php include ("includes/footer.php");  ?>
        </div>   
    </body>
</html>