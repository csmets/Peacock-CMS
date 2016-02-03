<?php
    session_start();
    define("SITE_PATH", $_COOKIE['sitePath']);
    include("../../".SITE_PATH."config/config.php");
    include_once ("../../../src/CLASS_Connectdb.php");
    include_once ("../../../src/CLASS_peacock.php");
	include_once("ProjectFunctions.php");

    $username = $_SESSION['username'];
    $peacock = new Peacock;
    $peacock->checkUser($username);
	
	$postID = $_GET['id'];
	
	$project = new Projects;
	
?>

<html>

<head>
    <title>Peacock | Create Project Post</title>
    <link href="../../css/PeacockStyles.css" rel="stylesheet" type="text/css" />   
    <script src='../../ckeditor/Advance/ckeditor.js'></script>
    <?php $peacock->removePageMargins(); ?>
    <link href="../../font/css/open-iconic.css" rel="stylesheet">
</head>

<body class="backgroundColor">

    <div>
        <ul id="pHeaderElements">

            <li class="pHeaderTxtWrapper">
                <image valign='middle' src="../../Images/Icons/PeacockCMS_Logo_Icon.png" height="40">&nbsp;PEACOCK CMS
            </li>

            <li class="pLogoutWrapper">
                <a href='logout.php'>    
                    <span class="oi" data-glyph="power-standby"></span>&nbsp;&nbsp;LOG OUT
                </a>
            </li>

            <li class='pVisitLinkButton'><a href='../index.php' target="_blank">visit site</a></li>

            <li class="pHeaderUsername">
                <span class="oi" data-glyph="person"></span>&nbsp;&nbsp;<?php echo $username;?>
            </li>

        </ul>
    </div>
    
    <div id="pContentWrapper">
        
        <center>
        <table width='100%'>
            
            <tr>
                <td width='60%' align='left'><p class='ph2'><?php $peacock->peacockVersion() ?></p></td>
                <td align='left'></td>
            </tr>
            <tr>
                <td width='60%' align='left'><br><a href='../../dashboard.php' class='plinkTxt'>Return to Control Panel</a></td>
                <td align='left'></td>
            </tr>
        </table>
        </center>
        
        <!-- Pages Box -->
        <div class="pContentBox">
            <div class="pContentBoxHeader">
                &nbsp; &nbsp;<span class="oi" data-glyph="list-rich"></span> &nbsp;
                <a class="ph1">EDIT PROJECT POST</a>
            </div>
            <div class="pContentBoxContent">
                <p class="pbodyTxt">Edit the fields below to make changes to the project post.</p>
                <form action="EditProjectPostSubmit.php?id=<?php echo $postID; ?>" method="post">
                
                    Project Post Title: <input class="ptextbox" size="80" type="text" name="projectTitle" value="<?php echo $project->getPostTitle($postID); ?>">
                    <br>
                    <br>
                    Project Post Sub Title: <input class="ptextbox" size="80" type="text" name="projectSubTitle" value="<?php echo $project->getPostSubTitle($postID); ?>">
                    <br>
                    <br>
                    <?php
	                    echo "Project Image: <select name='projectImage'>";
						
						$postImage = $project->getPostImage($postID);
						
						if ($postImage != null || $postImage != ''){
							echo "<option value='$postImage' selected>$postImage</option>";
						}
						
						echo "<option value='none'>none</option>";
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
                    <br>
                    <br>
                    Project Page Contents:<br><br>
                    <textarea class="ckeditor" name="projectContent"><?php echo $project->getPostContent($postID); ?></textarea>
                    <br>
                    <br>
                    
                    <input class='pSubmitButton' type='submit' value='Post Project'>
                </form>
            </div>
        </div>
        
    </div>
    
</body>


</html>