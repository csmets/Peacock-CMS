<!-- Project Posts Dialog Box -->

<?php

	//Create Table required for plugin if table doesn't exist!
	$peacockCMS = new Peacock;
	if ($peacockCMS->tableExist('gallery') == FALSE){
		$sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
		$sql = "
			CREATE TABLE simpleGallery(
			
				id INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY(id),
				imageFile VARCHAR(200),
				imageTitle VARCHAR(300),
				hidden VARCHAR(50) DEFAULT 'no',
				imageCategory VARCHAR(100) DEFAULT '1'
			
			)
		
		";
		mysqli_query($db,$sql);
		$db->close();
	}
	
	
	include_once("plugins/SimpleGallery/SimpleGalleryFunctions.php");
	$simpleGallery = new SimpleGallery;

?>





<div class="pContentBox">
    <div class="pContentBoxHeader" name="SimpleGalleryHeader">
        &nbsp;&nbsp;<span class="oi" data-glyph="aperture"></span>&nbsp;
        <a class="ph1">SIMPLE GALLERY IMAGES</a>
        <div class='pBoxToggle' id="simpleGalleryHide">-</div>
        <div class='pBoxToggle' id="simpleGalleryOpen">+</div>
    </div>

    <div class="pContentBoxContent" name="SimpleGalleryContent">
        
        <?php 
        	$simpleGallery->fetchGalleryList();
        ?>
        
        <p align="right">
            <a class="pContentbtn" href="ManageSimpleGallery.php">
            	Manage Gallery
            </a>
        </p>
    </div>
</div>

<script>
	$(document).ready(function()  {
		
		var ProjectsRanOnce = false;
		
		if ($.cookie('SimpleGalleryCookie') == null){
            $.cookie('SimpleGalleryCookie','close');
        }
	        
	    if (($.cookie('SimpleGalleryCookie') == 'open') && (ProjectsRanOnce == false)){
	        $("div[name=SimpleGalleryContent]").show();
            $("#simpleGalleryHide").show();
            $("#simpleGalleryOpen").hide();
	        RanOnce = true;
	    }
	    if (($.cookie('SimpleGalleryCookie') == 'close') && (ProjectsRanOnce == false)){
	        $("div[name=SimpleGalleryContent]").hide();
            $("#simpleGalleryHide").hide();
            $("#simpleGalleryOpen").show();
	        RanOnce = true;
	    }
	    $("div[name=SimpleGalleryHeader]").click(function(){
	            $("div[name=SimpleGalleryContent]").toggle();
	            
	            if ($.cookie('SimpleGalleryCookie') == 'open'){
	                var cookie = 'close';
	                $.cookie('SimpleGalleryCookie',cookie );
                    $("#simpleGalleryHide").hide();
                    $("#simpleGalleryOpen").show();
	            }
	            else
	            {
	                var cookie = 'open';
	                $.cookie('SimpleGalleryCookie',cookie );
                    $("#simpleGalleryHide").show();
                    $("#simpleGalleryOpen").hide();
	            }
	    });
	});
</script>
