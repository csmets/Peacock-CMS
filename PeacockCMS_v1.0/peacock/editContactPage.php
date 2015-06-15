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

    $ContactID = $_GET['id'];

    $GetPage = "SELECT * FROM pages WHERE id='$ContactID'";
    $sqlconnect = new Connectdb;
    $db = $sqlconnect->connectTo();
    $data = mysqli_query($db,$GetPage);

    $Retrieve = mysqli_fetch_array($data);
?>

<html>

<head>
    <title>Peacock>Dashboard | Edit Contact Page</title>
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
                <a class="ph1">EDIT CONTACT PAGE</a>
            </div>
            <div class="pContentBoxContent">
                <p class="pbodyTxt">Edit the fields below to make changes to the contact page</p>
                <form action="submission.php" method="post" id="pageForm">
                
                    Contact Page Name: <input class="ptextbox" size="80" type="text" name="title" value="<?php echo $Retrieve['pagename']; ?>">
                    <br>
                    <br>
                    Contact Page Image: <input class="ptextbox" size="80" type="text" name="image" value="<?php echo $Retrieve['image']; ?>">
                    <br>
                    <br>
                    Email Address to send to: <input class="ptextbox" size="80" type="text" name="email" value="<?php echo $Retrieve['additional']; ?>">
                    <br>
                    <br>
                    Contact Page Description:<br><br>
                    <div class="pTextAreaField"><div class="Editable" id="SaveContent"><?php echo $Retrieve['bodycontent']; ?></div></div>
                    <br>
                    <br>
                    
                    <input type="hidden" name="contactbody" id="contactContent">
                    <input type='hidden' name='id' value='<?php echo $ContactID ?>'>
                    <input type='hidden' name='subType' value='editContactPage'>
                    <input type='button' value='Update' onclick="Save()">
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
            $("#contactContent").val($("#SaveContent").html());
            $("#pageForm").submit();
        }
    </script>
</body>
<?php $db->close();?>


</html>