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

    $groupID = $_GET['grpID'];
    $groupName = $peacock->getGroupName($groupID);

    $sqlconnect = new Connectdb;
    $db = $sqlconnect->connectTo();

    // === Load up Theme Config Preferences ===
    $currentTheme = $peacock->getSiteTheme();
    $configDIR = "../view/themes/".$currentTheme."/config/config.php";
    if (file_exists($configDIR)){
        include ($configDIR);
    }
    // ========================================
?>

<html>

<head>
    <title>Peacock>Dashboard | Edit Page Group</title>
    <link href="css/PeacockStyles.css" rel="stylesheet" type="text/css" />   
    <link href="font/css/open-iconic.css" rel="stylesheet">
    <script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui.min.js"></script>
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
                <td width='60%' align='left'><br><a href='controlpanel.php' class='plinkTxt'>Return to Control Panel</a></td>
                <td align='left'></td>
            </tr>
        </table>
        </center>
        
        <div class="pContentBox">
            <div class="pContentBoxHeader">
                &nbsp;&nbsp;<span class="oi" data-glyph="folder"></span>&nbsp;
                <a class="ph1"><?php echo $groupName; ?></a>
            </div>
            <div class="pContentBoxContent">
                <?php
                    

                    if (isset($EnablePageImages)){
                        $peacock->fetchGroupPages($groupID, "../", $EnablePageImages);
                    }else{
                        $peacock->fetchGroupPages($groupID, "../");
                    }
                ?>
                
                <p align="right">
                    <a class="pContentbtn" name="DeleteGroupBtn">
                        Delete Group
                    </a>
                    <a class="pContentbtn" name="ArrangePagesBtn">
                        Arrange Pages
                    </a>
                    <!--
                    <a class="pContentbtn" name="CustomPageBtn">
                        Custom Page
                    </a>
                    <a class="pContentbtn" href="../CreatePage.php?type=normal">
                        Create Page
                    </a>
                    -->
                    <a class="pContentbtn" name="AddPageBtn">
                        Add Page
                    </a>
                </p>
            </div>
        </div>
        
    </div>
    
    
    
    
    <!-- Arrange Pages -->
    <div id="ArrangePages" class="pDialogBox" style="width:400px; height:50%;">
    	<div class="pDialogBoxHeader">
    		&nbsp;&nbsp;<span class="oi" data-glyph="list"></span>&nbsp;Arrange Pages
    	</div>
    	<div class="pDialogBoxContent">         		
    		<p>Drag the items up and down to sort.</p>               	
            <ul class='pMoveableBox' id='pMoveablePageBox'>
            <?php
                
                $data = mysqli_query($db,"SELECT * FROM pages ORDER BY pageorder");
				$pageorder = 0;
                while ($get_data = mysqli_fetch_assoc($data)){
                    if ($get_data['pagetype'] != 'subpage' && $get_data['groupID'] == $groupID){    
                	    $pageorder = $pageorder + 1;
                        echo "<li id='item_".$get_data['id']."'>".strip_tags($get_data['pagename'])."</li>";
                    }
                }
            ?>
            </ul>
            <br>
            <center>
            	<a href="#" id="ArrangePagesSubmit" class="pDialogBoxButton">Save</a>
            </center>                		
    	</div>      	
    </div>
    
    
    <!--  Create Custom Page 
    <div id="CustomPage" class="pDialogBox" style="width:480px; height:300px;"> 	
    	<div class="pDialogBoxHeader">
    		&nbsp;&nbsp;<span class="oi" data-glyph="link-intact"></span>&nbsp;Custom Link
    	</div>

        <div class="pDialogBoxContent">
        	Custom Page Name: <input size="60" type="text" id='CustomPageName' class="ptextbox" placeholder="Insert Page Name"><br><br>
            Custom Page Link: <input size="60" type='text' id='CustomPageLink' class="ptextbox" placeholder="ie http://www.url-name.com"><br><br>
            Edit Custom Page Link: <input size="60" type='text' id='CustomEditPageLink' class="ptextbox" placeholder="Not Required Advanced Users Only"><br><br><br>
            <a href="#" id="CustomPageSubmit" class="pDialogBoxButton">Create Page</a>
        </div>
    </div>
    -->
    
    
    <div id="AddPage" class="pDialogBox" style="width:400px; height:200px;"> 	
    	<div class="pDialogBoxHeader">
    		&nbsp;&nbsp;<span class="oi" data-glyph="plus"></span>&nbsp;Add Page
    	</div>

        <div class="pDialogBoxContent">
            <center>
            <p>Select a Page you wish to add to the group.</p>
            <br>
        	Add Page:
            <select name='addPage' class='ptextbox' id='addPageSelect'>
            <?php
                $data = mysqli_query($db,"SELECT * FROM pages ORDER BY pageorder");
                while ($get_data = mysqli_fetch_assoc($data)){
                    if ($get_data['pagetype'] != 'subpage' && $get_data['groupID'] != $groupID && $groupName != $get_data['pagename']){    
                	    if ($get_data['pagetype'] == 'group'){
                            echo "<option value='".$get_data['id']."'>".$get_data['pagename']." (Group)</option>";
                        }else{
                            echo "<option value='".$get_data['id']."'>".$get_data['pagename']."</option>";   
                        }
                    }
                }
            ?>
            </select>
            <input type="hidden" value="<?php echo $groupID; ?>" id="groupID" />
            <a href="#" id="addPageSubmit" class="pDialogBoxButton">Add Page</a>
            </center>
        </div>
    </div>
    
    
    
    
    
    <div id="DeleteGroup" class="pDialogBox" style="width:400px; height:280px;"> 	
    	<div class="pDialogBoxHeader">
    		&nbsp;&nbsp;<span class="oi" data-glyph="trash"></span>&nbsp;Delete Group
    	</div>

        <div class="pDialogBoxContent">
            <center>
            <p>Are you sure you wish to delete this group?</p>
            <br>
            <a href="#" id="DeleteAllGroupSubmit" class="pDialogBoxButton">Delete Groups and Pages</a>
            <input type="hidden" value="<?php echo $groupID; ?>" id="DeleteGroupID" />
            </p>
            <br>
            <a href="#" id="DeleteGroupSubmit" class="pDialogBoxButton">Delete Group</a>
            </center>
        </div>
    </div>
    
    
    
    
    
    <script>
    $(document).ready(function()  {
    	
    	//Dialog Box Actions
    	
    	$("#dialog-overlay, #ArrangePages, #CustomPage, #AddPage, #DeleteGroup").hide();
        
        $("a[name=ArrangePagesBtn]").click(function(){
        	$("#dialog-overlay, #ArrangePages").fadeIn("slow")
        });
        
        $("a[name=CustomPageBtn]").click(function(){
        	$("#dialog-overlay, #CustomPage").fadeIn("slow")
        });
        
        $("a[name=AddPageBtn]").click(function(){
        	$("#dialog-overlay, #AddPage").fadeIn("slow")
        });
        
        $("a[name=DeleteGroupBtn]").click(function(){
        	$("#dialog-overlay, #DeleteGroup").fadeIn("slow")
        });
        

        
        $( "#pMoveablePageBox" ).sortable();
			$('#ArrangePagesSubmit').click(function(){
				var data = $('#pMoveablePageBox').sortable('serialize');
				var subType = "arrangePages";
				$.post('submission.php',{"data":data, "subType":subType}, function(){
					location.reload();
				});
		});
        
        
        
        $("#CustomPageSubmit").click(function(){
        	var PageName = $("#CustomPageName").val();
        	var PageLink = $("#CustomPageLink").val();
        	var EditPageLink = $("#CustomEditPageLink").val();
        	var subType = "customPage";
        	$.post('submission.php',{
        		"PageName" : PageName,
        		"PageLink" : PageLink,
        		"EditPageLink" : EditPageLink,
        		"subType" : subType
        	}, function(){
        		location.reload();
        	});
        });
        
        $("#addPageSubmit").click(function(){
        	var PageID = $("#addPageSelect").val();
            var groupID = $("#groupID").val();
        	var subType = "addPageToGroup";
        	$.post('submission.php',{
        		"PageID" : PageID,
                "GroupID" : groupID,
        		"subType" : subType
        	}, function(){
        		location.reload();
        	});
        });
        
        
        $("#DeleteGroupSubmit").click(function(){
            var groupID = $("#DeleteGroupID").val();
        	var subType = "DeleteGroup";
        	$.post('submission.php',{
                "GroupID" : groupID,
        		"subType" : subType
        	}, function(){
        		location.reload();
        	});
        });
        
        $("#DeleteAllGroupSubmit").click(function(){
            var groupID = $("#DeleteGroupID").val();
        	var subType = "DeleteGroupAll";
        	$.post('submission.php',{
                "GroupID" : groupID,
        		"subType" : subType
        	}, function(){
        		location.reload();
        	});
        });
        
       	$("#dialog-overlay").click(function () {
       		$("#dialog-overlay, #ArrangePages, #CustomPage, #AddPage, #DeleteGroup").fadeOut("fast");
       		return false;
       	});
        
    });
        
    </script>
</body>

</html>