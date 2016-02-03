<?php
/**
 * @license Copyright (c) 2014 - 2016, Peacock CMS by Clyde Smets <clyde@peacockcms.com>
 * Peacock CMS is under the GNU - General Public License V3.
 */

    session_start();
    include('initPeacock.php');

class ViewImageFolders extends PeacockUI{

  public function title(){
    return 'View Image Folders';
  }

  public function content(){

    $Peacock = new Peacock;
    $folderArray = $Peacock->fetchImageFolders();
    $folders = "";
    foreach ($folderArray as $folder){
      $folders .= "
        <a href='viewImages.php?folder=".$folder."'>
        <ul>
        <li><img src='Images/folder.png'></li>
        <li>".$folder."</li>
        </ul>
        </a>";
    }

    $array['content-title'] = "<a href='dashboard.php'><i class='fa fa-arrow-left'></i></a> | Image Folders";
    $array['content-body'] = "

    <div class='linkbar'>
      <ul>
        <li id='createfolderbtn'><i class='fa fa-folder-open-o'></i> Create Folder</li>
        <li id='removefoldersbtn'><i class='fa fa-trash-o'></i> Remove Folder(s)</li>
        <li id='arrangeImageFoldersBtn'><i class='fa fa-random'></i> Arrange Folders</li>
      </ul>
    </div>

    <div class='FolderList'>
      $folders
    </div>

    ";

    return $array;
  }

}

$ViewImageFolders = new ViewImageFolders;
echo $ViewImageFolders->build();

$peacock = new Peacock;
 ?>

<div class='dialog-overlay'></div>
  <!--  Add Folder -->
<div id="CreateImageFolder" class="dialogBox">
	<div class="dialogBoxHeader" style="width:500px">
		CREATE NEW FOLDER
	</div>

  <div class="dialogBoxBody">
    <div class="row voffset3">
      <div class="col-md-4">Folder Name</div>
      <div class="col-md-8"><input type="text" id='FolderName'></div>
    </div>
  </div>
  <div class='linkbar'>
    <ul>
      <li id="CreateFolderSubmit">Create Folder</li>
    </ul>
  </div>
</div>

<!--  Remove Folder -->
<div id="RemoveImageFolder" class="dialogBox">
	<div class="dialogBoxHeader" style="width:500px">
		 REMOVE FOLDER
	</div>

    <div class="dialogBoxBody">
      <div class="row nopadding">
        <div class="col-md-12">
          <p>Tick on the folders you wish to remove.</p>
        	<p>Removing a folder will <b>REMOVE ALL IMAGES</b> inside the folder.</p>
        </div>
      </div>
      <div class="row nopadding">
        <div class="col-md-12">

          <?php
            $folderArray = $peacock->fetchImageFolders();

            foreach ($folderArray as $folder){
              if ($folder != 'Uncategorised'){
                echo '<div class="row nopadding">';
      					echo "<div class='col-xs-1'><input type='checkbox' id='folderlists' value='".$folder."'></div>";
      					echo "<div class='col-xs-11'>".$folder."</div>";
                echo '</div>';
      				}
            }
        	?>

        </div>
      </div>
    </div>
    <div class='linkbar'>
      <ul>
        <li id="RemoveFolderSubmit">Remove Folder(s)</li>
        <li id="RemoveFolderAndImageSubmit">Remove Folder(s) and Images</li>
      </ul>
    </div>
</div>


	 <!-- Arrange Folders -->
	<div id="ArrangeImageFolders" class="dialogBox">
		<div class="dialogBoxHeader" style="width:500px">
			Arrange Folders
		</div>
		<div class="dialogBoxBody">
			<p>Drag the items up and down to sort.</p>
	        <ul class='MoveableBox' id='pMoveableFoldersBox'>
	        <?php
	            $peacock->fetchImageFolderNames();
	        ?>
	        </ul>
		</div>
    <div class='linkbar'>
      <ul>
        <li id="ArrangeImageFoldersSubmit">Save</li>
      </ul>
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


			$("#CreateImageFolder, .dialog-overlay, #RemoveImageFolder, #ArrangeImageFolders").hide();

			$("#createfolderbtn").click(function(){
	        	$(".dialog-overlay, #CreateImageFolder").fadeIn("slow")
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

	        $("#removefoldersbtn").click(function(){
        		$(".dialog-overlay, #RemoveImageFolder").fadeIn("slow")
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


	        $("#arrangeImageFoldersBtn").click(function(){
        		$(".dialog-overlay, #ArrangeImageFolders").fadeIn("slow")
       		 });

	        $( "#pMoveableFoldersBox" ).sortable();
				$('#ArrangeImageFoldersSubmit').click(function(){
					var folderdata = $('#pMoveableFoldersBox').sortable('serialize');
					var subType = 'arrangeImageFolders';
					$.post('submission.php',{"data":folderdata, "subType" : subType}, function(){
						location.reload();
					});
			});


	        $(".dialog-overlay").click(function () {
	       		$("#CreateImageFolder, .dialog-overlay, #RemoveImageFolder, #ArrangeImageFolders").fadeOut("fast");
	       		return false;
	       	});



		});
	</script>
