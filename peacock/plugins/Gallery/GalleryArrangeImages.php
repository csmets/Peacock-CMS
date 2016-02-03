<div class='dialog-overlay'></div>
 <!-- Arrange Pages -->
<div id="ArrangeGalleryImage" class="dialogBox" style="width:500px">
	<div class="dialogBoxHeader">
		<span class="oi" data-glyph="plus"></span> Arrange Folders
	</div>
	<div class="dialogBoxBody">
		<p>Drag the items up and down to sort.</p>
        <ul class='MoveableImageBox' id='pMoveableImagesBox'>
        <?php
						$gallery = new Gallery;
						$folderName = $_GET['folder'];
            $images = $gallery->fetchImageList($folderName);
						foreach ($images as $image){
							echo "
							<li id='item_".$image['id']."'>
								<img src='../view/image/".$image['imageFile']."' width='50px'>
								<br>".$image['imageFile']."
							</li>";
						}
        ?>
        </ul>
	</div>
	<div class='linkbar'>
    <ul>
      <li id="ArrangeGalleryImagesSubmit">Save</li>
    </ul>
  </div>
</div>

<script>
	$(document).ready(function()  {

		$(".dialog-overlay, #ArrangeGalleryImage").hide();

		$("#arrangeimagesbtn").click(function(){
    	$(".dialog-overlay, #ArrangeGalleryImage").fadeIn("slow")
    });

   	$( "#pMoveableImagesBox" ).sortable();

		$('#ArrangeGalleryImagesSubmit').click(function(){
			var folderdata = $('#pMoveableImagesBox').sortable('serialize');
			$.post('plugins/Gallery/ArrangeImageSubmit.php',{"data":folderdata}, function(){
				location.reload();
			});
		});

		$(".dialog-overlay").click(function () {
   		$(".dialog-overlay, #ArrangeGalleryImage").fadeOut("fast");
   		return false;
   	});

	});
</script>
