<!-- Project Posts Dialog Box -->

<?php

	include_once("ProjectFunctions.php");
	$project = new Projects;

	//Create Table required for plugin if table doesn't exist!
	$peacockCMS = new Peacock;
	if ($peacockCMS->tableExist('projects') == FALSE){
		$sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
		$sql = "
			CREATE TABLE projects(
			
				id INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY(id),
				projectTitle VARCHAR(100),
				projectSubTitle VARCHAR(500),
				projectContent LONGTEXT,
				projectDraft VARCHAR(50) DEFAULT 'no',
				projectCategory VARCHAR(100) DEFAULT '1',
				projectImage VARCHAR(500),
				projectOrder INT(11) DEFAULT 0
			
			)
		
		";
		mysqli_query($db,$sql);
	}

?>





<div class="pContentBox">
    <div class="pContentBoxHeader" name="Projectheader">
        &nbsp;&nbsp;<span class="oi" data-glyph="list-rich"></span></span>&nbsp;
        <a class="ph1">PROJECT POSTS</a>
    </div>

    <div class="pContentBoxContent" name="Projectcontent">
        
        <?php 
        $project->fetchProjectList();
        ?>
        
        <p align="right">
        	
        	<a class="pContentbtn" name='ArrangeProjectsBtn'>
            	Arrange
            </a>
        	
            <a class="pContentbtn" href="../CreateProjectPost.php">
            	Add Project
            </a>
        </p>
    </div>
</div>







<!-- Arrange Projects -->
<div id="ArrangeProjects" class="pDialogBox" style="width:400px; height:50%;">
	<div class="pDialogBoxHeader">
		<span class="oi" data-glyph="brush"> Arrange Projects
	</div>
	<div class="pDialogBoxContent">         		
		<p>Drag the items up and down to sort.</p>               	
        <ul class='pMoveableBox' id='ProjectArrangeBoxes'>
        <?php
        	function projectArrange (){
        		$sqlconnect = new Connectdb;
	            $db = $sqlconnect->connectTo();
	            $data = mysqli_query($db,"SELECT * FROM projects ORDER BY projectOrder");
				$projectOrder = 0;
	            while ($get_data = mysqli_fetch_assoc($data)){
	            	$projectOrder = $projectOrder + 1;
	              	echo "<li id='item_".$get_data['id']."'>".$get_data['projectTitle']."</li>";
	            }
	            $db->close();
        	}
            
            projectArrange();
            
        ?>
        </ul>
        <br>
        <center>
        	<a href="#" id="ArrangeProjectsSubmit" class="pDialogBoxButton">Save</a>
        </center>                		
	</div>      	
</div>






<script>
	$(document).ready(function()  {
		
		$("#ArrangeProjects").hide();
		
		$("a[name=ArrangeProjectsBtn]").click(function(){
        	$("#dialog-overlay, #ArrangeProjects").fadeIn("slow")
        });
		
		$("#dialog-overlay").click(function () {
       		$("#ArrangeProjects").fadeOut("fast");
       		return false;
       	});
		
		$( "#ProjectArrangeBoxes" ).sortable();
			$('#ArrangeProjectsSubmit').click(function(){
				var data = $('#ProjectArrangeBoxes').sortable('serialize');
				$.post('plugins/ProjectPosts/ArrangeProjectsSubmit.php',{"data":data}, function(){
					location.reload();
				});
		});
		
		
		
		
		
		
		
		var ProjectsRanOnce = false;
		
		if ($.cookie('Projectcookie') == null){
            $.cookie('Projectcookie','close');
        }
	        
	    if (($.cookie('Projectcookie') == 'open') && (ProjectsRanOnce == false)){
	        $("div[name=Projectcontent]").show();
	        RanOnce = true;
	    }
	    if (($.cookie('Projectcookie') == 'close') && (ProjectsRanOnce == false)){
	        $("div[name=Projectcontent]").hide();
	        RanOnce = true;
	    }
	    $("div[name=Projectheader]").click(function(){
	            $("div[name=Projectcontent]").toggle();
	            
	            if ($.cookie('Projectcookie') == 'open'){
	                var cookie = 'close';
	                $.cookie('Projectcookie',cookie );
	            }
	            else
	            {
	                var cookie = 'open';
	                $.cookie('Projectcookie',cookie );
	            }
	    });
	});
</script>
