<!-- Project Posts Dialog Box -->

<?php

	//Create Table required for plugin if table doesn't exist!
	$peacockCMS = new Peacock;
	if ($peacockCMS->tableExist('textswap') == FALSE){
		$sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
		$sql = "
			CREATE TABLE textswap(
			
				id INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY(id),
				content VARCHAR(500),
				usetext VARCHAR(50) DEFAULT 'no'
			
			)
		
		";
		mysqli_query($db,$sql);
		$db->close();
	}
	
	
	include_once("plugins/TextSwap/TextSwapFunction.php");
	$textSwap = new TextSwap;

?>





<div class="pContentBox">
    <div class="pContentBoxHeader" name="TextSwapHeader">
        &nbsp;&nbsp;<span class="oi" data-glyph="loop-circular"></span>&nbsp;
        <a class="ph1">Text Swap</a>
        <div class='pBoxToggle' id="TextSwapHide">-</div>
        <div class='pBoxToggle' id="TextSwapOpen">+</div>
    </div>

    <div class="pContentBoxContent" name="TextSwapContent">
        
        <?php 
        	$textSwap->fetchList();
        ?>
        
        <p align="right">
            <a class="pContentbtn" name="AddTextSwapBtn">
            	Add Text
            </a>
        </p>
    </div>
</div>




<!--  Add Text -->
<div id="AddTextSwap" class="pDialogBox" style="width:480px; height:180px;"> 	
    <div class="pDialogBoxHeader">
        &nbsp;&nbsp;<span class="oi" data-glyph="plus"></span>&nbsp;Add Text
    </div>

    <div class="pDialogBoxContent">
        Content: <input size="60" type="text" id='TextSwapContent' class="ptextbox" placeholder="Insert Content Here"><br><br>
        <a href="#" id="TextSwapSubmit" class="pDialogBoxButton">Add Text</a>
    </div>
</div>   



<script>
	$(document).ready(function()  {
        
        $("#AddTextSwap").hide();
        
        $("a[name=AddTextSwapBtn]").click(function(){
        	$("#dialog-overlay, #AddTextSwap").fadeIn("slow")
        });
        
        $("#TextSwapSubmit").click(function(){
        	var AddText = $("#TextSwapContent").val();
        	$.post('plugins/TextSwap/TextSwapSubmit.php',{
        		"AddText" : AddText
        	}, function(){
        		location.reload();
        	});
        });
        
        $("#dialog-overlay").click(function () {
       		$("#AddTextSwap").fadeOut("fast");
       		return false;
       	});
		
		var ProjectsRanOnce = false;
		
		if ($.cookie('TextSwapCookie') == null){
            $.cookie('TextSwapCookie','close');
        }
	        
	    if (($.cookie('TextSwapCookie') == 'open') && (ProjectsRanOnce == false)){
	        $("div[name=TextSwapContent]").show();
            $("#TextSwapHide").show();
            $("#TextSwapOpen").hide();
	        RanOnce = true;
	    }
	    if (($.cookie('TextSwapCookie') == 'close') && (ProjectsRanOnce == false)){
	        $("div[name=TextSwapContent]").hide();
            $("#TextSwapHide").hide();
            $("#TextSwapOpen").show();
	        RanOnce = true;
	    }
	    $("div[name=TextSwapHeader]").click(function(){
	            $("div[name=TextSwapContent]").toggle();
	            
	            if ($.cookie('TextSwapCookie') == 'open'){
	                var cookie = 'close';
	                $.cookie('TextSwapCookie',cookie );
                    $("#TextSwapHide").hide();
                    $("#TextSwapOpen").show();
	            }
	            else
	            {
	                var cookie = 'open';
	                $.cookie('TextSwapCookie',cookie );
                    $("#TextSwapHide").show();
                    $("#TextSwapOpen").hide();
	            }
	    });
	});
</script>
