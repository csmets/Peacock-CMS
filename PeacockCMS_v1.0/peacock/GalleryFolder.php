<?php
/**
 * @license Copyright (c) 2015, Peacock CMS - Clyde Smets. All rights reserved.
 * For licensing, see EULA.rtf
 */
    session_start();
    include("initPeacock.php");
	include_once("plugins/Gallery/GalleryFunctions.php");

    $username = $_SESSION['username'];
    $peacock = new Peacock;
    $peacock->checkUser($username);
	
	$gallery = new Gallery;
	
	$folder = $_GET['folder'];
	
?>

<html>

<head>
    <title>Peacock | Gallery Folder | <?php echo $folder ?></title>
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
                <a class="ph1">MANAGE <?php echo $folder; ?></a>
            </div>
            <div class="pContentBoxContent">
                <p class="pbodyTxt">List of Images in Folder</p>
               	
               	<div class='FileList'>
               		<?php $gallery->fetchGalleryList($folder, SITE_PATH); ?>
               	</div>
               	
               	<p align="right">
		            <a class="pContentbtn" href="GalleryAddImages.php?folder=<?php echo $folder; ?>">
		            	Add Images
		            </a>
		            <a class="pContentbtn" href="GalleryRemoveImages.php?folder=<?php echo $folder; ?>">
		            	Remove Images
		            </a>
		            <a class="pContentbtn" name="arrangeimagesbtn">
		            	Arrange Images
		            </a>
		        </p>
            </div>
        </div>
        
    </div>
    
    
    <?php
    
    	include_once("plugins/Gallery/GalleryArrangeImages.php");
    	
    ?>
    
    
</body>


</html>