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
    <META http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Peacock>Dashboard | Edit Page Source</title>
    <link href="font/css/open-iconic.css" rel="stylesheet">
    <link href="css/PeacockStyles.css" rel="stylesheet" type="text/css" />   
    <?php $peacock->removePageMargins(); ?>
    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/tidyCode.js"></script>
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
                <div id="code" class="pCodeEditor" contenteditable="true" onpaste="OnPaste_StripFormatting(this, event);"></div>
                <br>
                <br>
                <input type='hidden' id="subType" name='subType' value='editPageSource'>
                <input type='hidden' id="id" name='id' value='<?php echo $pageID ?>'>
                <a class='pSubmitButton' id="submit">Save</a>
            </div>
        </div>
        
    </div>
    
    <div id="dirtyCode" style="display:none"><?php echo $peacock->getPageContent($pageID); ?></div>
    
    
    <script>

        $(document).ready(function(){
            
            var runOnce = false;
            
            if (runOnce == false){
                tidyCode($("#dirtyCode").html());
                runOnce = true;
            }
            
            $("#submit").click(function(){
                
                var code = $("#code").text();
                var subType = $("#subType").val();
                var id = $("#id").val();
                $.post("submission.php",{"code" : code,"subType" : subType,"id" : id}, function(data){
                    
                });
            });
        });
        
        var _onPaste_StripFormatting_IEPaste = false;

        function OnPaste_StripFormatting(elem, e) {

            if (e.originalEvent && e.originalEvent.clipboardData && e.originalEvent.clipboardData.getData) {
                e.preventDefault();
                var text = e.originalEvent.originalEvent.clipboardData.getData('text/plain');
                window.document.execCommand('insertText', false, text);
            }
            else if (e.clipboardData && e.clipboardData.getData) {
                e.preventDefault();
                var text = e.clipboardData.getData('text/plain');
                window.document.execCommand('insertText', false, text);
            }
            else if (window.clipboardData && window.clipboardData.getData) {
                // Stop stack overflow
                if (!_onPaste_StripFormatting_IEPaste) {
                    _onPaste_StripFormatting_IEPaste = true;
                    e.preventDefault();
                    window.document.execCommand('ms-pasteTextOnly', false);
                }
                _onPaste_StripFormatting_IEPaste = false;
            }

        }

    </script>
    
</body>

</html>