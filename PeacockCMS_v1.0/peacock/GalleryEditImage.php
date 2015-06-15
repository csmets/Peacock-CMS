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
	
	$imageID = $_GET['id'];
	
?>

<html>

<head>
    <title>Peacock | Gallery Edit Image</title>
    <link href="css/PeacockStyles.css" rel="stylesheet" type="text/css" />   
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
                <td width='60%' align='left'><br><a href='GalleryFolder.php?folder=<?php echo $gallery->getImageFolder($imageID); ?>' class='plinkTxt'>Go Back</a></td>
                <td align='left'></td>
            </tr>
        </table>
        </center>
        
        <!-- Pages Box -->
        <div class="pContentBox">
            <div class="pContentBoxHeader">
                &nbsp; &nbsp;<span class="oi" data-glyph="aperture"></span>&nbsp;
                <a class="ph1">EDIT IMAGE</a>
            </div>
            <div class="pContentBoxContent">
                <p class="pbodyTxt">Edit image content or Remove the image from the gallery.</p>
                <form action="plugins/Gallery/GalleryEditImageSubmit.php" method="post">
                
                    
                   
                    <?php
						$sqlconnect = new Connectdb;
				        $db = $sqlconnect->connectTo();
						
						$data = mysqli_query($db,"SELECT * FROM gallery WHERE id = '".$imageID."'");

			            if ($get_data = mysqli_fetch_assoc($data)){
							

							echo "<img src='".SITE_PATH."image/".$get_data['imageFile']."' width='200px'>";
							
							echo "<p></p>";
							
							echo "<p>Title:<br><input type='text' name='title' class='ptextbox' value='".$get_data['imageTitle']."'></p>";
							
							echo "<p>Description:<br><textarea name='desc' class='ptextbox' rows='5' cols='50'>".$get_data['imageDesc']."</textarea></p>";
							
							echo "<input type='hidden' name='id' value='".$imageID."'>";
			            }
						$db->close();
					?>
					
					
					
					
					
                    <input class='pSubmitButton' type='submit' value='Update'>
                    
                    
                </form>
            </div>
        </div>
        
    </div>
    
</body>


</html>