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
    <title>Peacock | Gallery Remove Images</title>
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
                <a class="ph1">MANAGE <?php echo $folder; ?></a>
            </div>
            <div class="pContentBoxContent">
                <p class="pbodyTxt">Tick on the Images you wish to remove from the folder.</p>
               	
               	<form action="plugins/Gallery/GalleryRemoveImagesSubmit.php" method="post">
                
                    
                   
                    <?php
						$sqlconnect = new Connectdb;
				        $db = $sqlconnect->connectTo();
						
						$data = mysqli_query($db,"SELECT * FROM gallery");
				        echo "<table width='100%'>";
				        echo "<tr><td>Select</td><td>Thumbnail</td></tr>";
						
						$count = 0;
				
				        while ($get_data = mysqli_fetch_assoc($data)){
				            if ($get_data['imageFolder'] == $folder){
								
								$count++;
								
				                echo "<tr>";
								echo "<td width='80px'><input type='checkbox' name='imagelist[]' value='".$get_data['id']."'></td>";
				                echo "<td><img src='../view/image/".$get_data['imageFile']."' height='80'></td>";
				                echo "</tr>";
				                echo "<tr><td>&nbsp;</td><td></td></tr>";
				            }
				        }
				        echo "</table>";
						$db->close();
					?>
                    <input class='pSubmitButton' type='submit' value='Remove Selected'>
                    
                    
                </form>
               	
               	
            </div>
        </div>
        
    </div>
    
</body>


</html>