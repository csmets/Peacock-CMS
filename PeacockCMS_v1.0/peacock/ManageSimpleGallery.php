<?php
/**
 * @license Copyright (c) 2015, Peacock CMS - Clyde Smets. All rights reserved.
 * For licensing, see EULA.rtf
 */

    session_start();
    include('initPeacock.php');
	include_once("plugins/SimpleGallery/SimpleGalleryFunctions.php");

    $username = $_SESSION['username'];
    $peacock = new Peacock;
    $peacock->checkUser($username);
	
	$gallery = new SimpleGallery;
	
?>

<html>

<head>
    <title>Peacock | Manage Simple Gallery</title>
    <link href="css/PeacockStyles.css" rel="stylesheet" type="text/css" />   
    <?php $peacock->CKeditorType($username) ?>
    <?php $peacock->removePageMargins(); ?>
    <link href="font/css/open-iconic.css" rel="stylesheet">
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
                <a class="ph1">MANAGE GALLERY</a>
            </div>
            <div class="pContentBoxContent">
                <p class="pbodyTxt">Tick Images you wish to have or not have in your gallery</p>
                <form action="plugins/SimpleGallery/ManageGallerySubmit.php" method="post">
                
                    
                   
                    <?php
						$sqlconnect = new Connectdb;
				        $db = $sqlconnect->connectTo();
						
						$data = mysqli_query($db,"SELECT * FROM images");
				        echo "<table width='100%'>";
				        echo "<tr><td>Select</td><td>Thumbnail</td></tr>";
				
				        while ($get_data = mysqli_fetch_assoc($data)){
				            if ($get_data['image']){
				                echo "<tr>";
								
								if ($gallery->imageExist($get_data['image']) == true){
									echo "<td width='80px'><input type='checkbox' name='imagelist[]' value='".$get_data['image']."' checked></td>";
								}else{
									echo "<td width='80px'><input type='checkbox' name='imagelist[]' value='".$get_data['image']."'></td>";
								}

				                echo "<td><img src='".SITE_PATH."image/".$get_data['image']."' height='80'></td>";
				                //echo "<td>Image Title: <input class='ptextbox' size='80' type='text' name='imageTitle' value=".$gallery->getImageTitle($get_data['id'])."></td>";
				                echo "<tr>";
				                echo "<tr><td >&nbsp;</td><td></td></tr>";
				            }
				        }
				        echo "</table>";
						$db->close();
					?>
                    
                    <input class='pSubmitButton' type='submit' value='Select Images'>
                    
                    
                </form>
            </div>
        </div>
        
    </div>
    
</body>


</html>