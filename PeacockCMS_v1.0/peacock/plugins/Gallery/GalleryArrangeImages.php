
<div id="dialog-overlay"></div>

 <!-- Arrange Pages -->
<div id="ArrangeGalleryImage" class="pDialogBox" style="width:800px; height:50%;">
	<div class="pDialogBoxHeader">
		<span class="oi" data-glyph="plus"></span> Arrange Folders
	</div>
	<div class="pDialogBoxContent">         		
		<p>Drag the items up and down to sort.</p>               	
        <ul class='MoveableImageBox' id='pMoveableImagesBox'>
        <?php
            $gallery->fetchImageList($folder,SITE_PATH);
        ?>
        </ul>
        <br>
        <center>
        	<a href="#" id="ArrangeGalleryImagesSubmit" class="pDialogBoxButton">Save</a>
        </center>                		
	</div>      	
</div>

<script>
	$(document).ready(function()  {
		
		
		$("#dialog-overlay, #ArrangeGalleryImage").hide();
		
		$("a[name=arrangeimagesbtn]").click(function(){
        	$("#dialog-overlay, #ArrangeGalleryImage").fadeIn("slow")
        });
		
       	$( "#pMoveableImagesBox" ).sortable();
			$('#ArrangeGalleryImagesSubmit').click(function(){
				var folderdata = $('#pMoveableImagesBox').sortable('serialize');
				$.post('plugins/Gallery/ArrangeImageSubmit.php',{"data":folderdata}, function(){
					location.reload();
				});
		});
		
		$("#dialog-overlay").click(function () {
       		$("#dialog-overlay, #ArrangeGalleryImage").fadeOut("fast");
       		return false;
       	});
		
	});
</script>

