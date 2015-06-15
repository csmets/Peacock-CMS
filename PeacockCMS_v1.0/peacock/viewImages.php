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
	
	$folder = $_GET['folder'];
	 @$UploadErrorMessage = $_GET['message'];
?>

<html>

<head>
    <title>Peacock>Dashboard | Image Folder - <?php echo $folder ?></title>
    <link href="css/PeacockStyles.css" rel="stylesheet" type="text/css" />   
    <link href="font/css/open-iconic.css" rel="stylesheet">
    <script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui.min.js"></script>
	<script src="plugins/lightbox/js/lightbox.min.js"></script>
    <link href="plugins/lightbox/css/lightbox.css" rel="stylesheet" />
	<link rel="stylesheet" href="plugins/lightbox/css/plightbox.css">
    <?php $peacock->removePageMargins(); ?>
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
                <td width='60%' align='left'><br><a href='viewImageFolders.php' class='plinkTxt'>Go Back to Image Folders</a></td>
                <td align='left'></td>
            </tr>
        </table>
        </center>
        
        <!-- Image Box -->
        <div class="pContentBox">
            <div class="pContentBoxHeader">
                &nbsp; &nbsp;<span class="oi" data-glyph="aperture"></span>&nbsp;
                <a class="ph1">IMAGES</a>
            </div>
            
            <div class="pContentBoxContent">

            	<div style="float:left">
            		<form method="post" action="multiUploader.php" enctype="multipart/form-data" style="display:inline-block">
	                    <table width='250px'>
	                        <tr>
	                            <td align='left' class='pbodyTxt'>Upload Image [jpg/png/gif] <input type='file' name='files[]' multiple="multiple" min="1" max="9999"></td>
	                            <td>
	                            	<input type='hidden' name='folder' value='<?php echo $folder; ?>'>
	                            	<input type='submit' class='pSubmitButton' value='Upload to Folder'>
	                            </td>
	                        </tr>
	                        <tr>
	                            <td align='center' class='pbodyTxt'><?php echo @$UploadErrorMessage; ?></td>
	                        </tr>
	
	                    </table>
	                </form>
            	</div>

            	<div style="float:right">
            		<a class="pContentbtn" name="renameFolderBtn">
		            	Rename Folder
		            </a>
		            <a class="pContentbtn" name="deleteImagesBtn">
		            	Delete Images
		            </a>
		            <a class="pContentbtn" name="arrangeImagesBtn">
		            	Arrange Images
		            </a>
		            <a class="pContentbtn" name="moveImagesBtn">
		            	Move Images
		            </a>
		        </div>

		        <div style="padding-top:60px">
            	<p class="ph2">List of Images in Folder</p>


            	<div class='FileList'>
	                <?php
	                    $peacock->fetchImageList($folder, SITE_PATH);
	                ?>
                </div>
            </div>
               
            </div>
        </div>
        
    </div>
    






    <!-- Rename Folder -->
	<div id="RenameFolder" class="pDialogBox" style="width:500px; height:160px;"> 	
		<div class="pDialogBoxHeader">
			<span class="oi" data-glyph="plus"></span> RENAME FOLDER
		</div>
	
	    <div class="pDialogBoxContent">
	    	New Folder Name: <input size="60" type="text" id='RenameFolderName' class="ptextbox"><br><br>
	    	<input type="hidden" id="RenameFolderId" value="<?php echo $peacock->getFolderId($folder); ?>">
	        <a href="#" id="RenameFolderSubmit" class="pDialogBoxButton">Rename Folder</a>
	    </div>
	</div>




  
    
    <!-- Arrange Images -->
	<div id="ArrangeImages" class="pDialogBox" style="width:600px; height:600px;">
		<div class="pDialogBoxHeader">
			<span class="oi" data-glyph="plus"></span> ARRANGE IMAGES
		</div>
		<div class="pDialogBoxContent">         		
			<p>Drag the items around to sort.</p>               	
	        <ul class='pMoveableImageBox' id='pMoveableImagesBox'>
	        <?php
	            $peacock->fetchImageSortList($folder, SITE_PATH);
	        ?>
	        </ul>
	        <br>
	        <center>
	        	<a href="#" id="ArrangeImagesSubmit" class="pDialogBoxButton">Save</a>
	        </center>                		
		</div>      	
	</div>
	
	
	
	
	
	
	
	
	
	<!--  Move Images -->
	<div id="MoveImages" class="pDialogBox" style="width:600px; height:600px;"> 	
		<div class="pDialogBoxHeader">
			<span class="oi" data-glyph="minus"></span> MOVE IMAGES
		</div>
	
	    <div class="pDialogBoxContent">
	    	<p>Tick the images you wish to move to a different folder.</p>
	    	
	    	<table width="100%">
	    	
	    	<?php
	    		$sqlconnect = new Connectdb;
        		$db = $sqlconnect->connectTo();
				$sql = "SELECT * FROM images ORDER BY imageOrder";
	    		$data = mysqli_query($db, $sql);
				
				while ($get_data = mysqli_fetch_assoc($data)){
					if ($get_data['imageFolder'] == $folder){
						echo "<tr>";
						echo "<td width='20px'><input type='checkbox' id='movelists' value='".$get_data['id']."'></td>";
						echo "<td><img src='".SITE_PATH."image/".$get_data['image']."' height='80px' /></td>";
						echo "<td>".$get_data['image']."</td>";
						echo "</tr>";
					}
				}

				$db->close();
	    	?>
	    	
	   </table><br>
	    	
	    	<?php
	    	
	    		$sqlconnect2 = new Connectdb;
        		$db2 = $sqlconnect2->connectTo();
        		
	    		echo "<select id='moveToFolder'>";
				$sqlFolders = "SELECT * FROM imageFolders ORDER BY folderOrder";
				$folderData = mysqli_query($db2, $sqlFolders);
				while ($get_data = mysqli_fetch_assoc($folderData)){
					echo "<option value='".$get_data['folderName']."'>".$get_data['folderName']."</option>";
				}
				echo "</select>";
	    	
	    	?>
	    	<br><br>
	        <a href="#" id="MoveImagesSubmit" class="pDialogBoxButton">Move Images</a>
	    </div>
	</div>
	
	
	
	

	
	
	
	
	
	<!--  Delete Images -->
	<div id="DeleteImages" class="pDialogBox" style="width:600px; height:600px;"> 	
		<div class="pDialogBoxHeader">
			<span class="oi" data-glyph="minus"></span> DELETE IMAGES
		</div>
	
	    <div class="pDialogBoxContent">
	    	<p>Tick the images you wish to delete.</p>
	    	
	    	<table width="100%">
	    	
	    	<?php
	    		$sqlconnect = new Connectdb;
        		$db = $sqlconnect->connectTo();
				$sql = "SELECT * FROM images ORDER BY imageOrder";
	    		$data = mysqli_query($db, $sql);
				
				while ($get_data = mysqli_fetch_assoc($data)){
					if ($get_data['imageFolder'] == $folder){
						echo "<tr>";
						echo "<td width='20px'><input type='checkbox' id='imagelists' value='".$get_data['id']."'></td>";
						echo "<td><img src='".SITE_PATH."image/".$get_data['image']."' height='80px' /></td>";
						echo "<td>".$get_data['image']."</td>";
						echo "</tr>";
					}
				}
				$db->close();
	    	?>
	    	
	   </table><br>
	    	
	        <a href="#" id="DeleteImagesSubmit" class="pDialogBoxButton">Delete Images</a>
	    </div>
	</div>
	
	
	<script>
	
		function getValueFromList(){
			/* declare an checkbox array */
			var folderArray = [];
			
			/* look for all checkboes that have a class 'chk' attached to it and check if it was checked */
			$("#imagelists:checked").each(function() {
				folderArray.push($(this).val());
			});
			
			return folderArray;
		}
		
		
		
		function getValueFromMoveList(){
			/* declare an checkbox array */
			var folderArray = [];
			
			/* look for all checkboes that have a class 'chk' attached to it and check if it was checked */
			$("#movelists:checked").each(function() {
				folderArray.push($(this).val());
			});
			
			return folderArray;
		}
		
			
			
		$(document).ready(function()  {
			
			
			$("#dialog-overlay, #DeleteImages, #ArrangeImages, #MoveImages, #RenameFolder").hide();
					
	        
	        $("a[name=renameFolderBtn]").click(function(){
        		$("#dialog-overlay, #RenameFolder").fadeIn("slow")
        	});

	        $("#RenameFolderSubmit").click(function(){
	        	var FolderName = $("#RenameFolderName").val();
	        	var folderId = $("#RenameFolderId").val();
	        	var subType = 'RenameImageFolder';
	        	$.post('submission.php',{
	        		"FolderName" : FolderName,
	        		"id" : folderId,
	        		"subType" : subType
	        	}, function(){
	        		location.href="viewImageFolders.php";
	        	});
	        });


	        
	        $("a[name=deleteImagesBtn]").click(function(){
        		$("#dialog-overlay, #DeleteImages").fadeIn("slow")
        	});
        	
        	$("#DeleteImagesSubmit").click(function(){
	        	var FolderList = getValueFromList();
	        	var subType = 'deleteImages';
	        	$.post('submission.php',{
	        		"imagelist" : FolderList,
	        		"subType" : subType
	        	}, function(){
	        		location.reload();
	        	});
	        });
	      
	        
	        
	        $("a[name=arrangeImagesBtn]").click(function(){
        		$("#dialog-overlay, #ArrangeImages").fadeIn("slow")
       		 });
	        
	        $( "#pMoveableImagesBox" ).sortable();
				$('#ArrangeImagesSubmit').click(function(){
					var folderdata = $('#pMoveableImagesBox').sortable('serialize');
					var subType = 'arrangeImages';
					$.post('submission.php',{"data":folderdata, "subType" : subType}, function(){
						location.reload();
					});
			});
			
			
			$("a[name=moveImagesBtn]").click(function(){
        		$("#dialog-overlay, #MoveImages").fadeIn("slow")
        	});
        	
        	$("#MoveImagesSubmit").click(function(){
	        	var FolderList = getValueFromMoveList();
	        	var MoveTo = $('#moveToFolder').val();
	        	var subType = 'moveImages';
	        	$.post('submission.php',{
	        		"movelist" : FolderList,
	        		"folder" : MoveTo,
	        		"subType" : subType
	        	}, function(){
	        		location.reload();
	        	});
	        });
	        
	        
	        $("#dialog-overlay").click(function () {
	       		$("#dialog-overlay, #DeleteImages, #ArrangeImages, #MoveImages, #RenameFolder").fadeOut("fast");
	       		return false;
	       	});
	       	
	       	
	       
		});
	</script>
    
</body>



</html>