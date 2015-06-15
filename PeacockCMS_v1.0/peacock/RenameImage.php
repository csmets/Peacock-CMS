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

    @$ImageName = $_GET['file'];
    @$ImageID = $_GET['id'];
	@$ImageFolder = $_GET['folder'];
?>

<html>

<head>
    <title>Peacock>Dashboard</title>
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
            	<?php
            		
            		if ($ImageFolder != null){
            			echo "<td width='60%' align='left'>
            			<br><a href='viewImages.php?folder=".$ImageFolder."' class='plinkTxt'>Return to Folder</a>
            			</td>";
            		}else{
            			echo "<td width='60%' align='left'>
            			<br><a href='controlpanel.php' class='plinkTxt'>Return to Control Panel</a>
            			</td>";
            		}
            		
            	
            	?>
                
                <td align='left'></td>
            </tr>
        </table>
        </center>
        
        <!-- Content Box -->
        <div class="pContentBox">
            <div class="pContentBoxHeader">
                &nbsp;&nbsp;<span class="oi" data-glyph="image"></span>&nbsp;
                <a class="ph1">RENAME IMAGE</a>
            </div>
            <div class="pContentBoxContent">
            	
            	<image src='<?php echo SITE_PATH."image/".$ImageName; ?>' width='200'>
            		
            	<br><br>
            	
                <form action="submission.php" method='post'>
                    <?php
                        echo "Rename Image: <input size='60' type='text' name='ImageName' value='".$peacock->getImageName($ImageID)."'><br><br>";
                    ?>
                    <input type='hidden' name='id' value='<?php echo $ImageID; ?>'>
                    <input type='hidden' name='subType' value='renameImage'>
                    <input type='hidden' name='folder' value='<?php echo $ImageFolder; ?>'>
                    <input type='submit' value='Rename'>
                </form>
            </div>
        </div>
        
    </div>
    
</body>



</html>