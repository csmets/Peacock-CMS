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
?>

<html>

<head>
    <title>Peacock>Dashboard>Edit Page</title>
    <link href="font/css/open-iconic.css" rel="stylesheet">
    <link href="css/PeacockStyles.css" rel="stylesheet" type="text/css" />   
    <?php $peacock->removePageMargins(); ?>
    <script src="js/jquery-1.11.0.min.js"></script>
    <link href='css/peacock-inline-editor-style.css' rel='stylesheet' type='text/css' />
    
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
                <a class="ph1">EDIT PAGE</a>
            </div>
            <div class="pContentBoxContent">
                <p class="pbodyTxt">Edit the fields below to make changes to the page.</p>
                <form action="submission.php" method="post">
                    Page Name: <input class="ptextbox" size="80" type="text" name="pagename" value="<?php echo $peacock->getPageName($pageID); ?>">
                    <br>
                    <br>
                    <div class="Editable" id="SaveContent" style="border:1px solid grey;padding:20px;border-radius:5px;"><?php echo $peacock->getPageContent($pageID); ?></div>
                    <br>
                    <br>
                    <input type="hidden" name="pagecontent" id="pagecontent">
                    <input type='hidden' name='id' value='<?php echo $pageID ?>'>
                    <input type='hidden' name='subType' value='editPage'>
                    <input type='hidden' name='draft' value='no'>
                    <input type='submit' value='Submit'>
                </form>
            </div>
        </div>
        
    </div>
    <script src="js/peacock-inline-editor.js"></script>
    <script>
        $(document).ready(function(){
            var inlineEditor = new init_Peacock_InlineEditor();
            inlineEditor.run();
        });
        
        function Save(){
            var removeEditor = new init_Peacock_InlineEditor();
            removeEditor.removeEditors();
            $("#pagecontent").val($("#SaveContent").html());
            $("#pageForm").submit();
        }
    </script>
</body>


</html>