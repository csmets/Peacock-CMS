<!-- Project Posts Dialog Box -->

<?php

	//Create Table required for plugin if table doesn't exist!
	$peacockCMS = new Peacock;
	if ($peacockCMS->tableExist('gallery') == FALSE){
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
		$sql = "
			CREATE TABLE gallery(
			
				id INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY(id),
				imageFile VARCHAR(200),
				imageTitle VARCHAR(300),
				imageDesc LONGTEXT,
				lightBox VARCHAR(50) DEFAULT 'no',
				hidden VARCHAR(50) DEFAULT 'no',
				imageFolder VARCHAR(200) DEFAULT 'none',
				imageOrder INT DEFAULT 0
			
			)
		
		";
		mysqli_query($db,$sql);
	}
	if ($peacockCMS->tableExist('GalleryFolders') == FALSE){
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
		$sqlFolder = "
			CREATE TABLE GalleryFolders(
			
				id INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY(id),
				FolderName VARCHAR(200),
				FolderImage VARCHAR(300),
				FolderOrder INT DEFAULT 0
			
			)
		
		";
		mysqli_query($db,$sqlFolder);
	}
	
	include("plugins/Gallery/GalleryFunctions.php");
	$gallery = new Gallery;

    $Theme = $peacockCMS->getSiteTheme();
    @include(SITE_PATH."themes/".$Theme."/config/config.php");

    $sql = "SELECT * FROM pages";
	$query = mysqli_query($db,$sql);
	$checkGalleryPageExist = false;
	while ($get_data = mysqli_fetch_assoc($query)){
		if ($get_data['additional3'] == 'Gallery'){
			$checkGalleryPageExist = true;
            break;
		}
	}
	
	if (($checkGalleryPageExist == false) && ($autoGalleryPageGeneration != false) && ($autoGalleryPageGeneration == true || $autoGalleryPageGeneration != null)){
        if ($galleryFile == null){
            $galleryFilename = 'Gallery.php';   
        }else{
            $galleryFilename = $galleryFile;
        }
		mysqli_query($db,"INSERT INTO pages (pagename,additional,additional3,pagetype,draft,status) VALUES ('Gallery','$galleryFilename','Gallery','relink','no','active')");
        $id = $db->insert_id;
        $q = mysqli_query($db,"SELECT * FROM pages");
        while($get_data = mysqli_fetch_assoc($q)){
            if ($get_data['additional3'] == 'Gallery'){
                mysqli_query($db,"UPDATE pages SET additional2='default-EditPage.php?id=$id' WHERE id=$id");
            }
        }
	}

?>





<div class="pContentBox">
    <div class="pContentBoxHeader" name="GalleryHeader">
        &nbsp;&nbsp;<span class="oi" data-glyph="aperture"></span>&nbsp;
        <a class="ph1">GALLERY</a>
    </div>

    <div class="pContentBoxContent" name="GalleryContent">
        <div class='FolderList'>
        <?php 
        	$gallery->fetchFolderList();
        ?>
        </div>
        
        <p align="right">
        	<a class="pContentbtn" name='arrangefolderbtn'>
            	Arrange Folders
            </a>
        	<a class="pContentbtn" name='removefolderbtn'>
            	Remove Folder
            </a>
            <a class="pContentbtn" name='createfolderbtn'>
            	Create Folder
            </a>
        </p>
    </div>
</div>



 <!-- Arrange Pages -->
<div id="ArrangeGalleryFolders" class="pDialogBox" style="width:400px; height:50%;">
	<div class="pDialogBoxHeader">
		<span class="oi" data-glyph="plus"></span> Arrange Folders
	</div>
	<div class="pDialogBoxContent">         		
		<p>Drag the items up and down to sort.</p>               	
        <ul class='pMoveableBox' id='pMoveableFoldersBox'>
        <?php
            $gallery->fetchFolderNames();
        ?>
        </ul>
        <br>
        <center>
        	<a href="#" id="ArrangeGalleryFoldersSubmit" class="pDialogBoxButton">Save</a>
        </center>                		
	</div>      	
</div>
    


<!--  Add Folder -->
<div id="CreateFolder" class="pDialogBox" style="width:500px; height:160px;"> 	
	<div class="pDialogBoxHeader">
		<span class="oi" data-glyph="plus"></span> CREATE NEW FOLDER
	</div>

    <div class="pDialogBoxContent">
    	Folder Name: <input size="60" type="text" id='FolderName' class="ptextbox"><br><br>
        <a href="#" id="CreateFolderSubmit" class="pDialogBoxButton">Create Folder</a>
    </div>
</div>

<!--  Remove Folder -->
<div id="RemoveFolder" class="pDialogBox" style="width:500px; height:400px;"> 	
	<div class="pDialogBoxHeader">
		<span class="oi" data-glyph="minus"></span> REMOVE FOLDER
	</div>

    <div class="pDialogBoxContent">
    	<p>Tick on the folders you wish to remove.</p>
    	<p>Removing a folder will <b>REMOVE ALL IMAGES</b> inside the folder.</p>
    	
    	<table width="100%">
    	
    	<?php
    	
			$sql = "SELECT * FROM GalleryFolders";
    		$data = mysqli_query($db, $sql);
			
			while ($get_data = mysqli_fetch_assoc($data)){
				
				echo "<tr>";
				echo "<td width='20px'><input type='checkbox' id='folderlists' value='".$get_data['FolderName']."'></td>";
				echo "<td>".$get_data['FolderName']."</td>";
				echo "</tr>";
				
			}
    	?>
    	
   </table><br>
    	
        <a href="#" id="RemoveFolderSubmit" class="pDialogBoxButton">Remove Folder(s)</a>
    </div>
</div>

<script>
	$(document).ready(function()  {
		
		
		function getValueFromList(){
			/* declare an checkbox array */
			var folderArray = [];
			
			/* look for all checkboes that have a class 'chk' attached to it and check if it was checked */
			$("#folderlists:checked").each(function() {
				folderArray.push($(this).val());
			});
			
			return folderArray;
		}
		
		
		$("#CreateFolder, #RemoveFolder, #ArrangeGalleryFolders").hide();
		
		$("a[name=arrangefolderbtn]").click(function(){
        	$("#dialog-overlay, #ArrangeGalleryFolders").fadeIn("slow")
        });
		
        
        $("a[name=removefolderbtn]").click(function(){
        	$("#dialog-overlay, #RemoveFolder").fadeIn("slow")
        });
        
        $("#RemoveFolderSubmit").click(function(){
        	var FolderList = getValueFromList();
        	var subType = 'removeImageFolders';
        	$.post('plugins/Gallery/GalleryRemoveFolder.php',{
        		"folderlist" : FolderList
        	}, function(){
        		location.reload();
        	});
        });
        
        $("a[name=createfolderbtn]").click(function(){
        	$("#dialog-overlay, #CreateFolder").fadeIn("slow")
        });
        
        $("#CreateFolderSubmit").click(function(){
        	var FolderName = $("#FolderName").val();
        	$.post('plugins/Gallery/GalleryCreateFolder.php',{
        		"FolderName" : FolderName
        	}, function(){
        		location.reload();
        	});
        });
        
        $("#dialog-overlay").click(function () {
       		$("#CreateFolder, #RemoveFolder, #ArrangeGalleryFolders").fadeOut("fast");
       		return false;
       	});
       	
       	
       	$( "#pMoveableFoldersBox" ).sortable();
			$('#ArrangeGalleryFoldersSubmit').click(function(){
				var folderdata = $('#pMoveableFoldersBox').sortable('serialize');
				$.post('plugins/Gallery/ArrangeFolderSubmit.php',{"data":folderdata}, function(){
					location.reload();
				});
		});
		
		var ProjectsRanOnce = false;
		
		if ($.cookie('Gallerycookie') == null){
            $.cookie('Gallerycookie','close');
        }
	        
	    if (($.cookie('Gallerycookie') == 'open') && (ProjectsRanOnce == false)){
	        $("div[name=GalleryContent]").show();
	        RanOnce = true;
	    }
	    if (($.cookie('Gallerycookie') == 'close') && (ProjectsRanOnce == false)){
	        $("div[name=GalleryContent]").hide();
	        RanOnce = true;
	    }
	    $("div[name=GalleryHeader]").click(function(){
	            $("div[name=GalleryContent]").toggle();
	            
	            if ($.cookie('Gallerycookie') == 'open'){
	                var cookie = 'close';
	                $.cookie('Gallerycookie',cookie );
	            }
	            else
	            {
	                var cookie = 'open';
	                $.cookie('Gallerycookie',cookie );
	            }
	    });
	});
</script>
