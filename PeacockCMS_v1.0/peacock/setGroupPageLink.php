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
	
	$grpID = $_GET['grp'];
?>

<html>

<head>
    <title>Peacock | Set Group Page Link</title>
    <link href="css/PeacockStyles.css" rel="stylesheet" type="text/css" />
    <link href="plugins/Gallery/GalleryStyles.css" rel="stylesheet" type="text/css" />   
    <?php $peacock->removePageMargins(); ?>
    <link href="font/css/open-iconic.css" rel="stylesheet">
    <script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui.min.js"></script>
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
                &nbsp; &nbsp;<span class="oi" data-glyph="aperture"></span>&nbsp;
                <a class="ph1">SET <underline><?php echo $grpName ?></underline> Link</a>
            </div>
            <div class="pContentBoxContent">
                <p class="pbodyTxt">Select the link from the list box.</p>
               	
               	<form action="submission.php" method="post" >
                    <?php
                        if ($peacock->getPageData($grpID, "additional") != null){
                            echo '<input class="ptextbox" size="100" name="url" value="'.$peacock->getPageData($grpID, "additional").'"/>';
                        }else{
                            echo '<input class="ptextbox" size="100" name="url" placeholder="insert URL here"/>';
                        }
                    ?>
                    
                    
                    <input type="hidden" name="subType" value="groupLink" />
                    <input type="hidden" name="grpID" value="<?php echo $grpID ?>" />
                    
                    <input class='pSubmitButton' type="submit" value="Make Link" />
                
                </form>
            </div>
        </div>
        
    </div>
    
    
</body>


</html>