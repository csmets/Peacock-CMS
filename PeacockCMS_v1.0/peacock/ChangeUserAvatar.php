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

    $errorMessage = $_GET['error'];
    $userID = $_GET['id'];
    
?>

<html>

<head>
    <title>Peacock>Dashboard | Change Avatar</title>
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
                <td width='60%' align='left'><br><a href='editUserDetails.php?id=<?php echo $userID; ?>' class='plinkTxt'>Return to Edit User</a></td>
                <td align='left'></td>
            </tr>
        </table>
        </center>
        
        <!-- Pages Box -->
        <div class="pContentBox">
            <div class="pContentBoxHeader">
                 &nbsp;&nbsp;<span class="oi" data-glyph="people"></span>&nbsp;
                <a class="ph1">CHANGE AVATAR</a>
            </div>
            <div class="pContentBoxContent">
                <form action='submission.php' method='post'>
                    <p class="ph2">Select your new Avatar Image.</p>
                    <p class="pbodyTxt"><?php echo $errorMessage ?></p>
                    Avatar: <select name='avatar' id='avatar'>
						<option value='none'>none</option>;
						<?php
							$sqlconnect = new Connectdb;
					        $db = $sqlconnect->connectTo();
							
							$data = mysqli_query($db,"SELECT * FROM images");
					        while ($get_data = mysqli_fetch_assoc($data)){
					        	if ($get_data['imagename'] == null){
					        		echo "<option value='".$get_data['image']."'>".$get_data['image']."</option>";
					        	}else{
					        		echo "<option value='".$get_data['image']."'>".$get_data['imagename']."</option>";
					        	}
					        }
							$db->close();
							echo "</select>";
						?>
					 <input type='hidden' name='id' value='<?php echo $userID; ?>'>
                     <input type='hidden' name='subType' value='changeAvatar'>
                     <input class="pSubmitButton" type='submit' value='Update'>
					<br><br>
                </form>
            </div>
        </div>
        
    </div>
    
</body>



</html>