<?php
/**
 * @license Copyright (c) 2015, Peacock CMS - Clyde Smets. All rights reserved.
 * For licensing, see EULA.rtf
 */

    session_start();
    include("initPeacock.php");

    $username = $_SESSION['username'];
    $peacock = new Peacock;
    $peacock->checkUser($username);

    $pageID = $_GET['id'];


    $highlighter = "language-markup";

?>

<html>

<head>
    <META http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Peacock>Dashboard | Edit Page Source</title>
    <link href="font/css/open-iconic.css" rel="stylesheet">
    <link href="css/PeacockStyles.css" rel="stylesheet" type="text/css" />   
    <?php $peacock->removePageMargins(); ?>
    <script src="js/jquery-1.11.0.min.js"></script>
</head>

<body class="backgroundColor">
    <?php include("includes/header.php"); ?>
    <div id="pContentWrapper">
        <center>
        <table width='100%'>  
            <tr>
                <td width='60%' align='left'><p class='ph2'><?php $peacock->peacockVersion() ?></p></td>
                <td align='left'></td>
            </tr>
            <tr>
                <td width='60%' align='left'><br><a href='controlpanel.php' class='plinkTxt'>Return to Control Panel</a></td>
                <td align='left'></td>
            </tr>
        </table>
        </center>
        <!-- Pages Box -->
        <div class="pContentBox">
            <div class="pContentBoxHeader">
                &nbsp;&nbsp;<span class="oi" data-glyph="document"></span>&nbsp;
                <a class="ph1">EDIT PAGE SOURCE</a>
            </div>
            <div class="pContentBoxContent">
                <p class="pbodyTxt">Edit the field below to change the page's code.</p>
                <div id="code" class="pCodeEditor" contenteditable="true"><pre><code><xmp><?php echo $peacock->getPageContent($pageID); ?></xmp></code></pre></div>
                <br>
                <br>
                <input type='hidden' id="subType" name='subType' value='editPageSource'>
                <input type='hidden' id="id" name='id' value='<?php echo $pageID ?>'>
                <a class='pSubmitButton' id="submit">Save</a>
            </div>
        </div>
        
    </div>
    
    <script>
        $(document).ready(function(){
            $("#submit").click(function(){
                var code = $("#code").text();
                var subType = $("#subType").val();
                var id = $("#id").val();
                $.post("submission.php",{"code" : code,"subType" : subType,"id" : id}, function(data){
                    
                });
            });
        });

    </script>
    
</body>

</html>