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
    <title>Peacock>Dashboard | Image Folders</title>
    <link href="css/PeacockStyles.css" rel="stylesheet" type="text/css" />   
    <link href="font/css/open-iconic.css" rel="stylesheet">
    <?php $peacock->removePageMargins(); ?>
    <script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui.min.js"></script>
</head>

<body class="backgroundColor">
	
	<div id="dialog-overlay"></div>

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
        
        <!-- Folders Box -->
        <div class="pContentBox">
            <div class="pContentBoxHeader">
            	&nbsp;&nbsp;<span class="oi" data-glyph="image"></span>&nbsp;
                <a class="ph1">IMAGE FOLDERS</a>
            </div>
            <div class="pContentBoxContent">
            	<div class="FolderList">
	                <?php
	                    $peacock->fetchImageFolders();
	                ?>
                </div>
                
                <p align="right">
		            <a class="pContentbtn" name='createfolderbtn'>
		            	Create Folder
		            </a>
		            <a class="pContentbtn" name='removefoldersbtn'>
		            	Remove Folder(s)
		            </a>
		            <a class="pContentbtn" name="arrangeImageFoldersBtn">
		            	Arrange Folders
		            </a>
		        </p>
            </div>
        </div>
        
    </div>
    
    <!--  Add Folder -->
	<div id="CreateImageFolder" class="pDialogBox" style="width:500px; height:160px;"> 	
		<div class="pDialogBoxHeader">
			<span class="oi" data-glyph="plus"></span> CREATE NEW FOLDER
		</div>
	
	    <div class="pDialogBoxContent">
	    	Folder Name: <input size="60" type="text" id='FolderName' class="ptextbox"><br><br>
	        <a href="#" id="CreateFolderSubmit" class="pDialogBoxButton">Create Folder</a>
	    </div>
	</div>
	
	<!--  Remove Folder -->
	<div id="RemoveImageFolder" class="pDialogBox" style="width:500px; height:400px;"> 	
		<div class="pDialogBoxHeader">
			<span class="oi" data-glyph="minus"></span> REMOVE FOLDER
		</div>
	
	    <div class="pDialogBoxContent">
	    	<p>Tick on the folders you wish to remove.</p>
	    	<p>Removing a folder will <b>REMOVE ALL IMAGES</b> inside the folder.</p>
	    	
	    	<table width="100%">
	    	
	    	<?php
	    		$sqlconnect = new Connectdb;
        		$db = $sqlconnect->connectTo();
				$sql = "SELECT * FROM imageFolders";
	    		$data = mysqli_query($db, $sql);
				
				while ($get_data = mysqli_fetch_assoc($data)){
					
					if ($get_data['folderName'] != 'Uncategorised'){
					
						echo "<tr>";
						echo "<td width='20px'><input type='checkbox' id='folderlists' value='".$get_data['folderName']."'></td>";
						echo "<td>".$get_data['folderName']."</td>";
						echo "</tr>";
					
					}
					
				}
	    	?>
	    	
	   </table><br>
	    	
	        <a href="#" id="RemoveFolderSubmit" class="pDialogBoxButton">Remove Folder(s)</a>
	        <a href="#" id="RemoveFolderAndImageSubmit" class="pDialogBoxButton">Remove Folder(s) and Images</a>
	    </div>
	</div>
	
	
	 <!-- Arrange Folders -->
	<div id="ArrangeImageFolders" class="pDialogBox" style="width:400px; height:50%;">
		<div class="pDialogBoxHeader">
			<span class="oi" data-glyph="plus"></span> Arrange Folders
		</div>
		<div class="pDialogBoxContent">         		
			<p>Drag the items up and down to sort.</p>               	
	        <ul class='pMoveableBox' id='pMoveableFoldersBox'>
	        <?php
	            $peacock->fetchImageFolderNames();
	        ?>
	        </ul>
	        <br>
	        <center>
	        	<a href="#" id="ArrangeImageFoldersSubmit" class="pDialogBoxButton">Save</a>
	        </center>                		
		</div>      	
	</div>
	
	
	<script>
	
		function getValueFromList(){
			/* declare an checkbox array */
			var folderArray = [];
			
			/* look for all checkboes that have a class 'chk' attached to it and check if it was checked */
			$("#folderlists:checked").each(function() {
				folderArray.push($(this).val());
			});
			
			return folderArray;
		}
			
		$(document).ready(function()  {
			
			
			$("#CreateImageFolder, #dialog-overlay, #RemoveImageFolder, #ArrangeImageFolders").hide();
						
			$("a[name=createfolderbtn]").click(function(){
	        	$("#dialog-overlay, #CreateImageFolder").fadeIn("slow")
	        });
	        
	        $("#CreateFolderSubmit").click(function(){
	        	var FolderName = $("#FolderName").val();
	        	var subType = 'CreateImageFolder';
	        	$.post('submission.php',{
	        		"FolderName" : FolderName,
	        		"subType" : subType
	        	}, function(){
	        		location.reload();
	        	});
	        });
	        
	        $("a[name=removefoldersbtn]").click(function(){
        		$("#dialog-overlay, #RemoveImageFolder").fadeIn("slow")
        	});
        	
        	$("#RemoveFolderSubmit").click(function(){
	        	var FolderList = getValueFromList();
	        	var subType = 'removeImageFolders';
	        	$.post('submission.php',{
	        		"folderlist" : FolderList,
	        		"subType" : subType
	        	}, function(){
	        		location.reload();
	        	});
	        });
	        
	        $("#RemoveFolderAndImageSubmit").click(function(){
	        	var FolderList = getValueFromList();
	        	var subType = 'removeImageAndFolders';
	        	$.post('submission.php',{
	        		"folderlist" : FolderList,
	        		"subType" : subType
	        	}, function(){
	        		location.reload();
	        	});
	        });
	        
	        
	        $("a[name=arrangeImageFoldersBtn]").click(function(){
        		$("#dialog-overlay, #ArrangeImageFolders").fadeIn("slow")
       		 });
	        
	        $( "#pMoveableFoldersBox" ).sortable();
				$('#ArrangeImageFoldersSubmit').click(function(){
					var folderdata = $('#pMoveableFoldersBox').sortable('serialize');
					var subType = 'arrangeImageFolders';
					$.post('submission.php',{"data":folderdata, "subType" : subType}, function(){
						location.reload();
					});
			});
	        
	        
	        $("#dialog-overlay").click(function () {
	       		$("#CreateImageFolder, #dialog-overlay, #RemoveImageFolder, #ArrangeImageFolders").fadeOut("fast");
	       		return false;
	       	});
	       	
	       	
	       
		});
	</script>
    
</body>



</html>