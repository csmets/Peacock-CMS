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
	
	if (!empty($_POST['imagelist']) && !empty($_POST['foldername'])){
		
		$sqlconnect = new Connectdb;
		$db = $sqlconnect->connectTo();
		
		$folder = $_POST['foldername'];
		
		foreach($_POST['imagelist'] as $image){
			mysqli_query($db,"INSERT INTO gallery (imageFile, imageFolder) VALUES ('$image', '$folder')");
		}
		
		$db->close();
		
	}else{
		header("location:controlpanel.php");
	}

?>

<html>

<head>
    <title>Peacock | Gallery Images Content</title>
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
                <p class="pbodyTxt">Choose if you wish to add a title and description to your images. Otherwise skip.</p>
                <form action="plugins/Gallery/GalleryImagesContentSubmit.php" method="post">
                
                    
                   
                    <?php
				        echo "<table width='100%'>";
				        echo "<tr><td>Thumbnail</td><td></td></tr>";
				
				        foreach($_POST['imagelist'] as $image){
				        	
								$id = $gallery->getIDFromFileName($image);
								
				                echo "<tr>";
				                echo "<td><img src='".SITE_PATH."image/".$image."' height='80'></td>";
				                echo "<td>Title: <input class='ptextbox' size='80' type='text' name='title-".$id."'><br>";
								echo "Description:<br><textarea class='ptextbox' name='desc-".$id."' rows='5' cols='50'></textarea></td>";
				                echo "</tr>";
				                echo "<tr><td>&nbsp;</td><td></td></tr>";
								echo "<input type='hidden' name='finalID' value='".$id."'>";
				        }
				        echo "</table>";
					?>
                    
                    <span><input class='pSubmitButton' type='submit' value='Submit'>  <a href='controlpanel.php' class='pEditLinkButton'>Skip</a></span>
                    
                    
                </form>
              
            </div>
        </div>
        
    </div>
    
</body>


</html>