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
                <td width='60%' align='left'><br><a href='controlpanel.php' class='plinkTxt'>Return to Control Panel</a></td>
                <td align='left'></td>
            </tr>
        </table>
        </center>
        
        <!-- Pages Box -->
        <div class="pContentBox">
            <div class="pContentBoxHeader">
               &nbsp;&nbsp;<span class="oi" data-glyph="folder"></span>&nbsp;
                <a class="ph1">EDIT CATEGORY</a>
            </div>
            <div class="pContentBoxContent">
                <?php
                    $CategoryName = $_GET['category'];
                    $CategoryID = $_GET['id'];
					$CategoryIcon = $peacock->getCategoryIcon($CategoryID);
					
                    echo "<form action='submission.php' method='post'>";
                    echo "Edit category name: ";
                    echo "<input class='ptextbox' type='text' value='".$CategoryName."' name='categoryName'><br><br>";
					echo "Category Icon: ";
						
						if ($CategoryIcon != null){
							echo "<br><image width='100px' src='".SITE_PATH."image/$CategoryIcon'><br>";
						}
					
						echo "<select name='icon' id='icon'>";
						echo "<option value='none'>none</option>";
						$sqlconnect = new Connectdb;
				        $db = $sqlconnect->connectTo();
						
						if ($CategoryIcon != null){
							echo "<option value='$CategoryIcon' selected>$CategoryIcon</option>";
						}
						
						$data = mysqli_query($db,"SELECT * FROM images");
				        while ($get_data = mysqli_fetch_assoc($data)){
				        	if ($get_data['imagename'] == null){
				        		echo "<option value='".$get_data['image']."'>".$get_data['image']."</option>";
				        	}else{
				        		echo "<option value='".$get_data['image']."'>".$get_data['imagename']."</option>";
				        	}
				        }
						$db->close();
						echo "</select><br><br>";
					
					echo "<input type='hidden' name='id' value='$CategoryID'>";
					echo "<input type='hidden' name='subType' value='editCategory'>";
                    echo "<input class='pSubmitButton' type='submit' value='Update'>";
                    echo '</form>';
                ?>
            </div>
        </div>
        
    </div>
    
</body>



</html>