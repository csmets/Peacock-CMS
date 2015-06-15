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

    $file = $_GET['file'];
    $codeType = $_GET['type'];

    /*Supported Types
        CSS
        HTML
        PHP
    */
    if ($codeType == 'CSS'){
        $highlighter = "language-css";
    }
    elseif($codeType == 'HTML'){
        $highlighter = "language-markup";
    }
    elseif($codeType == 'PHP'){
        $highlighter = "language-php";
    }
    else{
        echo "NO Highlighter Given!";   
    }
?>

<html>

<head>
    <title>Peacock>Dashboard | Edit File</title>
    <link href="font/css/open-iconic.css" rel="stylesheet">
    <link href="css/PeacockStyles.css" rel="stylesheet" type="text/css" />   
    <?php $peacock->removePageMargins(); ?>
    <link href="js/prism.css" rel="stylesheet" />
    <script src="js/jquery-1.11.0.min.js"></script>
</head>

<body class="backgroundColor">
    <script src="js/prism.js"></script>
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
                <a class="ph1">EDIT FILE CODE</a>
            </div>
            <div class="pContentBoxContent">
                <p class="pbodyTxt">Edit the field below to change the file's code.</p>
                <div id="code" class="pCodeEditor" contenteditable="true"><pre><code class="<?php echo $highlighter; ?>"><xmp><?php $peacock->getFileContents($file); ?></xmp></code></pre></div>
                <br>
                <br>
                <input type='hidden' id="subType" name='subType' value='editFile'>
                <input type='hidden' id="file" name='file' value='<?php echo $file ?>'>
                <a class='pSubmitButton' id="submit">Update</a>
            </div>
        </div>
        
    </div>
    
    <script>
        $(document).ready(function(){
            $("#submit").click(function(){
                var code = $("#code").text();
                var subType = $("#subType").val();
                var file = $("#file").val();
                $.post("submission.php",{"code" : code,"subType" : subType,"file" : file}, function(data){
                    
                });
            });
        });
    </script>
    
</body>

</html>