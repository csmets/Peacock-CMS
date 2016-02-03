<!-- Project Posts Dialog Box -->
<?php

require("plugins/Gallery/GalleryFunctions.php");

class GalleryInit extends Plugin{

	public function query(){
		$query['gallery'] = "
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

		$query['GalleryFolders'] = "
			CREATE TABLE GalleryFolders(

				id INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY(id),
				FolderName VARCHAR(200),
				FolderImage VARCHAR(300),
				FolderOrder INT DEFAULT 0

			)
		";

		return $query;
	}

	public function title(){
		return '<i class="fa fa-picture-o"></i> Gallery';
	}

	public function content(){
		$gallery = new Gallery;

		$folders = $gallery->fetchFolderList();

		$imageFolders = "<div class='FolderList'>";

		foreach($folders as $folder){
			$imageFolders .= "
				<a href='GalleryFolder.php?folder=".$folder['FolderName']."'>
					<ul>
						<li><img src='plugins/Gallery/folder.png'></li>
						<li>".$folder['FolderName']."</li>
					</ul>
				</a>
			";
		}

		$imageFolders .= "</div>";

		$imageFolders .= "
			<div class='linkbar'>
				<ul>
				<li id='createImageFolderBtn'><i class='fa fa-folder-open-o'></i> Create Folder</li>
				<li id='removeImageFoldersBtn'><i class='fa fa-trash-o'></i> Remove Folder(s)</li>
				<li id='arrangeImageImageFoldersBtn'><i class='fa fa-random'></i> Arrange Folders</li>
				</ul>
			</div>
		";

		$array['content-body'] = $imageFolders;

		return $array;
	}
}



$tables = array(
	"gallery",
	"GalleryFolders"
);
$gallery = new Gallery;
$GalleryInit = new GalleryInit($tables);
echo $GalleryInit->build();

 ?>



<?php
/*

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
*/
?>

 <!-- Arrange Pages -->
<div id="ArrangeGalleryFolders" class="dialogBox" style="width:500px">
	<div class="dialogBoxHeader">
		Arrange Folders
	</div>
	<div class="dialogBoxBody">
		<p>Drag the items up and down to sort.</p>
    <ul class='MoveableBox' id='pMoveableImageFoldersBox'>
    <?php
        $gallery->fetchFolderNames();
    ?>
    </ul>
	</div>
	<div class='linkbar'>
		<ul>
			<li id="ArrangeGalleryFoldersSubmit">Save</li>
		</ul>
	</div>
</div>



<!--  Add Folder -->
<div id="CreateFolder" class="dialogBox" style="width:500px">
	<div class="dialogBoxHeader">
		CREATE NEW FOLDER
	</div>

    <div class="dialogBoxBody">
			<div class="row">
				<div class="col-xs-4">Folder name:</div>
				<div class="col-xs-8"><input type="text" id='FolderName' class="ptextbox"></div>
			</div>
    </div>
		<div class='linkbar'>
      <ul>
        <li id="CreateFolderSubmit">Create Folder</li>
      </ul>
    </div>
</div>

<!--  Remove Folder -->
<div id="RemoveFolder" class="dialogBox" style="width:500px">
	<div class="dialogBoxHeader">
		REMOVE FOLDER
	</div>

    <div class="dialogBoxBody">

			<div class="row"><div class="col-md-12">
				<p>Tick on the folders you wish to remove.</p>
	    	<p>Removing a folder will <b>REMOVE ALL IMAGES</b> inside the folder.</p>
			</div></div>

			<div class="row voffset3">
				<div class="col-md-12"><?php
					$folders = $gallery->fetchFolderList();

					foreach ($folders as $folder){
						echo "<div class='row'>";
						echo "<div class='col-xs-1'><input type='checkbox' id='folderlists' value='".$folder['FolderName']."'></div>";
						echo "<div class='col-xs-11'>".$folder['FolderName']."</div>";
						echo "</div>";
					}
	    	?></div>
			</div>

    </div>
		<div class='linkbar'>
      <ul>
        <li id="RemoveFolderSubmit" >Remove Folder(s)</li>
      </ul>
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

		$("#arrangeImageImageFoldersBtn").click(function(){
    	$(".dialog-overlay, #ArrangeGalleryFolders").fadeIn("slow")
    });


    $("#removeImageFoldersBtn").click(function(){
    	$(".dialog-overlay, #RemoveFolder").fadeIn("slow")
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

    $("#createImageFolderBtn").click(function(){
    	$(".dialog-overlay, #CreateFolder").fadeIn("slow")
    });

    $("#CreateFolderSubmit").click(function(){
    	var FolderName = $("#FolderName").val();
    	$.post('plugins/Gallery/GalleryCreateFolder.php',{
    		"FolderName" : FolderName
    	}, function(){
    		location.reload();
    	});
    });

    $(".dialog-overlay").click(function () {
   		$("#CreateFolder, #RemoveFolder, #ArrangeGalleryFolders").fadeOut("fast");
   		return false;
   	});


   	$( "#pMoveableImageFoldersBox" ).sortable();
		$('#ArrangeGalleryFoldersSubmit').click(function(){
			var folderdata = $('#pMoveableImageFoldersBox').sortable('serialize');
			$.post('plugins/Gallery/ArrangeFolderSubmit.php',{"data":folderdata}, function(data){
				location.reload();
			});
		});

	});
</script>
