<?php
/**
 * @license Copyright (c) 2014 - 2016, Peacock CMS by Clyde Smets <clyde@peacockcms.com>
 * Peacock CMS is under the GNU - General Public License V3.
 */

    session_start();
    include('initPeacock.php');


class ViewImages extends PeacockUI{

  public function title(){
    return 'View Images';
  }

  public function content(){

    $Peacock = new Peacock;
    $images = $Peacock->fetchImagesArray();
    $folder = $_GET['folder'];
    $imageList = "";
    $checkNumberOfImages = 0;
    foreach ($images as $image){
      if ($image['folder'] == $folder){
        $file = $image['image'];
        $name = $image['name'];
        if($name == null || $name == ""){
          $name = $file;
        }
        $imageList .= "
          <ul>
          <li>
          <a href='../view/image/$file' data-lightbox='$folder' data-title='$name'>
          <img src='../view/image/$file'>
          </a>
          </li>
          <li>$name</li>
          <li><a href='RenameImage.php?file=$file&id="
  				.$image['id']."&folder="
  				.$image['folder']
  				."'>Rename</a></li>
          </ul>";
          $checkNumberOfImages++;
      }
    }

    if ($checkNumberOfImages == 0 || $imageList == ""){
      $imageList = "<h4>Empty folder.</h4>";
    }

    $array['content-title'] = "<a href='viewImageFolders.php'><i class='fa fa-arrow-left'></i></a> | Image Folders";
    $array['content-body'] = "

    <div class='linkbar'>
      <ul>
        <li id='renameFolderBtn'><i class='fa fa-folder-open-o'></i> Rename Folder</li>
        <li id='deleteImagesBtn'><i class='fa fa-trash-o'></i> Delete Images</li>
        <li id='arrangeImagesBtn'><i class='fa fa-random'></i> Arrange Images</li>
        <li id='moveImagesBtn'><i class='fa fa-random'></i> Move Images</li>
      </ul>
    </div>

    <div class='FolderList'>
      $imageList
    </div>

    ";

    return $array;
  }

}

$ViewImages = new ViewImages;
echo $ViewImages->build();

$peacock = new Peacock;
$folder = $_GET['folder'];
?>



<div class='dialog-overlay'></div>

<!-- Rename Folder -->
<div id="RenameFolder" class="dialogBox" style="width:500px">
	<div class="dialogBoxHeader">
		RENAME FOLDER
	</div>

    <div class="dialogBoxBody">
      <div class="row">
        <div class="col-md-4">Folder Name:</div>
        <div class="col-md-8">
          <input type="text" id='RenameFolderName' value="<?php echo $folder; ?>">
        </div>
      </div>
    </div>
    <div class='linkbar'>
      <ul>
        <li id='RenameFolderSubmit'>Rename
        <input type="hidden" id="RenameFolderId" value="<?php echo $peacock->getFolderId($folder); ?>">
        </li>
      </ul>
    </div>
</div>






<!-- Arrange Images -->
<div id="ArrangeImages" class="dialogBox" style="width:500px">
	<div class="dialogBoxHeader">
		ARRANGE IMAGES
	</div>
	<div class="dialogBoxBody">
		<p>Drag the items around to sort.</p>
        <ul class='MoveableImageBox' id='pMoveableImagesBox'>
        <?php
          $images = $peacock->fetchImagesArray();
            foreach($images as $image){
              if ($image['folder'] == $folder){
                echo "
                <li id='item_".$image['id']."'>
                  <img src='../view/image/".$image['image']."' width='50px'>
                  <br>".$image['image']."
                </li>";
              }
            }
        ?>
        </ul>
	</div>
  <div class='linkbar'>
    <ul>
      <li id="ArrangeImagesSubmit">Save</li>
    </ul>
  </div>
</div>









<!--  Move Images -->
<div id="MoveImages" class="dialogBox" style="width:500px">
	<div class="dialogBoxHeader">
		MOVE IMAGES
	</div>

    <div class="dialogBoxBody">
    	<p>Tick the images you wish to move to a different folder.</p>

        <?php
          foreach($images as $image){
            if ($image['folder'] == $folder){
              echo '
              <div class="row">
              <div class="col-md-2">
                <input type="checkbox" id="movelists" value="'.$image['id'].'">
              </div>
              <div class="col-md-2">
                <img src="../view/image/'.$image['image'].'" width="100%" />
              </div>
              <div class="col-md-8">
                '.$image['image'].'
              </div>
              </div>
              ';
            }
          }

          $folderList = $peacock->fetchImageFolders();
          echo "<br>Move to folder: <select id='moveToFolder'>";
          foreach($folderList as $foldername){
            if ($folder != $foldername){
              echo "<option value='$foldername'>$foldername</option>";
            }
          }
          echo "</select>";
         ?>
    </div>
    <div class='linkbar'>
      <ul>
        <li id='MoveImagesSubmit'>Move Images</li>
      </ul>
    </div>
</div>










<!--  Delete Images -->
<div id="DeleteImages" class="dialogBox" style="width:500px">
	<div class="dialogBoxHeader">
		DELETE IMAGES
	</div>

    <div class="dialogBoxBody">
    	<p>Tick the images you wish to delete.</p>

        <?php
          foreach($images as $image){
            if ($image['folder'] == $folder){
              echo '
              <div class="row">
              <div class="col-md-2">
                <input type="checkbox" id="imagelists" value="'.$image['id'].'">
              </div>
              <div class="col-md-2">
                <img src="../view/image/'.$image['image'].'" width="100%" />
              </div>
              <div class="col-md-8">
                '.$image['image'].'
              </div>
              </div>
              ';
            }
          }
         ?>
    </div>
    <div class='linkbar'>
      <ul>
        <li id="DeleteImagesSubmit">Delete Images</li>
      </ul>
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


		$(".dialog-overlay, #DeleteImages, #ArrangeImages, #MoveImages, #RenameFolder").hide();


        $("#renameFolderBtn").click(function(){
      		$(".dialog-overlay, #RenameFolder").fadeIn("slow")
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



        $("#deleteImagesBtn").click(function(){
      		$(".dialog-overlay, #DeleteImages").fadeIn("slow")
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



        $("#arrangeImagesBtn").click(function(){
      		$(".dialog-overlay, #ArrangeImages").fadeIn("slow")
     		 });

        $( "#pMoveableImagesBox" ).sortable();
			$('#ArrangeImagesSubmit').click(function(){
				var folderdata = $('#pMoveableImagesBox').sortable('serialize');
				var subType = 'arrangeImages';
				$.post('submission.php',{"data":folderdata, "subType" : subType}, function(){
					location.reload();
				});
		});


		$("#moveImagesBtn").click(function(){
      		$(".dialog-overlay, #MoveImages").fadeIn("slow")
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


        $(".dialog-overlay").click(function () {
       		$(".dialog-overlay, #DeleteImages, #ArrangeImages, #MoveImages, #RenameFolder").fadeOut("fast");
       		return false;
       	});



	});
</script>
