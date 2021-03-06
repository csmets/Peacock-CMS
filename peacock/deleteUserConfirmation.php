<?php
/**
 * @license Copyright (c) 2014 - 2016, Peacock CMS by Clyde Smets <clyde@peacockcms.com>
 * Peacock CMS is under the GNU - General Public License V3.
 */

    session_start();
    include('initPeacock.php');

    $username = $_SESSION['username'];
    $peacock = new Peacock;
    $peacock->checkUser($username);

    $UserID = $_GET['id'];
    $username = $_GET['user'];
?>

<html>

<head>
    <title>Peacock>Dashboard | Delete User</title>
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
                <td width='60%' align='left'><br><a href='dashboard.php' class='plinkTxt'>Return to Control Panel</a></td>
                <td align='left'></td>
            </tr>
        </table>
        </center>
        
        <!-- Delete Box -->
        <div class="pContentBox">
            <div class="pContentBoxHeader">
                &nbsp;&nbsp;<span class="oi" data-glyph="trash"></span>&nbsp;
                <a class="ph1">DELETE USER</a>
            </div>
            <div class="pContentBoxContent">
                <?php
                    echo "<p class='pbodyTxt'>Are you sure you want to delete user " . $username . "?</p>";
                    echo "<a href='deleteUserSubmission.php?id=$UserID' class='pLinkTxt'>Click here to delete</a>";
                ?>
            </div>
        </div>
        
    </div>
    
</body>



</html>