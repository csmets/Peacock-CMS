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
?>

<html>

<head>
    <title>Peacock>Dashboard | Delete Category</title>
    <link href="css/PeacockStyles.css" rel="stylesheet" type="text/css" />   
    
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
        
        <!-- Pages Box -->
        <div class="pContentBox">
            <div class="pContentBoxHeader">
                &nbsp;<img src="Images/Icons/Peacock-Icons_Doc.png" width="25" height="25">
                <a class="ph1">DELETE CATEGORY</a>
            </div>
            <div class="pContentBoxContent">
                <?php
                    $CategoryID = $_GET['id'];
                    $CategoryName = $_GET['category'];
                    echo "Are you sure you wish to delete category: <h3>$CategoryName</h3>";
                    echo "<br>";
                    echo "<a class='pLinkTxt' href='deleteCategorySubmit.php?id=".$CategoryID."'>Click here to DELETE</a>";
                ?>
            </div>
        </div>
        
    </div>
    
</body>



</html>