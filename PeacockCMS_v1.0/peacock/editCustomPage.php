<?php
/**
 * @license Copyright (c) 2015, Peacock CMS - Clyde Smets. All rights reserved.
 * For licensing, see EULA.rtf
 */

    session_start();
    include('initPeacock.php');


    $username = $_SESSION['username'];
    $peacock = new Peacock;
    $peacock->checkUser($username);

    $PageName = $_GET['page'];
    $PageURL = $_GET['url'];
    $PageID = $_GET['id'];
	@$PageEdit = $_GET['edit'];
?>

<html>

<head>
    <title>Peacock>Dashboard | Edit Custom Page</title>
    <link href="css/PeacockStyles.css" rel="stylesheet" type="text/css" />   
    <link href="font/css/open-iconic.css" rel="stylesheet">
    <?php $peacock->removePageMargins(); ?>
    
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
        
        <!-- Content Box -->
        <div class="pContentBox">
            <div class="pContentBoxHeader">
                &nbsp;&nbsp;<span class="oi" data-glyph="link-intact"></span>&nbsp;
                <a class="ph1">Edit Custom Link</a>
            </div>
            <div class="pContentBoxContent">
                <form action="submission.php" method='post'>
                    <?php
                        echo "Custom Page Name: <input size='60' type='text' name='PageName' value='".$PageName."'><br><br>";
                        echo "Custom Page Link: <input size='60' type='text' name='PageLink' value='".$PageURL."'><br><br>";
						echo "Edit Custom Page Link: <input size='60' type='text' name='EditPageLink' value='".$PageEdit."' placeholder='Not Required Advanced Users Only'><br><br>";
                    ?>
                    <input type='hidden' name='id' value='<?php echo $PageID; ?>'>
                    <input type='hidden' name='subType' value='editCustomPage'>
                    <input type='submit' value='Update Link'>
                </form>
            </div>
        </div>
        
    </div>
    
</body>



</html>