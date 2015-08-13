<?php
/**
 * @license Copyright (c) 2015, Peacock CMS - Clyde Smets. All rights reserved.
 * For licensing, see EULA.rtf
 */

    session_start();
    include("initPeacock.php");
    $username = $_SESSION['username'];
    $peacock = new Peacock;
    $peacock->checkUser($username);

    @$UploadErrorMessage = $_GET['message'];
    @$UploadErroriMessage = $_GET['imessage'];
	@$error = $_GET['error'];
	
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
    <title>Peacock>Dashboard</title>
    <META http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="css/PeacockStyles.css" rel="stylesheet" type="text/css" />      
    <script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="js/jquery.cookie.js"></script>
    <script type="text/javascript" src="js/jquery-ui.min.js"></script>
    <link href="font/css/open-iconic.css" rel="stylesheet">
    
    <link href="css/loadStyle.css" rel="stylesheet" type="text/css" />
    <script src="js/pace.js"></script> 
    <?php $peacock->removePageMargins(); ?>
</head>

<body class="backgroundColor">
	<div id="dialog-overlay"></div>

    <?php include("includes/header.php"); ?>
    
    <div id="pContentWrapper">
        <center>
        <table width='100%'>
            
            <tr>
                <td valign='top' width='60%'>
                
                    <!-- Pages Box -->
                    <div class="pContentBox">
                        <div class="pContentBoxHeader" name="pagesheader">
                            &nbsp;&nbsp;<span class="oi" data-glyph="file"></span>&nbsp;
                            <a class="ph1">PAGES</a>
                            <div class='pBoxToggle' id="pageHide">-</div>
                            <div class='pBoxToggle' id="pageOpen">+</div>
                        </div>
                        <div class="pContentBoxContent" name="pagescontent">
                            <?php
                                $blogging = true;
                                if ($peacockBlogging == false){
                                    $peacock->setActiveStatus(2,'hidden');
                                    $blogging = false;   
                                }

                                if (isset($EnablePageImages)){
                                    if (isset($usePageGroups)){
                                        $peacock->fetchPages("../",$blogging,$EnablePageImages,$usePageGroups);
                                    }else{
                                        $peacock->fetchPages("../",$blogging,$EnablePageImages);
                                    }
                                }else{
                                    if (isset($usePageGroups)){
                                        $peacock->fetchPages("../",$blogging,false,$usePageGroups);
                                    }else{
                                        $peacock->fetchPages("../",$blogging);
                                    }
                                }
                            ?>
                            
                            <p align="right">
                                <?php
                                    if (isset($usePageGroups)){
                                        if ($usePageGroups == true){
                                            echo '<a class="pContentbtn" name="CreateGroupBtn">Create Group</a>';
                                        }
                                    }
                                ?>
	                            <a class="pContentbtn" name="ArrangePagesBtn">
	                            	Arrange Pages
	                            </a>
	                            <a class="pContentbtn" name="CustomPageBtn">
	                            	Custom Page
	                            </a>
	                            <a class="pContentbtn" name="CreatePageBtn">
	                            	Create Page
	                            </a>
                            </p>
                        </div>
                    </div>
                    
                    <!-- Sub Pages Box -->
                    <div class="pContentBox">
                        <div class="pContentBoxHeader" name="subpagesheader">
                            &nbsp;&nbsp;<span class="oi" data-glyph="file"></span>&nbsp;
                            <a class="ph1">SUB PAGES</a>
                            <div class='pBoxToggle' id="subPageHide">-</div>
                            <div class='pBoxToggle' id="subPageOpen">+</div>
                        </div>
                        <div class="pContentBoxContent" name="subpagescontent">
                            <?php $peacock->fetchSubPages("../"); ?>
                            <p align="right">
                                <a class="pContentbtn" name="CreateSubPageBtn">
	                            	Create Sub Page
	                            </a>
                            </p>
                        </div>
                    </div>
                    
                    <!-- Blog Posts -->
                    <?php

                    if ($blogging == true){
                        echo '
                        <div class="pContentBox">
                        <div class="pContentBoxHeader" name="blogheader">
                            &nbsp;&nbsp;<span class="oi" data-glyph="pencil"></span>&nbsp;
                            <a class="ph1">BLOG POSTS</a>
                            <div class="pBoxToggle" id="blogHide">-</div>
                            <div class="pBoxToggle" id="blogOpen">+</div>
                        </div>

                        <div class="pContentBoxContent" name="blogcontent">
                            '.$peacock->fetchBlogPosts($username, "../").'
                            <p align="right">
	                            <a class="pContentbtn" href="../CreatePost.php">
	                            	Create Post
	                            </a>
                            </p>
                        </div>
                        </div>';
                    }
                    
                    ?>
                    
                    
                    <!-- Load Plugins -->
                	<?php $peacock->loadPlugins(); ?>
                    
                    
                    
                
                </td>
                
                
                
                
                
                
                
                <td valign='top'>
                    
                    <!-- Site box -->
                    <div class="pContentBox">
                        <div class="pContentBoxHeader" name="siteheader">
                            &nbsp;&nbsp;<span class="oi" data-glyph="star"></span>&nbsp;
                            <a class="ph1">SITE</a>
                            <div class='pBoxToggle' id="siteHide">-</div>
                            <div class='pBoxToggle' id="siteOpen">+</div>
                        </div>
                        
                        <div class="pContentBoxContent" name="sitecontent">
                            Website Name: <input type="text" class="ptextbox" size="40" name="sitename" id="sitename" value="<?php echo $peacock->getSiteName(); ?>">
                            
                            	<p class="pbodyTxt"> Site Tags (SEO Keywords): 
                            		<input type='text' class='ptextbox' size="40" name="tags"
                                        id = "siteTags" value="<?php echo $peacock->getSiteTags(); ?>"> 
                            
                            	<p class="pbodyTxt"> Site Description (SEO Description):
                            		<br>
                            		<textarea class='ptextbox' name="description" id="siteDescription" rows="5" cols="50"><?php echo $peacock->getSiteDescription(); ?></textarea>
                            
                            <p class="pbodyTxt">Website Image:<br></p>
                            
                            
                            <?php
                                if ($peacock->checkSiteImageStatus() == 'yes'){
                                    echo "<input type='checkbox' name='useSiteImage' id='UseSiteImage' checked/> Use Website Image";
                                }else{
                                    echo "<input type='checkbox' name='useSiteImage' id='UseSiteImage' /> Use Website Image";
                                }
                            ?>
	                            <div class="pContainer" name="siteImageUploadContainer">
	                            	<center>
		                                <?php
		
		                                    if ($peacock->getSiteImage() == null){
		                                        echo "<b><i>No Image</i></b>";   
		                                    }else{
		                                        echo "<img src='".SITE_PATH."siteImage/".$peacock->getSiteImage()."' height='80'>";
		                                    }
		                                ?>
		                            	</center>
		                            	<br>
	
			                        <form method="post" action="siteImageUpload.php" enctype="multipart/form-data">
			                        <table width='100%'>
			                            <tr>
			                                <td align='left' class='pbodyTxt'>Replace Image [jpg/png/gif] <input type='file' name='file'></td>
			                                <td><input type='submit' class='pSubmitButton' value='Upload'></td>
			                            </tr>
			                            
			                            <?php
			                            	if ($UploadErroriMessage != null){
			                            		echo "<tr>
				                                <td align='center' class='pbodyTxt'><?php echo $UploadErroriMessage; ?></td>
				                            </tr>";
			                            	}  
			                            ?>
			                        </table>
			                        </form>
	                           </div>

                        </div>
                    </div>
                    
                    
                    
                    <!-- Theme box -->
                    <div class="pContentBox">
                        <div class="pContentBoxHeader" name="themeheader">
                            &nbsp;&nbsp;<span class="oi" data-glyph="brush"></span>&nbsp;
                            <a class="ph1">THEME</a>
                            <div class='pBoxToggle' id="themeHide">-</div>
                            <div class='pBoxToggle' id="themeOpen">+</div>
                        </div>
                        <div class="pContentBoxContent" name="themecontent">
                            <form action="submission.php" method="post"><p class="pbodyTxt">
                            	Website Theme: 
                            	<select name='sitetheme' class='ptextbox'>
                            		<?php
                                        foreach ($themes as $theme){
                                            if ($theme == $currentTheme){
                                                echo "<option value='$theme' selected>$theme</option>";
                                            }else{
                                                echo "<option value='$theme'>$theme</option>"; 
                                            }
                                        }
                                    ?>
                            	</select>
                            	<input type="hidden" name="subType" value="siteTheme">
                            	<input type='submit' class='pSubmitButton' value='Change'></p>
                                <p>
                                <input type="checkbox" name="importThemeContents" /> Import Theme Page Styles* (if applicable)
                                </p></form>
                                <p>*<b>CAUTION</b>: If checked this action will deleted all page content!</p>
                                <br>
                                <?php

                                    if (HEADER_FILE != null){
                                        $headerFile = "../view/themes/".$currentTheme."/".HEADER_FILE;
                                        if (file_exists($headerFile)){
                                            echo "<p><a class='pSubmitButton' href='editFile.php?type=HTML&file=$headerFile'>Edit Header Code</a>
                                            Edit your website theme's header code</p>";
                                        }
                                    }

                                    if (FOOTER_FILE != null){
                                        $footerFile = "../view/themes/".$currentTheme."/".FOOTER_FILE;
                                        if (file_exists($footerFile)){
                                            echo "<p><a class='pSubmitButton' href='editFile.php?type=HTML&file=$footerFile'>Edit Footer Code</a>
                                            Edit your website theme's footer code</p>";
                                        }
                                    }


                                    if (CSS_EDITOR_FILE != null){
                                        $cssFile = "../view/themes/".$currentTheme."/".CSS_EDITOR_FILE;
                                        if (file_exists($cssFile)){
                                            echo "<p><a class='pSubmitButton' href='editFile.php?type=CSS&file=$cssFile'>Edit CSS Code</a>
                                        Edit your website theme's CSS code</p>";
                                        }
                                    }else{
                                        $cssFile = "../view/themes/".$currentTheme."/style.css";
                                        echo "<p><a class='pSubmitButton' href='editFile.php?type=CSS&file=$cssFile'>Edit CSS Code</a>
                                        Edit your website theme's CSS code</p>";
                                    }
                                    
                                ?>
                        </div>
                    </div>



                
                    <!-- Uploader box -->
                    <div class="pContentBox">
                        <div class="pContentBoxHeader" name="uploadheader">
                            &nbsp;&nbsp;<span class="oi" data-glyph="data-transfer-upload"></span>&nbsp;
                            <a class="ph1">UPLOAD IMAGE</a>
                            <div class='pBoxToggle' id="imageHide">-</div>
                            <div class='pBoxToggle' id="imageOpen">+</div>
                        </div>
                        <div class="pContentBoxContent" name="uploadcontent">
                            <?php $peacock->fetchImagesLimited(SITE_PATH);  ?>
                            <br><br>
                            <form method="post" action="multiUploader.php" enctype="multipart/form-data">
                            <table width='100%'>
                                <tr>
                                    <td align='left' class='pbodyTxt'>Upload Image [jpg/png/gif] <input type='file' name='files[]' multiple="multiple" min="1" max="9999" /></td>
                                    <td><input type='submit' class='pSubmitButton' value='Upload'></td>
                                </tr>
                                <tr>
                                    <td align='center' class='pbodyTxt'><?php echo $UploadErrorMessage; ?></td>
                                </tr>

                            </table>
                            </form>
                                <br>
                        </div>
                    </div>
                    
                    
                    <!-- Categories box -->
                    <div class="pContentBox">
                        <div class="pContentBoxHeader" name="categoriesheader">
                            &nbsp;&nbsp;<span class="oi" data-glyph="folder"></span>&nbsp;
                            <a class="ph1">CATEGORIES</a>
                            <div class='pBoxToggle' id="categoriesHide">-</div>
                            <div class='pBoxToggle' id="categoriesOpen">+</div>
                        </div>
                        <div class="pContentBoxContent" name="categoriescontent">
                            
                            <p class="ph2">List of Categories:</p>
                            
                            <?php $peacock->fetchCategories();  ?>
                            
                            <form method="post" action="submission.php">
                            <table width='100%'>
                                <tr>
                                    <td align='right' class='pbodyTxt'>
                                        New Category name: <input type='text' class='ptextbox' name='categoryname'>
                                    </td>
                                    <td>
                                    	<input type='hidden' name='subType' value='addCategory'>
                                    	<input type='submit' class='pSubmitButton' value='add'></td>
                                </tr>
                            </table>
                            </form>
                            <br>
                        </div>

                    </div>
                    
                    
                    
                    <!-- Settings Box -->
                    <div class="pContentBox">
                        <div class="pContentBoxHeader" name="settingsheader">
                            &nbsp;&nbsp;<span class="oi" data-glyph="wrench"></span>&nbsp;
                            <a class="ph1">SETTINGS</a>
                            <div class='pBoxToggle' id="settingsHide">-</div>
                            <div class='pBoxToggle' id="settingsOpen">+</div>
                        </div>
                        <div class="pContentBoxContent" name="settingscontent">
                            <p class="ph2">
                                Page Source Editing
                                <select id="PageSourceEditing">    
                                <?php
                                    $pageSourceEditing = $peacock->isPageSourceEditingAllow();
                                    if ($pageSourceEditing == true){
                                        echo '<option value="yes" selected>Enabled</option>';
                                        echo '<option value="no">Disable</option>';
                                    }else{
                                        echo '<option value="no" selected>Disabled</option>';
                                        echo '<option value="yes">Enable</option>';
                                    }
                                ?>
                                </select>
                                </p>
                            <p>&nbsp;</p>
                            <p class="ph2">Backup Website</p>
                            <p>Click the button below to generate a backup of your site.</p>
                            <center>
                                <a href="genSiteBackup.php"><div class='pContentbtnUsed'>Back Up Website</div></a>
                            </center>
                            <p>To revert to and older version of your site use the select box to select a backup you wish to revert to and click 'revert' to make the changes. CAUTION: All data will get deleted and reverted to your last backup. User account information will get lost if it was not backed up.</p>
                            <form method="POST" action="loadSiteBackup.php">
                                <select name='backupfile' class='ptextbox'>
                                    <?php
                                        $BackupLines = file(SITE_PATH."backups/backupList.txt");
                                        foreach ($BackupLines as $line){
                                            
                                            $line = preg_replace('/\s+/', '', $line);
                                            
                                            if ($line == $theme){
                                                echo "<option value='$line' selected>$line</option>";
                                            }else{
                                                echo "<option value='$line'>$line</option>";
                                            }
                                        }
                                        fclose($BackupLines);
                                    ?>
                                </select>
                                <input type="submit" class="pSubmitButton" value="Revert"/>
                            </form>
                        </div>

                    </div>
                    
                    
                    <!-- Plugins box -->
                    <div class="pContentBox">
                        <div class="pContentBoxHeader" name="pluginsheader">
                            &nbsp;&nbsp;<span class="oi" data-glyph="plus"></span>&nbsp;
                            <a class="ph1">PLUGINS</a>
                            <div class='pBoxToggle' id="pluginsHide">-</div>
                            <div class='pBoxToggle' id="pluginsOpen">+</div>
                        </div>
                        
                        
                        <div class="pContentBoxContent" name="pluginscontent">
                            
                            <p class="ph2">List of Added Plugins</p>
                            
                            <?php $peacock->fetchPluginsList() ?>

                            <form method="post" action="submission.php">
                                <table width='100%'>
                                    <tr>
                                        <td width='80%' align='right' class='pbodyTxt'>
                                            <select name='pluginList'>
                                                <?php                              
                                                    foreach ($plugins as $plugin){
                                                        if ($peacock->checkPluginExist($plugin) == false){
                                                            echo "<option value='$plugin'>$plugin</option>";
                                                        }
                                                    }
                                                ?>
                                            </select>
                                            <input type='hidden' name='subType' value='addPlugin'>
                                        </td>
                                        <td><input type='submit' class='pSubmitButton' value='Add Plugin'></td>
                                    </tr>
                                </table>
                            </form>
                            
                        </div>

                    </div>
                    
                    
                    <!-- Users box -->
                    <div class="pContentBox">
                        <div class="pContentBoxHeader" name="usersheader">
                            &nbsp;&nbsp;<span class="oi" data-glyph="people"></span>&nbsp;
                            <a class="ph1">USERS</a>
                            <div class='pBoxToggle' id="usersHide">-</div>
                            <div class='pBoxToggle' id="usersOpen">+</div>
                        </div>
                        
                        
                        <div class="pContentBoxContent" name="userscontent">
                            
                            <p class="ph2">Users who use PeacockCMS</p>
                            
                            <?php $peacock->fetchUsers($username);  ?>
                           
                        </div>

                    </div>
                
                </td>
            </tr>
        
        </table>
        </center>
        
        
    </div>
    
    <div id="pFooter">
            <div id="pfooterContainer" class="pWhiteBasicTxt">
                <span class="pAlternateHeading">PeacockCMS </span><span class="pHightlightTxt"><?php $peacock->peacockVersion() ?></span>
                <br>PeacockCMS is under the GNU General Public License V3<br>
                <a class="plinkTxt" href="http://docs.peacockcms.com" target="_blank">View Documentation</a><br>
                <br>
                <span class="pHightlightTxt">Problem/Bug please email</span><br>bugs@peacockcms.com<br><br>
                <span class="pHightlightTxt">Feature Request please email</span><br>feedback@peacockcms.com<br><br>
            </div>
            
            <div id="pStatsContainer" class="pWhiteBasicTxt">
                
                
                <table class="pWhiteBasicTxt" cellpadding="10">
                
                    <tr>
                        <td><span class="oi" data-glyph="bar-chart"></span>&nbsp;&nbsp;<span class="pAlternateHeading">Website Statistics</span></td>
                    </tr>
                    
                    <tr>
                        <td valign="top">
                            <span class="pAlternateHeading">Total Views</span><br><br>
                            Total Site Views: <span class="pHightlightTxt"><?php echo $peacock->displayTotalSiteViews(); ?></span><br><br>
                            Total Page Views: <span class="pHightlightTxt"><?php echo $peacock->displayTotalPageViews(); ?></span><br><br>
                            Total Blog Views: <span class="pHightlightTxt"><?php echo $peacock->displayTotalBlogViews(); ?></span><br><br>
                        </td>
                        <td valign="top">
                            <span class="pAlternateHeading">Top 3 Popular Pages <?php $peacock->displayPopularPages(); ?></span>
                        </td>
                        <td valign="top">
                            <span class="pAlternateHeading">Top 3 Popular Blog Posts <?php $peacock->displayPopularBlog(); ?></span>
                        </td>
                    </tr>
                
                </table>
                
                
            </div>
        
            <p id="pFooterPeacockTag" class='pWhiteBasicTxt'>
                <img src='Images/Icons/PeacockCMS_Logo_Icon.png' width='15' height='15'>&nbsp;&nbsp;PeacockCMS &copy; 2015</p>
        </div>
    
    
    <!-- =* = *= Dialog Box Content =* = *= -->
    
    
    
    <div id="ErrorMessage" class="pDialogBox" style="width:500px; height:300px;"> 	
    	<div class="pDialogBoxHeader" style="background-color:#e74c3c">
    		<span class="oi" data-glyph="cross"></span> ERROR
    	</div>

        <div class="pDialogBoxContent">
        	<p><?php echo $error; ?></p>
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
                    if ($get_data['pagetype'] != 'subpage' && $get_data['isGrouped'] == 'false'){    
                	    if ($blogging == false && $get_data['pagetype'] == 'blog'){
                            
                        }else{
                            $pageorder = $pageorder + 1;
                            echo "<li id='item_".$get_data['id']."'>".strip_tags($get_data['pagename'])."</li>";  
                        }
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
    
    
    
    
    <!--  Create Group -->
    <div id="CreateGroup" class="pDialogBox" style="width:480px; height:180px;"> 	
    	<div class="pDialogBoxHeader">
    		&nbsp;&nbsp;<span class="oi" data-glyph="plus"></span>&nbsp;Create Group
    	</div>

        <div class="pDialogBoxContent">
        	Group Name: <input size="60" type="text" id='GroupName' class="ptextbox" placeholder="Insert Group Name"><br><br>
            <a href="#" id="CreateGroupSubmit" class="pDialogBoxButton">Create Group</a>
        </div>
    </div>
        
        
        
    <!--  Create Page -->
    <div id="CreatePage" class="pDialogBox" style="width:470px; height:400px;"> 	
    	<div class="pDialogBoxHeader">
    		&nbsp;&nbsp;<span class="oi" data-glyph="file"></span>&nbsp;Choose Template
    	</div>

        <div class="pDialogBoxContent">
            <div class="FileList">
        	   <?php $peacock->fetchListOfTemplates('normal') ?>
                <a href="../CreatePage.php?type=normal&template=NewTemplate">
                    <ul>
                        <li><img src="Images/NewTemplateIcon.png" style="width:60px"></li>
                        <li>Create New Template</li>
                    </ul>
                </a>
            </div>
        </div>
    </div>
        
    
    <!--  Create Sub Page -->
    <div id="CreateSubPage" class="pDialogBox" style="width:470px; height:400px;"> 	
    	<div class="pDialogBoxHeader">
    		&nbsp;&nbsp;<span class="oi" data-glyph="file"></span>&nbsp;Choose Template
    	</div>

        <div class="pDialogBoxContent">
            <div class="FileList">
        	   <?php $peacock->fetchListOfTemplates('subpage') ?>
                <a href="../CreatePage.php?type=normal&template=NewTemplate">
                    <ul>
                        <li><img src="Images/NewTemplateIcon.png" style="width:60px"></li>
                        <li>Create New Template</li>
                    </ul>
                </a>
            </div>
        </div>
    </div>
        
    
    
    
    <!--  Create Custom Page -->
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

    
    
    
    
    <!--  Add Plugin -->
    <div id="AddPlugin" class="pDialogBox" style="width:500px; height:200px;"> 	
    	<div class="pDialogBoxHeader">
    		&nbsp;&nbsp;<span class="oi" data-glyph="plus"></span>&nbsp;ADD PLUGIN
    	</div>

        <div class="pDialogBoxContent">
        	Plugin Name: <input size="60" type="text" id='PluginName' class="ptextbox"><br><br>
            Plugin Directory: <input size="60" type='text' id='PluginLink' class="ptextbox" placeholder="eg: MyPlugin/Script.php"><br><br>
            <a href="#" id="AddPluginSubmit" class="pDialogBoxButton">Add Plugin</a>
        </div>
    </div>
    
    
    
    
    
    
    
    
    
    
    
    
    <!-- Create New User -->
    <div id="NewUser" class="pDialogBox" style="width:320px; height:460px;"> 	
    	<div class="pDialogBoxHeader">
    		&nbsp;&nbsp;<span class="oi" data-glyph="person"></span>&nbsp;Create New User
    	</div>

        <div class="pDialogBoxContent" >
        	Avatar: <select name='avatar' id='avatar'>
						<option value='none'>none</option>
						<?php
							
							$data = mysqli_query($db,"SELECT * FROM images");
					        while ($get_data = mysqli_fetch_assoc($data)){
					        	if ($get_data['imagename'] == null){
					        		echo "<option value='".$get_data['image']."'>".$get_data['image']."</option>";
					        	}else{
					        		echo "<option value='".$get_data['image']."'>".$get_data['imagename']."</option>";
					        	}
					        }
							echo "</select><br><br>";
						?>
        	Username: <input type='text' name='newusername' id='newusername' class="ptextbox"><br><br>
            First Name: <input type='text' name='firstname' id='firstname' class="ptextbox"><br><br>
           	Last Name: <input type='text' name='lastname' id='lastname' class="ptextbox"><br><br>
           	Email: <input type='text' name='email' id='email' class="ptextbox"><br><br>
           	Password: <input type='password' name='password' id='password' class="ptextbox"><br><br>
           	Retype Password: <input type='password' name='retypepassword' id='retypepassword' class="ptextbox"><br><br>
           	Account Type: <select name='accounttype' id='accounttype' class="ptextbox">
                                
                              <option value='administrator'>Administrator</option>
                              <option value='developer'>Developer</option>
                              <option value='blogger'>Blogger</option>
                                
                          </select>
                          <br><br><br>
            <a href="#" id="NewUserSubmit" class="pDialogBoxButton">Create User</a>
        </div>
    </div>
                   
    

<script>
    $(document).ready(function()  {
    	
    	
    	
    	//Dialog Box Actions
    	
    	$("#dialog-overlay, #ArrangePages, #CustomPage, #NewUser, #AddPlugin, #ErrorMessage, #CreateGroup, #CreatePage, #CreateSubPage").hide();
        
        $("a[name=ArrangePagesBtn]").click(function(){
        	$("#dialog-overlay, #ArrangePages").fadeIn("slow")
        });
        
        $("a[name=CreateGroupBtn]").click(function(){
        	$("#dialog-overlay, #CreateGroup").fadeIn("slow")
        });
        
        $("a[name=CustomPageBtn]").click(function(){
        	$("#dialog-overlay, #CustomPage").fadeIn("slow")
        });
        
        $("a[name=CreatePageBtn]").click(function(){
        	$("#dialog-overlay, #CreatePage").fadeIn("slow")
        });
        
        $("a[name=CreateSubPageBtn]").click(function(){
        	$("#dialog-overlay, #CreateSubPage").fadeIn("slow")
        });
        
        $("a[name=NewUserBtn]").click(function(){
        	$("#dialog-overlay, #NewUser").fadeIn("slow")
        });
        
        $("a[name=AddPluginBtn]").click(function(){
        	$("#dialog-overlay, #AddPlugin").fadeIn("slow")
        });
        
        $("#NewUserSubmit").click(function(){
        	var Avatar = $("#avatar").val();
        	var Username = $("#newusername").val();
        	var FirstName= $("#firstname").val();
        	var LastName = $("#lastname").val();
        	var Email = $("#email").val();
        	var newpassword = $("#password").val();
        	var retypepassword = $("#retypepassword").val();
        	var accType = $("#accounttype").val();
        	var subType = "addUser";
        	$.post('submission.php',{
        		"avatar" : Avatar,
        		"newusername" : Username,
        		"firstname" : FirstName,
        		"lastname" : LastName,
        		"email" : Email,
        		"password" : newpassword,
        		"retypepassword" : retypepassword,
        		"accounttype" : accType,
        		"subType" : subType
        	}, function(){
        		location.reload();
        	});
        });
        
        
        $("#CreateGroupSubmit").click(function(){
        	var GroupName = $("#GroupName").val();
        	var subType = "createGroup";
        	$.post('submission.php',{
        		"GroupName" : GroupName,
        		"subType" : subType
        	}, function(){
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
        
       	$("#dialog-overlay").click(function () {
       		$("#dialog-overlay, #ArrangePages, #CustomPage, #NewUser, #AddPlugin, #ErrorMessage, #CreateGroup, #CreatePage, #CreateSubPage").fadeOut("fast");
       		return false;
       	});

		$( "#pMoveablePageBox" ).sortable();
			$('#ArrangePagesSubmit').click(function(){
				var data = $('#pMoveablePageBox').sortable('serialize');
				var subType = "arrangePages";
				$.post('submission.php',{"data":data, "subType":subType}, function(){
					location.reload();
				});
		});
		
		
    	$("#AddPluginSubmit").click(function(){
        	var PluginName = $("#PluginName").val();
        	var PluginLink = $("#PluginLink").val();
        	$.post('AddPlugin.php',{
        		"PluginName" : PluginName,
        		"PluginLink" : PluginLink
        	}, function(){
        		location.reload();
        	});
        });
    	
    	
    	// Content Box Handlers
        
        var pagesRanOnce = false;
        var subpagesRanOnce = false;
        var blogRanOnce = false;
        var siteRanOnce = false;
        var themeRandOnce = false;
        var uploadRanOnce = false;
        var categoriesRanOnce = false;
        var settingsRanOnce = false;
        var usersRanOnce = false;
        var pluginsRanOnce = false;
        
        if ($.cookie('pagescookie') == null){
            $.cookie('pagescookie','open');
        }
        
        if (($.cookie('pagescookie') == 'open') && (pagesRanOnce == false)){
            $("div[name=pagescontent]").show();
            $("#pageOpen").hide();
            $("#pageHide").show();
            RanOnce = true;
        }
        if (($.cookie('pagescookie') == 'close') && (pagesRanOnce == false)){
            $("div[name=pagescontent]").hide();
            $("#pageOpen").show();
            $("#pageHide").hide();
            RanOnce = true;
        }
        
        if ($.cookie('subpagescookie') == null){
            $.cookie('subpagescookie','close');
        }
        
        if (($.cookie('subpagescookie') == 'open') && (subpagesRanOnce == false)){
            $("div[name=subpagescontent]").show();
            $("#subPageOpen").hide();
            $("#subPageHide").show();
            RanOnce = true;
        }
        if (($.cookie('subpagescookie') == 'close') && (subpagesRanOnce == false)){
            $("div[name=subpagescontent]").hide();
            $("#subPageOpen").show();
            $("#subPageHide").hide();
            RanOnce = true;
        }
        
        if ($.cookie('blogcookie') == null){
            $.cookie('blogcookie','open');
        }
        
        if (($.cookie('blogcookie') == 'open') && (blogRanOnce == false)){
            $("div[name=blogcontent]").show();
            $("#blogOpen").hide();
            $("#blogHide").show();
            RanOnce = true;
        }
        if (($.cookie('blogcookie') == 'close') && (blogRanOnce == false)){
            $("div[name=blogcontent]").hide();
            $("#blogOpen").show();
            $("#blogHide").hide();
            RanOnce = true;
        }
        
        if ($.cookie('sitecookie') == null){
            $.cookie('sitecookie','close');
        }
        
        if (($.cookie('sitecookie') == 'open') && (siteRanOnce == false)){
            $("div[name=sitecontent]").show();
            $("#siteOpen").hide();
            $("#siteHide").show();
            RanOnce = true;
        }
        if (($.cookie('sitecookie') == 'close') && (siteRanOnce == false)){
            $("div[name=sitecontent]").hide();
            $("#siteOpen").show();
            $("#siteHide").hide();
            RanOnce = true;
        }
        
        if ($.cookie('themecookie') == null){
            $.cookie('themecookie','close');
        }
        
        if (($.cookie('themecookie') == 'open') && (siteRanOnce == false)){
            $("div[name=themecontent]").show();
            $("#themeOpen").hide();
            $("#themeHide").show();
            RanOnce = true;
        }
        if (($.cookie('themecookie') == 'close') && (siteRanOnce == false)){
            $("div[name=themecontent]").hide();
            $("#themeOpen").show();
            $("#themeHide").hide();
            RanOnce = true;
        }
        
        if ($.cookie('uploadcookie') == null){
            $.cookie('uploadcookie','close');
        }
        
        if (($.cookie('uploadcookie') == 'open') && (uploadRanOnce == false)){
            $("div[name=uploadcontent]").show();
            $("#imageOpen").hide();
            $("#imageHide").show();
            RanOnce = true;
        }
        if (($.cookie('uploadcookie') == 'close') && (uploadRanOnce == false)){
            $("div[name=uploadcontent]").hide();
            $("#imageOpen").show();
            $("#imageHide").hide();
            RanOnce = true;
        }
        
        if ($.cookie('categoriescookie') == null){
            $.cookie('categoriescookie','close');
        }
        
        if (($.cookie('categoriescookie') == 'open') && (categoriesRanOnce == false)){
            $("div[name=categoriescontent]").show();
            $("#categoriesOpen").hide();
            $("#categoriesHide").show();
            RanOnce = true;
        }
        if (($.cookie('categoriescookie') == 'close') && (categoriesRanOnce == false)){
            $("div[name=categoriescontent]").hide();
            $("#categoriesOpen").show();
            $("#categoriesHide").hide();
            RanOnce = true;
        }
        
        if ($.cookie('settingscookie') == null){
            $.cookie('settingscookie','close');
        }
        
        if (($.cookie('settingscookie') == 'open') && (settingsRanOnce == false)){
            $("div[name=settingscontent]").show();
            $("#settingsOpen").hide();
            $("#settingsHide").show();
            RanOnce = true;
        }
        if (($.cookie('settingscookie') == 'close') && (settingsRanOnce == false)){
            $("div[name=settingscontent]").hide();
            $("#settingsOpen").show();
            $("#settingsHide").hide();
            RanOnce = true;
        }
        
        if ($.cookie('userscookie') == null){
            $.cookie('userscookie','close');
        }
        
        if (($.cookie('userscookie') == 'open') && (usersRanOnce == false)){
            $("div[name=userscontent]").show();
            $("#usersOpen").hide();
            $("#usersHide").show();
            RanOnce = true;
        }
        if (($.cookie('userscookie') == 'close') && (usersRanOnce == false)){
            $("div[name=userscontent]").hide();
            $("#usersOpen").show();
            $("#usersHide").hide();
            RanOnce = true;
        }
        
     	if ($.cookie('pluginscookie') == null){
            $.cookie('pluginscookie','close');
        }
        
        if (($.cookie('pluginscookie') == 'open') && (usersRanOnce == false)){
            $("div[name=pluginscontent]").show();
            $("#pluginsOpen").hide();
            $("#pluginsHide").show();
            RanOnce = true;
        }
        if (($.cookie('pluginscookie') == 'close') && (usersRanOnce == false)){
            $("div[name=pluginscontent]").hide();
            $("#pluginsOpen").show();
            $("#pluginsHide").hide();
            RanOnce = true;
        }


        $("div[name=pagesheader]").click(function(){
            $("div[name=pagescontent]").toggle();
            if ($.cookie('pagescookie') == 'open'){
                var cookie = 'close';
                $.cookie('pagescookie',cookie );
                $("#pageOpen").show();
                $("#pageHide").hide();
            }
            else
            {
                var cookie = 'open';
                $.cookie('pagescookie',cookie );
                $("#pageOpen").hide();
                $("#pageHide").show();
            }
        });
        
        $("div[name=subpagesheader]").click(function(){
            $("div[name=subpagescontent]").toggle();
            if ($.cookie('subpagescookie') == 'open'){
                var cookie = 'close';
                $.cookie('subpagescookie',cookie );
                $("#subPageOpen").show();
                $("#subPageHide").hide();
            }
            else
            {
                var cookie = 'open';
                $.cookie('subpagescookie',cookie );
                $("#subPageOpen").hide();
                $("#subPageHide").show();
            }
        });

        $("div[name=blogheader]").click(function(){
            $("div[name=blogcontent]").toggle();
            if ($.cookie('blogcookie') == 'open'){
                var cookie = 'close';
                $.cookie('blogcookie',cookie );
                $("#blogOpen").show();
                $("#blogHide").hide();
            }
            else
            {
                var cookie = 'open';
                $.cookie('blogcookie',cookie );
                $("#blogOpen").hide();
                $("#blogHide").show();
            }
        });

        $("div[name=siteheader]").click(function(){
            $("div[name=sitecontent]").toggle();
            if ($.cookie('sitecookie') == 'open'){
                var cookie = 'close';
                $.cookie('sitecookie',cookie );
                $("#siteOpen").show();
                $("#siteHide").hide();
            }
            else
            {
                var cookie = 'open';
                $.cookie('sitecookie',cookie );
                $("#siteOpen").hide();
                $("#siteHide").show();
            }
        });
        
        $("div[name=themeheader]").click(function(){
            $("div[name=themecontent]").toggle();
            if ($.cookie('themecookie') == 'open'){
                var cookie = 'close';
                $.cookie('themecookie',cookie );
                $("#themeOpen").show();
                $("#themeHide").hide();
            }
            else
            {
                var cookie = 'open';
                $.cookie('themecookie',cookie );
                $("#themeOpen").hide();
                $("#themeHide").show();
            }
        });

        $("div[name=uploadheader]").click(function(){
            $("div[name=uploadcontent]").toggle();
            if ($.cookie('uploadcookie') == 'open'){
                var cookie = 'close';
                $.cookie('uploadcookie',cookie );
                $("#imageOpen").show();
                $("#imageHide").hide();
            }
            else
            {
                var cookie = 'open';
                $.cookie('uploadcookie',cookie );
                $("#imageOpen").hide();
                $("#imageHide").show();
            }
        });

        $("div[name=categoriesheader]").click(function(){
            $("div[name=categoriescontent]").toggle();
            if ($.cookie('categoriescookie') == 'open'){
                var cookie = 'close';
                $.cookie('categoriescookie',cookie );
                $("#categoriesOpen").show();
                $("#categoriesHide").hide();
            }
            else
            {
                var cookie = 'open';
                $.cookie('categoriescookie',cookie );
                $("#categoriesOpen").hide();
                $("#categoriesHide").show();
            }
        });

        $("div[name=settingsheader]").click(function(){
            $("div[name=settingscontent]").toggle();
            if ($.cookie('settingscookie') == 'open'){
                var cookie = 'close';
                $.cookie('settingscookie',cookie );
                $("#settingsOpen").show();
                $("#settingsHide").hide();
            }
            else
            {
                var cookie = 'open';
                $.cookie('settingscookie',cookie );
                $("#settingsOpen").hide();
                $("#settingsHide").show();
            }
        });

        $("div[name=usersheader]").click(function(){
            $("div[name=userscontent]").toggle();
            if ($.cookie('userscookie') == 'open'){
                var cookie = 'close';
                $.cookie('userscookie',cookie );
                $("#usersOpen").show();
                $("#usersHide").hide();
            }
            else
            {
                var cookie = 'open';
                $.cookie('userscookie',cookie );
                $("#usersOpen").hide();
                $("#usersHide").show();
            }
        });
        
        $("div[name=pluginsheader]").click(function(){
            $("div[name=pluginscontent]").toggle();
            if ($.cookie('pluginscookie') == 'open'){
                var cookie = 'close';
                $.cookie('pluginscookie',cookie );
                $("#pluginsOpen").show();
                $("#pluginsHide").hide();
            }
            else
            {
                var cookie = 'open';
                $.cookie('pluginscookie',cookie );
                $("#pluginsOpen").hide();
                $("#pluginsHide").show();
            }
        });
        
        
        $("#UseSiteImage").change(function(){
            if ($(this).is(":checked")){
                $.post("submission.php",{
                    subType : "showHideSiteImage",
                    useImage : "yes"
                });
            }else{
                $.post("submission.php",{
                    subType : "showHideSiteImage",
                    useImage : "no"
                });                  
            }
        });
        
        $("#sitename").change(function(){
            var Name = $(this).val();
            $.post("submission.php",{
                subType : "siteName",
                sitename : Name
            });
        });
        
        $("#siteTags").change(function(){
            var siteTags = $(this).val();
            $.post("submission.php",{
                subType : "siteTags",
                tags : siteTags
            });
        });
        
        $("#siteDescription").change(function(){
            var siteDesc = $(this).val();
            $.post("submission.php",{
                subType : "siteDescription",
                description : siteDesc
            });
        });
        
        $("#PageSourceEditing").change(function(){
            var checkValue = $(this).val();
            $.post("submission.php",{
                subType : "pageSourceEditing",
                isChecked : checkValue
            },function(){
        		location.reload();
        	});
        });
        
    });
    
    
    
</script> 

<?php

		if (isset($error)){
			echo "<script>";
			
				echo "$(document).ready(function()  {";
				
				echo "$('#dialog-overlay, #ErrorMessage').fadeIn('slow');";
				
				echo "});";
			
			echo"</script>";
		}
		
		$db->close();
	
	?>

</body>


</html>