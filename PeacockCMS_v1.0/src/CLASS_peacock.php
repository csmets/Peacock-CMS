<?php
/**
 * @license Copyright (c) 2015, Peacock CMS - Clyde Smets. All rights reserved.
 * For licensing, see EULA.rtf
 */



class Peacock {
    

    public function __construct (){

    }


	public function peacockVersion(){
        echo "Version 1.0.0 Beta";
    }




    /*  ===== Get Functions Start ========  */

	public function getPostContent ($id, $incDraft = false, $showTags = false){
		$sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $query = "SELECT * FROM blog WHERE id='$id'";
        $data = mysqli_query($db,$query);
        $get_data = mysqli_fetch_assoc($data);
        $draft = $get_data['draft'];
        $useDraftFile = $_GET['draft'];
        if ($incDraft == true && $draft == 'yes' && $useDraftFile == 'yes'){
            if (file_exists('view/drafts/posts/postDraft-'.$id.'.json')){
                $file = file_get_contents('view/drafts/posts/postDraft-'.$id.'.json');
                $json = json_decode($file, true);
                return $json['body'];
            }
        }else{
            $string = $get_data['postcontent'];

            if ($showTags == false){
                $string = $this->removeHashTags($string);
            }	
            if ($incDraft == TRUE){
                return $string;
            }
            if ($incDraft == FALSE){
                if ($get_data['draft'] == 'no'){
                    return $string;
                }
            }
        }
		$db->close();
	}
	
	public function getPostDate ($id, $incDraft = false){
		$sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $query = "SELECT * FROM blog WHERE id='$id'";
        $data = mysqli_query($db,$query);
        $get_data = mysqli_fetch_assoc($data);
		
		if ($incDraft == TRUE){
			return $get_data['date'];
		}
		if ($incDraft == FALSE){
			if ($get_data['draft'] == 'no'){
				return $get_data['date'];
			}
		}
		$db->close();
	}
	
	public function getPostAuthor ($id, $incDraft = false){
		$sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $query = "SELECT * FROM blog WHERE id='$id'";
        $data = mysqli_query($db,$query);
        $get_data = mysqli_fetch_assoc($data);
		
		if ($incDraft == TRUE){
			return $get_data['user'];
		}
		if ($incDraft == FALSE){
			if ($get_data['draft'] == 'no'){
				return $get_data['user'];
			}
		}
		$db->close();
	}
	
	public function getPostAuthorName ($username){
		$sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $query = "SELECT * FROM users WHERE username='$username'";
        $data = mysqli_query($db,$query);
        $get_data = mysqli_fetch_assoc($data);
		$fullname = $get_data['firstname'] . ' ' . $get_data['lastname'];
		return $fullname;
	}
	
	public function getPostCategory ($id, $incDraft = false){
		$sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $query = "SELECT * FROM blog WHERE id='$id'";
        $data = mysqli_query($db,$query);
        $get_data = mysqli_fetch_assoc($data);
		
		if ($incDraft == TRUE){
			return $this->getCategory($get_data['category']);
		}
		if ($incDraft == FALSE){
			if ($get_data['draft'] == 'no'){
				return $this->getCategory($get_data['category']);
			}
		}
		$db->close();
	}
	
	public function getPostViews ($id, $incDraft = false){
		$sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $query = "SELECT * FROM blog WHERE id='$id'";
        $data = mysqli_query($db,$query);
        $get_data = mysqli_fetch_assoc($data);
		
		if ($incDraft == TRUE){
			return $get_data['views'];
		}
		if ($incDraft == FALSE){
			if ($get_data['draft'] == 'no'){
				return $get_data['views'];
			}
		}
		$db->close();
	}
	
	
	public function getPostImage($id){
		$sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $query = "SELECT * FROM blog WHERE id='$id'";
        $data = mysqli_query($db,$query);
        $get_data = mysqli_fetch_assoc($data);
		return $get_data['image'];
	}
	
	public function getCategoryIcon ($id){
		$sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $query = "SELECT * FROM categories WHERE id='$id'";
        $data = mysqli_query($db,$query);
        $get_data = mysqli_fetch_assoc($data);

		return $get_data['icon'];
		$db->close();
	}
	
	public function getUserAvatar ($username){
		$sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $query = "SELECT * FROM users WHERE username='$username'";
        $data = mysqli_query($db,$query);
        $get_data = mysqli_fetch_assoc($data);

		return $get_data['profileimg'];
		$db->close();
	}

    public function getCategory ($id){	//Returns Category Name
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $data = mysqli_query($db,"SELECT * FROM categories WHERE id='$id'");
        $get_data = mysqli_fetch_assoc($data);
        return $get_data['category'];
        $db->close();
    }
    public function getPostName ($id, $removeTags = false){
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $data = mysqli_query($db,"SELECT * FROM blog WHERE id='$id'");
        $get_data = mysqli_fetch_assoc($data);
        $postName = '';
        if ($removeTags == true){
        	$postName = strip_tags($get_data['posttitle']);
        }else{
        	$postName = $get_data['posttitle'];
        }
        return $postName;
        $db->close();
    }
    public function getPageName ($id, $removeTags = false){
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $data = mysqli_query($db,"SELECT * FROM pages WHERE id='$id'");
        $get_data = mysqli_fetch_assoc($data);
        $pageName = '';
        if ($removeTags == true){
        	$pageName = strip_tags($get_data['pagename']);
        }else{
        	$pageName = $get_data['pagename'];
        }
        return $pageName;
        $db->close();
    }

	public function getPageContent ($id){
        $useDraftFile = $_GET['draft'];
        
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $data = mysqli_query($db,"SELECT * FROM pages WHERE id='$id'");
        $get_data = mysqli_fetch_assoc($data);
        $draft = $get_data['draft'];
        
        if ($draft == 'yes' && $useDraftFile == 'yes'){
            if (file_exists("view/drafts/pages/pageDraft-".$id.".json")){
                $file = file_get_contents("view/drafts/pages/pageDraft-".$id.".json");
                $json = json_decode($file, true);
                return $json['body'];
            }else{
                echo 'NO DRAFT FILE FOUND!';    
            }
        }else{
            return $get_data['bodycontent'];
        }
        $db->close();
    }
	
	public function getPageImage ($id){
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $data = mysqli_query($db,"SELECT * FROM pages WHERE id='$id'");
        $get_data = mysqli_fetch_assoc($data);
        return $get_data['image'];
        $db->close();
    }

    public function getSiteName (){
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $data = mysqli_query($db,"SELECT * FROM site WHERE id='1'");
        $get_data = mysqli_fetch_assoc($data);
        return $get_data['sitename'];
        $db->close();
    }
	public function getSiteTheme (){
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $data = mysqli_query($db,"SELECT * FROM site WHERE id='1'");
        $get_data = mysqli_fetch_assoc($data);
        return $get_data['theme'];
        $db->close();
    }
    public function getSiteImage (){
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $data = mysqli_query($db,"SELECT * FROM site WHERE id='1'");
        $get_data = mysqli_fetch_assoc($data);
        if ($get_data['useimage'] == 'yes'){
            return $get_data['image'];
        }
        else{
            return null;   
        }
        $db->close();
    }
    public function getImageName ($id){
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $data = mysqli_query($db,"SELECT * FROM images WHERE id='$id'");
        $get_data = mysqli_fetch_assoc($data);

        if ($get_data['imagename'] == null){
            return $get_data['image'];
        }
        else{
            return $get_data['imagename'];
        }
        $db->close();
    }
	public function getImageFilename ($id){
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $data = mysqli_query($db,"SELECT * FROM images WHERE id='$id'");
        $get_data = mysqli_fetch_assoc($data);

        return $get_data['image'];

        $db->close();
    }
    public function getSiteTags (){
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $data = mysqli_query($db,"SELECT * FROM site WHERE id='1'");
        $get_data = mysqli_fetch_assoc($data);
        return $get_data['tags'];
        $db->close();
    }
    public function getSiteDescription (){
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $data = mysqli_query($db,"SELECT * FROM site WHERE id='1'");
        $get_data = mysqli_fetch_assoc($data);
        return $get_data['description'];
        $db->close();
    }
	public function getLastPostID (){
		$sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $data = mysqli_query($db,"SELECT * FROM blog ORDER BY id DESC");
        $get_data = mysqli_fetch_assoc($data);
        return $get_data['id'];
        $db->close();
	}
	
	public function getPageData ($id, $ColumnName){
		$sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $data = mysqli_query($db,"SELECT * FROM pages WHERE id='$id'");
        $get_data = mysqli_fetch_assoc($data);
		return $get_data[$ColumnName];
	}

    public function getBlogData ($id, $ColumnName){
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $data = mysqli_query($db,"SELECT * FROM blog WHERE id='$id'");
        $get_data = mysqli_fetch_assoc($data);
        return $get_data[$ColumnName];
    }


	public function getTableData ($id, $table, $columnName){
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $sql = "SELECT * FROM ".$table." WHERE id='".$id."'";
        $data = mysqli_query($db,$sql);
        $get_data = mysqli_fetch_assoc($data);
        return $get_data[$ColumnName];
    }
	
	public function getPageID ($pageName){
		$sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $data = mysqli_query($db,"SELECT * FROM pages WHERE pagename='$pageName'");
        if ($get_data = mysqli_fetch_assoc($data)){
        	return $get_data['id'];
        }else{
        	echo "Page Doesn't Exist";
        }
        $db->close();
	}
    
    public function getGroupName ($id){
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $data = mysqli_query($db,"SELECT * FROM pages WHERE id='$id'");
        if ($get_data = mysqli_fetch_assoc($data)){
            if ($get_data['pagetype'] == 'group'){
                return $get_data['pagename'];
            }
            else{
                echo "ID is not a Group Type";   
            }
        }else{
        	echo "Group Doesn't Exist";
        }
        $db->close();
    }



	public $siteLinksFormat = "<a href='pageLink'>pageName</a>";
    public $siteLinksGroupClass = "siteLinksGroup";
    public $siteLinksMobileGroupClass = "siteLinksMobileGroup";
    public $siteLinksMobileGroupClickToShow = true;

	public function getSiteLinks($showGroupPages = false, $stripTags = true, $mobileWidth = 1024){

		$format = $this->siteLinksFormat;

		if ($format != null){

			$sqlconnect = new Connectdb;
        	$db = $sqlconnect->connectTo();
        	$data = mysqli_query($db,"SELECT * FROM pages ORDER BY pageorder");
            
            $functionCount = 1;

        	while ($get_data = mysqli_fetch_assoc($data)){

        		$pageLink = '';
        		$pageName = '';
                if ($get_data['isGrouped'] == 'false'){
                    if ($get_data['draft'] == 'no' && $get_data['status'] == 'active'){
                        $pageLink = $this->returnPageLink($get_data['pagetype'], $get_data['id']);
                        $pageName = $this->siteLinkTags($get_data['pagename'], $stripTags);
                    }

                    if ($pageLink != null && $pageName != null){
                        $insertPageLink = str_replace("pageLink", $pageLink, $format);

                        $insertPageName = str_replace("pageName", $pageName, $insertPageLink);

                        echo $insertPageName;
                    }
                }
                if($get_data['pagetype'] == 'group' && $showGroupPages == true){
                    $pageLink = '';
                    $pageName = $this->siteLinkTags($get_data['pagename'], $stripTags);
                    
                    $insertPageLink = str_replace("pageLink", "#", $format);

                    $insertPageName = str_replace("pageName", $pageName, $insertPageLink);
                    
                    $removeLIStartTag = str_replace("<li>", '', $insertPageName);
                    $removeLIEndTag = str_replace("</li>", '', $removeLIStartTag);
                    $groupLink = $removeLIEndTag;

                    $pageName = str_replace(" ", "", $pageName);
                    $groupID = $get_data['id'];
                    
                    echo "<li id='".$pageName."Trigger'>";
                    echo $groupLink;
                    
                    //Desktop=======================================
                    //==============================================
                    echo "
                        <ul id='".$pageName."' class='".$this->siteLinksGroupClass."'>";
                    $dropdownSQL = "SELECT * FROM pages ORDER BY pageorder";
                    $querydropdown = mysqli_query($db, $dropdownSQL);
                    while($get_page = mysqli_fetch_assoc($querydropdown)){
                        if ($get_page['groupID'] == $groupID && $get_page['draft'] == 'no' && $get_page['status'] == 'active'){
                            echo "<li>";
                            echo "<a href='".$this->returnPageLink($get_page['pagetype'], $get_page['id'])."'>".$get_page['pagename']."</a>";
                            echo "</li>";   
                        }
                    }
                    echo "</ul>";
                    //==============================================
                    //==============================================
                    
                    //Mobile========================================
                    //==============================================
                    echo "
                        <ul id='".$pageName."Mobile' class='".$this->siteLinksMobileGroupClass."'>";
                    $mobileDropdownSQL = "SELECT * FROM pages ORDER BY pageorder";
                    $mobileQuerydropdown = mysqli_query($db, $mobileDropdownSQL);
                    while($get_pagelinks = mysqli_fetch_assoc($mobileQuerydropdown)){
                        if ($get_pagelinks['groupID'] == $groupID && $get_pagelinks['draft'] == 'no' && $get_pagelinks['status'] == 'active'){
                            echo "<li>";
                            echo "<a href='".$this->returnPageLink($get_pagelinks['pagetype'], $get_pagelinks['id'])."'>".$get_pagelinks['pagename']."</a>";
                            echo "</li>";   
                        }
                    }
                    echo "</ul>";
                    //==============================================
                    //==============================================
                    
                    echo "</li>";
                    
                    echo "<script>";
                    echo "$(document).ready(function(){
                        if ($(window).width() > ".$mobileWidth."){
                            $('#".$pageName."Trigger').mouseover(function(){
                                $('#".$pageName."').css('display','block');
                            });
                            $('#".$pageName."Trigger').mouseout(function(){
                                $('#".$pageName."').css('display','none');
                            });
                            $('#".$pageName."Mobile').hide();
                        }
                        if ($(window).width() < ".$mobileWidth."){";
                            echo "$('#".$pageName."Mobile').hide();";
                            if ($this->siteLinksMobileGroupClickToShow == true){
                                echo "
                                var mobileGroupActive = false;
                                $('#".$pageName."Trigger').click(function(){
                                     if (mobileGroupActive == false){
                                        $('#".$pageName."Mobile').css('display','block');
                                        mobileGroupActive = true;
                                    }else{
                                        $('#".$pageName."Mobile').css('display', 'none');
                                        mobileGroupActive = false;
                                    }   
                                });";
                            }else{
                             echo "$('#".$pageName."Mobile').show();";
                            }
                        echo "}
                    });";
                    echo "$(window).resize(function(){
                        var width = $(window).width();
                        console.log(width);
                        if (width < ".$mobileWidth." ){
                            document.getElementById('".$pageName."').style.display = 'none';
                            document.getElementById('".$pageName."Trigger').onmouseover = function(){
                                document.getElementById('".$pageName."').style.display = 'none';
                            };
                            document.getElementById('".$pageName."Trigger').onmouseout = function(){
                                document.getElementById('".$pageName."').style.display = 'none';
                            };";
                            if ($this->siteLinksMobileGroupClickToShow == true){
                                echo "
                                var mobileGroupActive = false;
                                $('#".$pageName."Trigger').click(function(){
                                     if (mobileGroupActive == false){
                                        $('#".$pageName."Mobile').css('display','block');
                                        mobileGroupActive = true;
                                    }else{
                                        $('#".$pageName."Mobile').css('display', 'none');
                                        mobileGroupActive = false;
                                    }   
                                });";
                            }else{
                             echo "$('#".$pageName."Mobile').show();";
                            }
                        echo "}
                        if (width > ".$mobileWidth." ){
                            document.getElementById('".$pageName."Trigger').onmouseover = function(){
                                document.getElementById('".$pageName."').style.display = 'block';
                            };
                            document.getElementById('".$pageName."Trigger').onmouseout = function(){
                                document.getElementById('".$pageName."').style.display = 'none';
                            };
                            $('#".$pageName."Mobile').hide();
                        }
                    });";
                    echo "</script>";
                    $functionCount = $functionCount + 1;
                }
        	}

		}else{
			echo "Variable siteLinksFormat is empty!";
		}

	}
    
    private function siteLinkTags($pageName, $stripTags){
        if ($stripTags == true){
            return $this->limitText($pageName, 120);
        }
        elseif($stripTags == false){
            return $this->limitText($pageName, 120, false);
        }
        else{
            echo "Variable must be boolean value";   
        }   
    }
    
    public function returnPageLink($type, $id){
        if ($type == 'normal' || $type == 'homepage'){
            if($id == 1){
                $pageLink = "index.php";
            }else{
                $pageLink = "page.php?page=" . $id;
            }
        }

        elseif ($type == 'blog'){
            $pageLink = "blog.php";
        }

        elseif ($type == 'contact'){
            $pageLink = "contact.php";
        }

        elseif ($type == 'relink'){
            $pageLink = $this->getPageLink($id);
        }
        return $pageLink;
    }
    
    public function getSiteLinksArray(){
        
        $array = array();
        
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $data = mysqli_query($db,"SELECT * FROM pages ORDER BY pageorder");
        
        $appendArray = array();
        
        while ($get_data = mysqli_fetch_assoc($data)){
            $appendArray = array(
                $get_data['id'],
                $get_data['isGrouped'],
                $get_data['groupID'],
                $get_data['pagetype']
            );
            $array[] = $appendArray;
        }
        
        return $array;
    }
    
    public function getPageLink($id){
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $data = mysqli_query($db,"SELECT * FROM pages WHERE id='$id'");
        $get_data = mysqli_fetch_assoc($data);
        return $get_data['additional'];
    }

    public function getTotalBlogEntries($countDraft = true){
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $data = mysqli_query($db,"SELECT * FROM blog");
        $count = 0;
        while ($get_data = mysqli_fetch_assoc($data)){
            if ($countDraft == true){
                if ($get_data['posttitle'] != null){
                    $count++;
                }
            }
            elseif ($countDraft == false){
                if ($get_data['posttitle'] != null && $get_data['draft'] == 'no'){
                    $count++;
                }
            }
            else{
                echo "Invalid Entry: Boolean required";
            }
        }
        return $count;
    }
    
    public function getTotalActivePosts(){
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $data = mysqli_query($db,"SELECT * FROM blog");
        $count = 0;
        while ($get_data = mysqli_fetch_assoc($data)){
            if ($get_data['status'] == 'active'){
                $count++;
            }
        }
        return $count;
    }

    public function getFolderId($folderName){
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $data = mysqli_query($db, "SELECT * FROM imageFolders WHERE folderName='$folderName'");
        $get_data = mysqli_fetch_assoc($data);
        if ($get_data['id'] != null){
            return $get_data['id'];
        }
        $db->close();
    }

    public function getFolderName($id){
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $data = mysqli_query($db, "SELECT * FROM imageFolders WHERE id='$id'");
        $get_data = mysqli_fetch_assoc($data);
        if ($get_data['folderName'] != null){
            return $get_data['folderName'];
        }
        $db->close();
    }
    
    public function getFileContents($file){
        if (file_exists($file)){
            echo file_get_contents($file);
        }else{
            echo "FILE DOES NOT EXIST";   
        }
    }
    
    public function getAllPostsByMonthAndYear ($year, $month){
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $data = mysqli_query($db,"SELECT * FROM blog");
        
        $posts = array();
        
        while($get_data = mysqli_fetch_assoc($data)){
            $postYear = substr($get_data['date'], 0, 4);
            $postMonth = substr($get_data['date'], 5, 2);
            if ($postYear == $year && $postMonth == $month){
                $posts[] = array($get_data['id'],$get_data['posttitle'],$get_data['postcontent']);
            }
        }
        
        return $posts;
    }

	/*  ===== Get Functions End ========  */




	/*  ===== Fetch Functions Start ========  */
	
	public function fetchImageFolders(){
		$sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
		$data = mysqli_query($db, "SELECT * FROM imageFolders ORDER BY folderOrder");
		while ($get_data = mysqli_fetch_assoc($data)){
			echo "<a href='viewImages.php?folder="
			.$get_data['folderName']."'><ul><li><img src='Images/folder.png'></li><li>"
			.$get_data['folderName']."</li></ul></a>";
		}
		$db->close();
	}
	
	public function fetchImageList($folder, $path = null){
		$sqlconnect = new Connectdb;
    	$db = $sqlconnect->connectTo();
		$sql = "SELECT * FROM images ORDER BY imageOrder";
		$query = mysqli_query($db,$sql);
		$count = 0;
		while ($get_data = mysqli_fetch_assoc($query)){
			
			if ($get_data['imageFolder'] == $folder){
				echo "<a href='".$path."image/".$get_data['image']."' data-lightbox='$folder' data-title='";
				if ($get_data['imagename'] != null){
					echo $get_data['imagename']."'>
					<ul><li><img src='".$path."image/"
					.$get_data['image']."'></li><li><p>"
					.$get_data['imagename']."</p>";
					
				}else{
					echo $get_data['image']."'><ul><li><img src='".$path."image/"
					.$get_data['image']."'></li><li><p>"
					.$get_data['image']."</p>";
				}
				echo "<a href='RenameImage.php?file="
				.$get_data['image']."&id="
				.$get_data['id']."&folder="
				.$get_data['imageFolder']
				."'><span class='pEditLinkButton'>Rename</span></a></li></ul></a>";
				$count++;
			}
			
		}
		
		if ($count < 1){
			echo "<h2>EMPTY FOLDER</h2>";
		}
		
		$db->close();
	}
	
	public function fetchImageSortList($folder, $path = null){
		$sqlconnect = new Connectdb;
    	$db = $sqlconnect->connectTo();
		$sql = "SELECT * FROM images ORDER BY imageOrder";
		$query = mysqli_query($db,$sql);
		$count = 0;
		while ($get_data = mysqli_fetch_assoc($query)){
			
			if ($get_data['imageFolder'] == $folder){
				echo "<li id='item_".$get_data['id']."'><img src='".$path."image/".$get_data['image']."' width='50px'><br>".$get_data['image']."</li>";
				$count++;
			}
			
		}
		
		if ($count < 1){
			echo "<h2>EMPTY FOLDER</h2>";
		}
		
		$db->close();
	}
	
	public function fetchImageFolderNames(){
		$sqlconnect = new Connectdb;
    	$db = $sqlconnect->connectTo();
		$sql = "SELECT * FROM imageFolders ORDER BY folderOrder";
		$query = mysqli_query($db,$sql);
		while ($get_data = mysqli_fetch_assoc($query)){
			echo "<li id='item_".$get_data['id']."'>".$get_data['folderName']."</li>";
		}
		$db->close();
	}
    
    
    public function fetchListOfTemplates($type){
        $sqlconnect = new Connectdb;
    	$db = $sqlconnect->connectTo();
        $data = mysqli_query($db, "SELECT * FROM templates ORDER BY templateOrder");
        $html = '';
        while($get_data = mysqli_fetch_assoc($data)){
            $html .= '
            <a href="../CreatePage.php?type='.$type.'&template='.$get_data['id'].'">
                <ul>
                    <li><img src="Images/templateIcon.png" style="width:60px"></li>
                    <li>'.$get_data['templateName'].'<br>
                    <a class="pEditLinkButton" href="../CreatePage.php?type='.$type.'&template='.$get_data['id'].'&e=yes">Edit</a><a class="pDeleteLinkButton" href="deleteTemplate.php?template='.$get_data['id'].'">Delete</a>
                    </li>
                </ul>
            </a>';
        }
        print $html;
    }
    
    public function getTemplateContent(){
        @$template = $_GET['template'];
        if ($template != 'blankPage' || $template != 'NewTemplate'){
            $sqlconnect = new Connectdb;
            $db = $sqlconnect->connectTo();
            $data = mysqli_query($db, "SELECT * FROM templates WHERE id='$template'");
            $get_data = mysqli_fetch_assoc($data);
            if ($get_data != null){
                echo $get_data['templateContent'];
            }
        }
    }

	/*  ===== Fetch Functions End ========  */




	/*  ===== Display Functions Start ========  */

    public function displayPostImage($id){
    	$sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $data = mysqli_query($db,"SELECT * FROM blog WHERE id='$id'");
		$get_data = mysqli_fetch_assoc($data);
		echo "<image src='image/".$get_data['image']."'>";
		$db->close();
    }


    public function displayTotalPageViews(){
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $data = mysqli_query($db,"SELECT * FROM pages");
        $views = 0;
        while ($get_data = mysqli_fetch_assoc($data)){
            if ($get_data['views'] > 0){
                $views = $views + $get_data['views'];
            }
        }
        return $views;
        $db->close();
    }
	

    public function displayTotalBlogViews(){
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $data = mysqli_query($db,"SELECT * FROM blog");
        $views = 0;
        while ($get_data = mysqli_fetch_assoc($data)){
            if ($get_data['views'] > 0){
                $views = $views + $get_data['views'];
            }
        }
        return $views;
        $db->close();
    }
    
    public function displayTotalSiteViews(){
        $views = $this->displayTotalPageViews() + $this->displayTotalBlogViews();
        return $views;
    }
	
    public function displayPopularBlog(){
        $GetPage = "SELECT * FROM blog ORDER BY views DESC LIMIT 3";
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $data = mysqli_query($db,$GetPage);
        $rank = 1;
        while ($get_data = mysqli_fetch_assoc($data)){     
            echo "<p class='pWhiteBasicTxt'>$rank. ".$this->limitText($get_data['posttitle'], 40)."&nbsp;&nbsp;<span class='pHightlightTxt'>views: ".$get_data['views']."</span></p>";
            $rank = $rank + 1;
        }
        $db->close();
    }
	
    public function displayPopularPages(){
        $GetPage = "SELECT * FROM pages ORDER BY views DESC LIMIT 3";
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $data = mysqli_query($db,$GetPage);
        $rank = 1;
        while ($get_data = mysqli_fetch_assoc($data)){
        		echo "<p class='pWhiteBasicTxt'>$rank. ".$this->limitText($get_data['pagename'], 40)."&nbsp;&nbsp;<span class='pHightlightTxt'>views: ".$get_data['views']."</span></p>";
            	$rank = $rank + 1;  
        }
        $db->close();
    }

    public function displaySEOTags(){
        echo "<meta name='keywords' content='".$this->getSiteTags()."'>";   
    }
    public function displaySEODescription(){
        echo "<meta name='description' content='".$this->getSiteDescription()."'>";   
    }
    
    public function displayBlogPostYearList(){
        $years = array();
        $years = $this->fetchBlogPostYears();
        foreach ($years as $year){
            echo "<a id='blogYear$year' >";
            echo $year;
            echo "</a>";
            echo "<br>";
            echo "<ul id='blogposts$year'>";
            $this->fetchPostsByYear($year);
            echo "<br>";
            echo "</ul>";
            echo "<script>";
            echo "var isOpen$year = false;";
            echo "$('#blogposts$year').hide();";
            echo "$('#blogYear$year').click(function(){
                        if (isOpen$year == false){
                            $('#blogposts$year').show();
                            isOpen$year = true;
                        }else{
                            $('#blogposts$year').hide();
                            isOpen$year = false;
                        }
                        
                    });";
            echo "</script>";
        }
    }
              
    private function fetchBlogPostYears(){
        $years = array();
        
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $query = "SELECT * FROM blog";
        $sql = mysqli_query($db, $query);
        while($get_data = mysqli_fetch_assoc($sql)){
            $get_year = substr($get_data['date'],0,4);
            if ($years != null){
                $count = 0;
                foreach ($years as $year){
                    if ($year == $get_year){
                        $count++;
                    }
                }
                if ($count == 0){
                    $years[] = $get_year;
                }
            }else{
                $years[] = $get_year;   
            }
        }
        sort($years,SORT_NUMERIC); 
        return $years;
    }
    
    public $showNumOfPostsOnMonth = true;
    public $postsByMonthLink = "postByMonth.php";
    
    private function fetchPostsByYear($year){
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $query = "SELECT * FROM blog";
        $sql = mysqli_query($db, $query);
        $storeUsedMonths = array();
        while($get_data = mysqli_fetch_assoc($sql)){
            $postYear = substr($get_data['date'],0,4);
            if ($postYear == $year){
                $postMonth =  substr($get_data['date'],5,2);
                $isUsed = false;
                foreach($storeUsedMonths as $month){
                    if ($month == $postMonth){
                        $isUsed = true;
                    }
                }
                if ($isUsed == false){
                    echo "<a href='$this->postsByMonthLink?year=$year&month=$postMonth' >";
                    if ($this->showNumOfPostsOnMonth == true){
                        echo $this->returnMonthName($postMonth)." (".$this->countMonthlyPosts($year,$postMonth).")";
                    }else{
                        echo $this->returnMonthName($postMonth);
                    }
                    echo "</a>";
                    echo "<br>";
                    $storeUsedMonths[] = $postMonth;
                }
            }
        }
    }
    
    private function countMonthlyPosts($year, $month){
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $query = "SELECT * FROM blog";
        $sql = mysqli_query($db, $query);
        $count = 0;
        while($get_data = mysqli_fetch_assoc($sql)){
            $getMonth = substr($get_data['date'],5,2);
            $getYear = substr($get_data['date'],0,4);
            if ($year == $getYear && $month == $getMonth){
                $count++;   
            }
        }
        return $count;
    }
    
    public $Months = array(
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December",
    );
    
    
    private function returnMonthName($val){
        if ($val == 01){
            return $this->Months[0];
        }
        elseif ($val == 02){
            return $this->Months[1];
        }
        elseif ($val == 03){
            return $this->Months[2];
        }
        elseif ($val == 04){
            return $this->Months[3];
        }
        elseif ($val == 05){
            return $this->Months[4];
        }
        elseif ($val == 06){
            return $this->Months[5];
        }
        elseif ($val == 07){
            return $this->Months[6];
        }
        elseif ($val == 08){
            return $this->Months[7];
        }
        elseif ($val == 09){
            return $this->Months[8];
        }
        elseif ($val == 10){
            return $this->Months[9];
        }
        elseif ($val == 11){
            return $this->Months[10];
        }
        elseif ($val == 12){
            return $this->Months[11];
        }else{
            return "No Matches";   
        }
    }


	/*  ===== Display Functions End ========  */




	
	/*  ===== Check Functions Start ========  */
	
	public function checkPostIDExists ($id){
		$sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
		$FindData = mysqli_query($db,"SELECT * FROM blog WHERE id='$id'");
		$get_FindData = mysqli_fetch_assoc($FindData);
		if ($get_FindData['id'] != null){
			$db->close();
			return TRUE;
		}
		else {
			$db->close();
			return FALSE;
		}
	}
	
	public function checkPostIDExistsNoDrafts ($id){
		$sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
		$FindData = mysqli_query($db,"SELECT * FROM blog WHERE id='$id'");
		$get_FindData = mysqli_fetch_assoc($FindData);
		if ($get_FindData['id'] != null && $get_FindData['draft'] == 'no'){
			$db->close();
			return TRUE;
		}
		else {
			$db->close();
			return FALSE;
		}
	}
    
    public function checkPostIDisActive ($id){
		$sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
		$FindData = mysqli_query($db,"SELECT * FROM blog WHERE id='$id'");
		$get_FindData = mysqli_fetch_assoc($FindData);
		if ($get_FindData['id'] != null && $get_FindData['status'] == 'active'){
			$db->close();
			return TRUE;
		}
		else {
			$db->close();
			return FALSE;
		}
	}
	
	public function checkImageFolderExist($folder){
		$sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
		$FindData = mysqli_query($db,"SELECT * FROM imageFolders WHERE folderName='$folder'");
		$get_FindData = mysqli_fetch_assoc($FindData);
		if ($get_FindData['folderName'] != null){
			$db->close();
			return TRUE;
		}
		else {
			$db->close();
			return FALSE;
		}
	}

    public function checkUser ($user){
        if ($user != null){
            $sqlconnect = new Connectdb;
            $db = $sqlconnect->connectTo();
            $data = mysqli_query($db,"SELECT * FROM users WHERE username='$user'");
            $get_data = mysqli_fetch_assoc($data);
             if (strtolower($get_data['username']) == strtolower($user))
            {
                return true;
            }else{
                header("location:accessviolation.php");
            }
            $db->close();
        }
        else{
           header("location:accessviolation.php");
        }
    }

    public function checkPrivileges($user){
        $GetUser = "SELECT * FROM users WHERE username='$user'";
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $data = mysqli_query($db,$GetUser);

        $Retrieve = mysqli_fetch_array($data);

        $EditorType = $Retrieve['acctype'];

        return $EditorType;
        $db->close();
    }

    public function checkPluginExist($plugin){
        $GetPlugin = "SELECT * FROM plugins WHERE pluginName='$plugin'";
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $data = mysqli_query($db,$GetPlugin);

        $Retrieve = mysqli_fetch_array($data);

        if ($Retrieve['pluginName'] != null){
            return true;
        }else{
            return false;
        }

        $db->close();
    }
    
    public function checkSiteImageStatus(){
        $getSite = "SELECT * FROM site";
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $data = mysqli_query($db,$getSite);

        $Retrieve = mysqli_fetch_array($data);

        if ($Retrieve['useimage'] != null){
            return $Retrieve['useimage'];
        }else{
            return null;
        }

        $db->close();  
    }
	
	/*  ===== Check Functions End ========  */
	
	

	/*  ===== Additional Functions Start ========  */


	public function removeHashTags ($string){
		preg_match_all("/(#\w+)/", $string, $matches);
		foreach ($matches[0] as $tag){
			$string = str_replace($tag, "", $string);	
		}
		return $string;
	}	
	
	/*  ===== Additional Functions End ========  */	
	
	
	
	
	
	
	
	
	
	

    //Other public functions
    
    public function isPageSourceEditingAllow(){
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $data = mysqli_query($db,"SELECT * FROM site WHERE id='1'");
        $get_data = mysqli_fetch_assoc($data);
        $value = $get_data['allowPageSource'];
        if ($value == 'yes'){
            $value = true;   
        }else{
            $value = false;  
        }
        return $value;
    }
	
    public function numOfCategoryPosts($Category){
        $query = "SELECT * FROM blog WHERE category='$Category'";
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $data = mysqli_query($db,$query);
        $count = 0;
        while ($get_data = mysqli_fetch_assoc($data)){
            if ($get_data['category'] && $get_data['status'] == 'active'){
                $count = $count + 1;   
            }
        }
        return $count;
        $db->close();
    }

    public function blogExist (){
    	$sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $data = mysqli_query($db,"SELECT * FROM blog");
		
		while ($get_data = mysqli_fetch_assoc($data)){
            if ($get_data['id'] == NULL){
            	return FALSE;
				break;
            }else{
            	return TRUE;
				break;
            }
        }
		$db->close();
    }

    public function removePageMargins(){
        echo "<style type='text/css'>";
        echo "html, body, #page {height: 100%;width: 100%;margin-top: 0px;margin-bottom: 0px;margin-left:0px;padding: 0;}";
        echo "#header{margin: 0;padding: 0;height : 20px;background-color : green;}";
        echo "</style>";   
    }
	

    // Old and needs revisit.
	public function generateParallaxAnimation ($html){
		
		$doc = new DOMDocument;
		$doc->loadHTML($html);
		$div = $doc->getElementsByTagName('div');

		
		foreach ($div as $node){
			if ($node->getAttribute('id') == 'BGIparallax'){
						
				foreach ($node->attributes as $attr){
								
					if ($attr->nodeName == 'parallaximg'){
						$image = $attr->nodeValue;
					}
					
					if ($attr->nodeName == 'anchor'){
						$anchor = $attr->nodeValue;
					}
								
				}
						
				echo "<div
						class=\"parallax-image-wrapper parallax-image-wrapper-100\"
						data-anchor-target=\"#$anchor + .gap\"
						data-bottom-top=\"transform:translate3d(0px, 200%, 0px)\"
						data-top-bottom=\"transform:translate3d(0px, 0%, 0px)\">
				
							<div
								class=\"parallax-image parallax-image-100\"
								style=\"background-image:url(image/$image)\"
								data-anchor-target=\"#$anchor + .gap\"
								data-bottom-top=\"transform: translate3d(0px, -80%, 0px);\"
								data-top-bottom=\"transform: translate3d(0px, 80%, 0px);\"
							></div>
						</div>";
			}
		}
		
	}


	public function initBlogFeed ($html){
		
		$doc = new DOMDocument;
		$doc->loadHTML($html);
		$div = $doc->getElementsByTagName('div');

		
		$PostCount = 0;
		$MaxChar = 0;
		$UseImg = "no";
		
		foreach ($div as $node){
			if ($node->getAttribute('id') == 'blogfeed'){
						
				foreach ($node->attributes as $attr){
								
					if ($attr->nodeName == 'title'){
						$title = $attr->nodeValue;
					}
					
					if ($attr->nodeName == 'btn-name'){
						$btnName = $attr->nodeValue;
					}
					
					if ($attr->nodeName == 'limit'){
						$MaxChar = $attr->nodeValue;
					}
					
					if ($attr->nodeName == 'post-count'){
						$PostCount = $attr->nodeValue;
					}
					
					
					if ($attr->nodeName == 'use-images'){
						$UseImg = $attr->nodeValue;
					}else{
						$UseImg = "no";
					}
								
				}

			}
		}
		
		$code = $this->displayBlogFeedList($PostCount, $MaxChar, $UseImg);
		if ($code == "<ul></ul>"){
			$htmlOutput = '';
		}else{
			$htmlOutput = "<h1>$title</h1>$code<div class='ReadMoreBtn'><a href='blog.php'>$btnName</a></div>";	
		}
		
		echo '<script>
		$(document).ready(function(){';
		
		if ($htmlOutput == ''){
			echo '$(".NewsContentWrapper").hide();';
		}else{
			echo '$("#blogfeed").append("'.$htmlOutput.'");';
		}
	
		echo '});
		</script>';
		
		
	}

	public function displayBlogFeedList($PostCount, $MaxChar, $UseImg){
		$sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        //$query = "SELECT * FROM blog ORDER BY id DESC LIMIT $PostCount";
		$query = "SELECT * FROM blog ORDER BY id DESC LIMIT $PostCount";
        $data = mysqli_query($db,$query);
		
		$html = '';
		
		$html .= "<ul>";
		
		$count = 1;
		
		while ($get_data = mysqli_fetch_assoc($data)){
				
			if ($count <= $PostCount){
				if ($get_data['draft'] == 'no'){
					$StripTags = strip_tags($get_data['postcontent']);	
					$LimitBody = substr($StripTags, 0, $MaxChar);
					
					$imgFile = $get_data['image'];
					$postTitle = $get_data['posttitle'];
					
					$html .= "<a href='blogPost.php?postID=".$get_data['id']."'>";
					$html .= "<li>";
					
					if ($UseImg == "yes" && $imgFile != null){
						$html .= "<image src='image/$imgFile'>";
					}
					$html .= "<h1>$postTitle</h1>";
					$html .= "<p>$LimitBody...</p>";
					$html .= "</li>";
					$html .= "</a>";
					$count ++;
				}
			}
		}
		
		$html .= "</ul>";
		
		return preg_replace( "/\r|\n/", "", $html );
		
		$db->close();
		
	}
	
	
	public function tableExist($name){ //Returns True or False
		$sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
		$sql = "SHOW TABLES LIKE '".$name."'";
		$query = mysqli_query($db,$sql);
		$tableExist = mysqli_num_rows($query);
		if ($tableExist > 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	
	function limitText($string, $limit, $removeTags = true){
        if ($removeTags == true){
            $string = strip_tags($string);	
        }
		$LimitBody = substr($string, 0, $limit);
		return $LimitBody;
	}
	
	function formatDate ($TimeStamp){
		
		$Day = substr($TimeStamp, -2);
		$month = substr($TimeStamp, 5, -3);
		$year = substr($TimeStamp, 0, -6);
		
		if ($month == '01'){
			$month = 'Jan';
		}
		if ($month == '02'){
			$month = 'Feb';
		}
		if ($month == '03'){
			$month = 'Mar';
		}
		if ($month == '04'){
			$month = 'Apr';
		}
		if ($month == '05'){
			$month = 'May';
		}
		if ($month == '06'){
			$month = 'Jun';
		}
		if ($month == '07'){
			$month = 'Jul';
		}
		if ($month == '08'){
			$month = 'Aug';
		}
		if ($month == '09'){
			$month = 'Sep';
		}
		if ($month == '10'){
			$month = 'Oct';
		}
		if ($month == '11'){
			$month = 'Nov';
		}
		if ($month == '12'){
			$month = 'Dec';
		}
		
		$Date = $month . " " . $Day . " " . $year;
		
		return $Date;
		
	}
	
	
	
	
	public $editorBar_dirStructure = null;
    public $editorBar_classname = "Editable";
    public $editorBar_usesImage = false;
    public $editorBar_titleID = "SaveTitleContent";
    public $editorBar_contentID = "SaveContent";
    public $editorBar_template = false;
    public $editorBar_templateID = 0;
	
	//Peacock Control Panel Code =============================================
	public function editorBar($nameBox = true, $pageID = 0, $pageType = 'normal'){

		//Declarations
		$pageName = '';
		$edit = false;
		$titlePasser = '';
		$contentPasser = '';
		$imagePasser = '';

		if ($pageID == 0){
			$pageName = 'Insert Page Name';
		}else{
			$pageName = $this->getPageName($pageID);
			$edit = true;
		}

		if ($pageType == 'blogPost'){
			$titlePasser = 'postname';
			$contentPasser = 'postcontent';
		}else{
			$titlePasser = 'pagename';
			$contentPasser = 'pagecontent';
		}

		if ($this->editorBar_usesImage == true && $pageType == 'blogPost'){
			$imagePasser = 'postimage';
		}else{
			$imagePasser = 'image';
		}
        
        
        
        //Gather Styles and functions for javascript peacock inline editor
        $peacock_inline_editor_load = "
            <link href='peacock/css/peacock-inline-editor-style.css' rel='stylesheet' type='text/css' />
            <script src='peacock/js/peacock-inline-editor.js'></script>";
        //==================================================================
        
        
        
        //Dialog box for when user wishes to revert to a previous backup.
        $messageBox = "
            <link href='peacock/css/PeacockStyles.css' rel='stylesheet' type='text/css' /> 
            <div id='dialog-overlay'></div>
            <div id='confirmRevert' class='pDialogBox' style='position:fixed;width:400px; height:140px;'> 	
                <div class='pDialogBoxHeader'>
                    Revert to Previous Backup
                </div>

                <div class='pDialogBoxContent'>
                <center>
                    Are you sure you want to revert to a previous backup?<br><br>
                    <a href='#' name='applyRevert' class='pDialogBoxButton'>yes</a>
                    <a href='#' name='closeRevert' class='pDialogBoxButton'>no</a>
                </center>
                </div>
            </div>    
        ";
        //======================================================================

        
        
        
        //Editor top bar which allows you to save as draft/final and revert to previous backup
		$topbar = "
		    <div id='pEditorTopBar' style='position:fixed;width:100%;z-index:999'>
		    <table width='95%' border='0px'>
		    <tr>
		        <td width='60px'><img src='view/image/Icons/PeacockCMS_Logo_Icon.png' width='40px' height='40px'></td>
		        <td width='260px' class='phLarge'>PEACOCK EDITOR</td>";

		    if ($nameBox == true){
		    	$topbar .= "<td><input type='text' class='pPageNameField' id='".$titlePasser."' value='".$pageName."' size='35' /></td>";
		    }    
		        
		$topbar .=  "<td style='color:white'>
		        	<form id='imageUploadForm' action='".$this->editorBar_dirStructure."peacock/multiUploaderInEditor.php' method='post'>
		        		<span class='pWhiteBasicTxt'>Upload Images (max 6mb)</span><input type='file' class='pWhiteBasicTxt' id='ImageBrowse' name='files[]' multiple='multiple' min='1' max='9999' />
		        	</form>
		        </td>
                
                
		        <form name='form' id='pageForm' action='".$this->editorBar_dirStructure."peacock/submission.php' method='post'>
		        <td width='100px' class='pWhiteBasicTxt'><input type='radio' name='draft' value='yes'>Draft<br><input type='radio' name='draft' value='no' checked>Final";
        
        if ($pageID != 0){
            $showRevertBtn = false;
            if ($pageType == 'blogPost'){
                if (file_exists('view/backups/posts/postBackup-'.$pageID.'.json')){
                    $showRevertBtn = true;
                }
            }else{
                if (file_exists('view/backups/pages/pageBackup-'.$pageID.'.json')){
                    $showRevertBtn = true;
                }
            }
            if ($showRevertBtn == true){
                $topbar .= "<br><div id='revertToBackup' style='display:inlineblock;cursor:pointer;color:#3498db'>Revert To Previous</div>";
            }
        }
                $topbar .= "</td>
		        <td valign='middle' width='150px' align='left'><div class='pSubmitBtnShape' onclick='Save()'>submit</div></a></td>
		        <td valign='middle' width='150px' align='left'><a href='".$dirStructure."peacock/controlpanel.php' class='pCancelBtnShape'>cancel</a></td>
	        </tr>
		    </table>
		    </div>";

		$form .= "
                <input type='hidden' name='$titlePasser' id='pagenamePasser' />
				<input type='hidden' name='$contentPasser' id='contentPasser' />";

				if ($this->editorBar_usesImage == true){
					$form .= "<input type='hidden' name='$imagePasser' id='imagePasser' />";
				}

				if ($edit == true && $this->editorBar_template == false){

					$form .= "<input type='hidden' name='id' value='$pageID'/>";

					if ($pageType == 'blogPost'){
						$form .= "<input type='hidden' name='subType' value='editPost'/>";
					}else
					{
						$form .= "<input type='hidden' name='subType' value='editPage'/>";
					}	
				}
				elseif ($edit == false && $this->editorBar_template == false){

					if ($pageType == 'blogPost'){
						$form .= "<input type='hidden' name='subType' value='blogSubmit'/>";
					}else{
						$form .= "<input type='hidden' name='subType' value='submitPage'/>";
					}
					
					if ($pageType == 'normal'){
						//Normal Page AKA Page
						$form .= "<input type='hidden' name='pageType' id='pageType' value='normal' />";
					}
					elseif($pageType == 'subpage'){
						//SubPage
						$form .= "<input type='hidden' name='pageType' id='pageType' value='subpage' />";
					}
					else{

					}
				}
				elseif ($this->editorBar_template == true){
                    if ($this->editorBar_templateID > 0){
                        $form .= "<input type='hidden' name='subType' value='editTemplate'/>";
                        $form .= "<input type='hidden' name='templateID' value='".$this->editorBar_templateID."'/>";
                    }else{
                        $form .= "<input type='hidden' name='subType' value='createTemplate'/>";
                    }
				}

        
        $form .= "</form>";
        
        //Load up Peacock Inline Editor ============================
        $peacock_inline_editor = '<script>
        $(document).ready(function(){
            var inlineeditor = new init_Peacock_InlineEditor();
            inlineeditor.classname = "'.$this->editorBar_classname.'";
            inlineeditor.run();});</script>';
        //============================================================
				
		$javascript .= "

		    <script type='text/javascript'>
	    		$(document).ready(function (e) {
				    $('#imageUploadForm').on('submit',(function(e) {
				        e.preventDefault();
				        var formData = new FormData(this);

				        $.ajax({
				            type:'POST',
				            url: $(this).attr('action'),
				            data:formData,
				            cache:false,
				            contentType: false,
				            processData: false,
				            success:function(data){
				                alert('Uploaded Successfully');
				            },
				            error: function(data){
				                alter('error: check console');
				                console.log(data);
				            }
				        });
				    }));

				    $('#ImageBrowse').on('change', function() {
				        $('#imageUploadForm').submit();
				    });
                    
	
                    $('#dialog-overlay, #confirmRevert').hide();
                    
                });";


        
        
        /*
            =====================================================
            Revert to previous backup of page.
        */
        
          if ($pageID != 0){
            $javascript .= "
                
                $('#revertToBackup').click(function(){
                    $('#dialog-overlay, #confirmRevert').fadeIn('slow');
                });
              
                $('a[name=applyRevert]').click(function(){";
                if ($pageType == 'blogPost'){
                    $javascript .= "
                    $.getJSON('view/backups/posts/postBackup-".$pageID.".json', function(result){";
                }
              else{
                    $javascript .= "
                    $.getJSON('view/backups/pages/pageBackup-".$pageID.".json', function(result){";
                }
                
            $javascript .= "
                        var newEditor = new init_Peacock_InlineEditor();
                        newEditor.removeEditors();
                        $('#".$this->editorBar_contentID."').html(result.body);
                        ";
                        if ($nameBox == true){
                            $javascript .= "$('#$titlePasser').val(result.title);";
                        }else{
                            $javascript .= "$('#".$this->editorBar_titleID."').html(result.title);";
                        }
                        $javascript .= "$('#dialog-overlay, #confirmRevert').hide();
                        newEditor.run();
                    });
            
            });";
              
            $javascript .= "$('a[name=closeRevert]').click(function(){
                        $('#dialog-overlay, #confirmRevert').hide();
                    });";
        }

        //=======================================================

		
        
        
        $javascript .= "function Save(){
                        var removeEditor = new init_Peacock_InlineEditor();
                        removeEditor.removeEditors();";

				if ($this->editorBar_usesImage == true){
					$javascript .= "
                        var imageData = $('#pageImage').val();
                        $('#imagePasser').val(imageData);";
				}
        
                if ($nameBox == false){
                    $javascript .= "
                        var PageNameData = $('#$this->editorBar_titleID').html();
                        $('#pagenamePasser').val(PageNameData);
                    ";   
                }else{
                    $javascript .= "
                        var PageNameData = $('#".$titlePasser."').val();
                        $('#pagenamePasser').val(PageNameData);
                    ";
                }
        
		$javascript .=	"
                    var bodycontent = $('#$this->editorBar_contentID').html();
                    $('#contentPasser').val(bodycontent);
		    		$('#pageForm').submit();
				}

		    </script>

		    ";
        
        print $peacock_inline_editor_load.$messageBox.$topbar.$form.$peacock_inline_editor.$javascript;
	}
    
    
    public function runPeacockEditor($nameBox, $ID){    
        $type = $_GET['type'];
        $template = $_GET['template'];
        @$editTemplate = $_GET['e'];
        
        if ($template == 'blankPage'){
            $this->editorBar($nameBox, 0, $type);
        }
        elseif ($template == 'NewTemplate'){
            $this->editorBar_classname = "Template-Editable";
            $this->editorBar_template = true;
            $this->editorBar($nameBox, 0, $type);
        }
        else{
            if ($editTemplate == 'yes'){
                $this->editorBar_classname = "Template-Editable";
                $this->editorBar_template = true;
            }
            $this->editorBar_templateID = $template;
            $this->editorBar($nameBox, $ID, $type); 
        }
    }
    
    

    public function fetchImagesLimited($path = null){
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $data = mysqli_query($db,"SELECT * FROM images ORDER BY id DESC LIMIT 5");

        echo "<p class='ph3'>Upload Images to use on your Page or Post.</p>";
        echo "<table width='100%'>";

        while ($get_data = mysqli_fetch_assoc($data)){
            if ($get_data['image']){
                echo "<tr>";
                echo "<td width='60px'><img src='".$path."image/".$get_data['image']."' height='50'></td>";
                echo "<td><p class='pbodyTxt'>".$this->getImageName($get_data['id']);
                echo "<a href='RenameImage.php?id=".$get_data['id']."&file=".$get_data['image']."' class='pEditLinkButton'>Rename</a><a href='deleteImage.php?id=".$get_data['id']."&file=".$get_data['image']."' class='pDeleteLinkButton'>Delete</a>";
                echo "</p></td>";
                echo "<tr>";
            }
        }
        echo "<tr><td >&nbsp;</td><td></td></tr>";
        echo "<tr><td></td><td align='right'><a href='viewImageFolders.php' class='pEnableLinkButton' style='padding:10px;text-transform:uppercase'>Image Manager (No. of imgs ".$this->fetchNumberOfImages().")</a></td></tr>";
        echo "</table>";
        $db->close();
    }
    public function fetchImages(){
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $data = mysqli_query($db,"SELECT * FROM images ORDER BY id DESC");

        echo "<table width='100%'>";
        echo "<tr><td>Thumbnail</td><td>Code to Copy & Paste</td></tr>";

        while ($get_data = mysqli_fetch_assoc($data)){
            if ($get_data['image']){
                echo "<tr>";
                echo "<td width='150px'><img src='image/".$get_data['image']."' height='80'></td>";
                echo "<td><p class='pbodyTxt'>Name: ".$this->getImageName($get_data['id'])."</p>";
                echo "<p class='pbodyTxt'>Location: image/".$get_data['image']."</p>";
                echo "<a href='RenameImage.php?id=".$get_data['id']."&file=".$get_data['image']."' class='pEditLinkButton'>Rename</a><a href='deleteImage.php?id=".$get_data['id']."&file=".$get_data['image']."' class='pDeleteLinkButton'>Delete</a>";
                echo "</td>";
                echo "<tr>";
                echo "<tr><td >&nbsp;</td><td></td></tr>";
            }
        }
        echo "</table>";
        $db->close();
    }
	public function fetchNumberOfImages(){
		$sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $data = mysqli_query($db,"SELECT * FROM images");
		
		$imageNum = 0;
		
		while($get_data = mysqli_fetch_assoc($data)){
			if ($get_data['image'] != null){
				$imageNum = $imageNum + 1;
			}
		}
		
		return $imageNum;
	}
    public function fetchPages($path = null, $showBlog = true, $pageImage = false, $showGroups = false){
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $data = mysqli_query($db,"SELECT * FROM pages ORDER BY pageorder");
        
        $PageEditStatus = 'hidden';
		
        while ($get_data = mysqli_fetch_assoc($data)){

        	$pageName = $this->limitText($get_data['pagename'], 80);
            if ($get_data['isGrouped'] == 'false'){
                
                
                if ($get_data['pagetype'] == 'homepage'){
                    if ($get_data['draft'] == 'yes' && $get_data['status'] == 'draft'){
                        echo $pageName."<a class='txtTag'>[draft]</a>";
                    }
                    else{
                        echo $pageName;
                    }
                    echo "<a class='txtTag'>{homepage}</a><a class='pEditLinkButton' href='".$path."EditPage.php?id=" . $get_data['id'] . "'>Edit</a>";
                    
                    if ($get_data['draft'] == 'yes' && $get_data['status'] != 'draft'){
                        if (file_exists('../view/drafts/pages/pageDraft-'.$get_data['id'].'.json')){
                            echo "<a class='pEditLinkButton' href='".$path."EditPage.php?id=" . $get_data['id'] . "&draft=yes'>Open Draft</a>";
                        }
                    }
                    
                    if ($pageImage == true){
                        if ($get_data['image'] != null){
                            echo "<a class='pEditLinkButton' href='setPageImage.php?id="
                                . $get_data['id'] . "&img=".$get_data['image']."'>Page Image</a>";
                        }else{
                            echo "<a class='pEditLinkButton' href='setPageImage.php?id="
                                . $get_data['id'] . "'>Page Image</a>";
                        }
                    }
                    
                    if ($this->isPageSourceEditingAllow() == true){
                        echo "<a class='pEditLinkButton' href='editPageSource.php?id="
                                . $get_data['id'] . "'>Edit Source</a>";
                    }
                    
                    
                    if ($get_data['status'] == 'hidden' && $get_data['status'] != 'draft'){
                        echo "<a class='pDisableLinkButton' href='changePageStatus.php?id=" . $get_data['id'] . "&status=active'>Unhide</a>";
                    }
                    elseif($get_data['status'] == 'active' && $get_data['status'] != 'draft'){
                        echo "<a class='pEnableLinkButton' href='changePageStatus.php?id=" . $get_data['id'] . "&status=hidden'>Hide</a>";
                    }

                    echo "<br>";
                    echo "<br>";
                }
                
                
                
                elseif($get_data['pagetype'] == 'blog' && $showBlog == true){
                    echo $pageName;
                    echo "<a class='txtTag'>{blog}</a><a class='pEditLinkButton' href='".$path."EditPage.php?id=" . $get_data['id'] . "'>Edit</a>";
                    if ($pageImage == true){
                        if ($get_data['image'] != null){
                            echo "<a class='pEditLinkButton' href='setPageImage.php?id="
                                . $get_data['id'] . "&img=".$get_data['image']."'>Page Image</a>";
                        }else{
                            echo "<a class='pEditLinkButton' href='setPageImage.php?id="
                                . $get_data['id'] . "'>Page Image</a>";
                        }
                    }
                    if ($get_data['status'] == 'active'){
                        echo "<a class='pEnableLinkButton' href='PageUpdateStatus.php?id=" . $get_data['id'] . "&status=disable'>Enabled</a>";
                    }else{
                        echo "<a class='pDisableLinkButton' href='PageUpdateStatus.php?id=" . $get_data['id'] . "&status=active'>Disabled</a>";
                    }
                    echo "<br>";
                    echo "<br>";
                }
                
                
                elseif($get_data['pagetype'] == 'contact'){
                    echo $pageName;
                    echo "<a class='txtTag'>{contact}</a><a class='pEditLinkButton' href='editContactPage.php?id=" . $get_data['id'] . "' class='pLinkTxt'>Edit</a>";
                    if ($pageImage == true){
                        if ($get_data['image'] != null){
                            echo "<a class='pEditLinkButton' href='setPageImage.php?id="
                                . $get_data['id'] . "&img=".$get_data['image']."'>Page Image</a>";
                        }else{
                            echo "<a class='pEditLinkButton' href='setPageImage.php?id="
                                . $get_data['id'] . "'>Page Image</a>";
                        }
                    }
                    if ($get_data['status'] == 'active'){
                        echo "<a class='pEnableLinkButton' href='PageUpdateStatus.php?id=" . $get_data['id'] . "&status=disable'>Enabled</a>";
                    }else{
                        echo "<a class='pDisableLinkButton' href='PageUpdateStatus.php?id=" . $get_data['id'] . "&status=active'>Disabled</a>";
                    }
                    echo "<br>";
                    echo "<br>";
                }
                
                
                
                elseif ($get_data['pagetype'] == 'relink'){
                    echo $pageName;
                    $editlink = $get_data['additional2'];

                    echo "<a class='txtTag'>{custom}</a>";

                    if ($editlink != null | $editlink != ''){
                        echo "<a class='pEditLinkButton' href='editCustomPage.php?id=" . $get_data['id'] . "&page=".$get_data['pagename']."&url=".$get_data['additional']."&edit=".$editlink."'>Edit Link</a><a class='pEditLinkButton' href='$editlink?id=" . $get_data['id'] . "'>Edit Page</a>";
                    }else{
                        echo "<a class='pEditLinkButton' href='editCustomPage.php?id=" . $get_data['id'] . "&page=".$get_data['pagename']."&url=".$get_data['additional']."'>Edit</a>";
                    }
                    
                    if ($get_data['status'] == 'hidden'){
                        echo "<a class='pDisableLinkButton' href='changePageStatus.php?id=" . $get_data['id'] . "&status=active'>Unhide</a>";
                    }elseif($get_data['status'] == 'active'){
                        echo "<a class='pEnableLinkButton' href='changePageStatus.php?id=" . $get_data['id'] . "&status=hidden'>Hide</a>";
                    }

                    echo "<a href='deletePageConfirmation.php?id=" . $get_data['id'] ."&page=".$get_data['pagename']."' class='pDeleteLinkButton'>Delete<a>";

                    echo "<br>";
                    echo "<br>";
                }
                
                
                
                elseif ($get_data['pagetype'] == 'normal'){
                    if ($get_data['draft'] == 'yes' && $get_data['status'] == 'draft'){
                        echo $pageName."<a class='txtTag'>[draft]</a>";
                    }
                    else{
                        echo $pageName;
                    }
                    echo "<a class='pEditLinkButton' href='".$path."EditPage.php?id=" . $get_data['id'] . "'>Edit</a>";
                    
                    if ($get_data['draft'] == 'yes' && $get_data['status'] != 'draft'){
                        if (file_exists('../view/drafts/pages/pageDraft-'.$get_data['id'].'.json')){
                            echo "<a class='pEditLinkButton' href='".$path."EditPage.php?id=" . $get_data['id'] . "&draft=yes'>Open Draft</a>";
                        }
                    }
                    
                    if ($pageImage == true){
                        if ($get_data['image'] != null){
                            echo "<a class='pEditLinkButton' href='setPageImage.php?id="
                                . $get_data['id'] . "&img=".$get_data['image']."'>Page Image</a>";
                        }else{
                            echo "<a class='pEditLinkButton' href='setPageImage.php?id="
                                . $get_data['id'] . "'>Page Image</a>";
                        }
                    }
                    
                    if ($this->isPageSourceEditingAllow() == true){
                        echo "<a class='pEditLinkButton' href='editPageSource.php?id="
                                . $get_data['id'] . "'>Edit Source</a>";
                    }

                    echo "<a href='deletePageConfirmation.php?id=" . $get_data['id'] ."&page=".strip_tags($get_data['pagename'])."' class='pDeleteLinkButton'>Delete<a>";

                    if ($get_data['status'] == 'hidden' && $get_data['status'] != 'draft'){
                        echo "<a class='pDisableLinkButton' href='changePageStatus.php?id=" . $get_data['id'] . "&status=active'>Unhide</a>";
                    }
                    elseif($get_data['status'] == 'active' && $get_data['status'] != 'draft'){
                        echo "<a class='pEnableLinkButton' href='changePageStatus.php?id=" . $get_data['id'] . "&status=hidden'>Hide</a>";
                    }

                    echo "<br>";
                    echo "<br>";
                }
                
                
                
                elseif ($get_data['pagetype'] == 'group' && $showGroups == true){
                    echo "<a href='editPageGroup.php?grpID=".$get_data['id']."' class='plinkTxt'><b>".$pageName."</b></a>";
                    echo "<br><br>";
                }
            }
        }
        $db->close();
    }
        public function fetchGroupPages($ID, $path = null, $pageImage = false){
        $sqlconnect = new Connectdb;
    	$db = $sqlconnect->connectTo();
		$sql = "SELECT * FROM pages ORDER BY pageorder";
		$query = mysqli_query($db,$sql);
		while ($get_data = mysqli_fetch_assoc($query)){
			$pageName = $this->limitText($get_data['pagename'], 80);
            if ($get_data['groupID'] == $ID){
                if ($get_data['pagetype'] == 'homepage'){
                    if ($get_data['draft'] == 'yes' && $get_data['status'] == 'draft'){
                        echo $pageName."<a class='txtTag'>[draft]</a>";
                    }
                    else{
                        echo $pageName;
                    }
                    echo "<a class='txtTag'>{homepage}</a><a class='pEditLinkButton' href='".$path."EditPage.php?id=" . $get_data['id'] . "'>Edit</a>";
                    
                    if ($get_data['draft'] == 'yes' && $get_data['status'] != 'draft'){
                        if (file_exists('../view/drafts/pages/pageDraft-'.$get_data['id'].'.json')){
                            echo "<a class='pEditLinkButton' href='".$path."EditPage.php?id=" . $get_data['id'] . "&draft=yes'>Open Draft</a>";
                        }
                    }
                    
                    if ($pageImage == true){
                        if ($get_data['image'] != null){
                            echo "<a class='pEditLinkButton' href='setPageImage.php?id="
                                . $get_data['id'] . "&img=".$get_data['image']."'>Page Image</a>";
                        }else{
                            echo "<a class='pEditLinkButton' href='setPageImage.php?id="
                                . $get_data['id'] . "'>Page Image</a>";
                        }
                    }
                    if ($get_data['status'] == 'hidden'){
                        echo "<a class='pDisableLinkButton' href='changePageStatus.php?id=" . $get_data['id'] . "&status=active'>Unhide</a>";
                    }
                    elseif($get_data['status'] == 'active'){
                        echo "<a class='pEnableLinkButton' href='changePageStatus.php?id=" . $get_data['id'] . "&status=hidden'>Hide</a>";
                    }
                }
                elseif($get_data['pagetype'] == 'blog'){
                    echo $pageName;
                    echo "<a class='txtTag'>{blog}</a><a class='pEditLinkButton' href='".$path."EditPage.php?id=" . $get_data['id'] . "'>Edit</a>";
                    if ($pageImage == true){
                        if ($get_data['image'] != null){
                            echo "<a class='pEditLinkButton' href='setPageImage.php?id="
                                . $get_data['id'] . "&img=".$get_data['image']."'>Page Image</a>";
                        }else{
                            echo "<a class='pEditLinkButton' href='setPageImage.php?id="
                                . $get_data['id'] . "'>Page Image</a>";
                        }
                    }
                    if ($get_data['status'] == 'active'){
                        echo "<a class='pEnableLinkButton' href='PageUpdateStatus.php?id=" . $get_data['id'] . "&status=disable'>Enabled</a>";
                    }else{
                        echo "<a class='pDisableLinkButton' href='PageUpdateStatus.php?id=" . $get_data['id'] . "&status=active'>Disabled</a>";
                    }
                }
                elseif($get_data['pagetype'] == 'contact'){
                    echo $pageName;
                    echo "<a class='txtTag'>{contact}</a><a class='pEditLinkButton' href='editContactPage.php?id=" . $get_data['id'] . "' class='pLinkTxt'>Edit</a>";
                    if ($pageImage == true){
                        if ($get_data['image'] != null){
                            echo "<a class='pEditLinkButton' href='setPageImage.php?id="
                                . $get_data['id'] . "&img=".$get_data['image']."'>Page Image</a>";
                        }else{
                            echo "<a class='pEditLinkButton' href='setPageImage.php?id="
                                . $get_data['id'] . "'>Page Image</a>";
                        }
                    }
                    if ($get_data['status'] == 'active'){
                        echo "<a class='pEnableLinkButton' href='PageUpdateStatus.php?id=" . $get_data['id'] . "&status=disable'>Enabled</a>";
                    }else{
                        echo "<a class='pDisableLinkButton' href='PageUpdateStatus.php?id=" . $get_data['id'] . "&status=active'>Disabled</a>";
                    }
                }
                elseif ($get_data['pagetype'] == 'relink'){
                    echo $pageName;
                    $editlink = $get_data['additional2'];

                    echo "<a class='txtTag'>{custom}</a>";

                    if ($editlink != null | $editlink != ''){
                        echo "<a class='pEditLinkButton' href='editCustomPage.php?id=" . $get_data['id'] . "&page=".$get_data['pagename']."&url=".$get_data['additional']."&edit=".$editlink."'>Edit Link</a><a class='pEditLinkButton' href='$editlink?id=" . $get_data['id'] . "'>Edit Page</a>";
                    }else{
                        echo "<a class='pEditLinkButton' href='editCustomPage.php?id=" . $get_data['id'] . "&page=".$get_data['pagename']."&url=".$get_data['additional']."'>Edit</a>";
                    }

                    echo "<a href='deletePageConfirmation.php?id=" . $get_data['id'] ."&page=".$get_data['pagename']."' class='pDeleteLinkButton'>Delete<a>";
                }
                elseif ($get_data['pagetype'] == 'normal'){
                    if ($get_data['draft'] == 'yes' && $get_data['status'] == 'draft'){
                        echo $pageName."<a class='txtTag'>[draft]</a>";
                    }
                    else{
                        echo $pageName;
                    }
                    echo "<a class='pEditLinkButton' href='".$path."EditPage.php?id=" . $get_data['id'] . "'>Edit</a>";
                    
                    if ($get_data['draft'] == 'yes' && $get_data['status'] != 'draft'){
                        if (file_exists('../view/drafts/pages/pageDraft-'.$get_data['id'].'.json')){
                            echo "<a class='pEditLinkButton' href='".$path."EditPage.php?id=" . $get_data['id'] . "&draft=yes'>Open Draft</a>";
                        }
                    }
                    
                    if ($pageImage == true){
                        if ($get_data['image'] != null){
                            echo "<a class='pEditLinkButton' href='setPageImage.php?id="
                                . $get_data['id'] . "&img=".$get_data['image']."'>Page Image</a>";
                        }else{
                            echo "<a class='pEditLinkButton' href='setPageImage.php?id="
                                . $get_data['id'] . "'>Page Image</a>";
                        }
                    }

                    echo "<a href='deletePageConfirmation.php?id=" . $get_data['id'] ."&page=".strip_tags($get_data['pagename'])."' class='pDeleteLinkButton'>Delete<a>";

                    if ($get_data['status'] == 'hidden'){
                        echo "<a class='pDisableLinkButton' href='changePageStatus.php?id=" . $get_data['id'] . "&status=active'>Unhide</a>";
                    }
                    elseif($get_data['status'] == 'active'){
                        echo "<a class='pEnableLinkButton' href='changePageStatus.php?id=" . $get_data['id'] . "&status=hidden'>Hide</a>";
                    }
                }
                elseif ($get_data['pagetype'] == 'group'){
                    echo "<a href='editPageGroup.php?grpID=".$get_data['id']."' class='plinkTxt'><b>".$pageName."</b></a>";
                    echo "&nbsp&nbsp";
                }
                echo "<a class='pDisableLinkButton' href='ungroupPage.php?id=" . $get_data['id'] . "?grpID=".$ID."'>Ungroup</a>";
                echo "<br><br>";
            }
            
		}
		$db->close(); 
    }
    public function fetchSubPages($path){
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $data = mysqli_query($db,"SELECT * FROM pages ORDER BY pageorder");
        while ($get_data = mysqli_fetch_assoc($data)){
            if ($get_data['pagetype'] == 'subpage'){
                if ($get_data['draft'] == 'yes' && $get_data['status'] == 'draft'){
                    echo $this->limitText($get_data['pagename'],80)."<a class='txtTag'>&nbsp;&nbsp;[draft]</a>";
                }
                else{
                    echo $this->limitText($get_data['pagename'],80);
                }
                echo "<a href='".$path."EditPage.php?id=" . $get_data['id'] . "' class='pEditLinkButton'>Edit</a>";
                if ($get_data['draft'] == 'yes' && $get_data['status'] != 'draft'){
                    echo "<a href='".$path."EditPage.php?id=" . $get_data['id'] . "&draft=yes' class='pEditLinkButton'>Open Draft</a>";
                }
                echo "<a href='deletePageConfirmation.php?id=" . $get_data['id'] ."&page=".$get_data['pagename']."' class='pDeleteLinkButton'>Delete<a>";
                echo "<br>";
                echo "<br>";
            }
        }
        $db->close();
    }
    public function fetchBlogPosts($username, $path){
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();   
        $data = mysqli_query($db, "SELECT * FROM blog ORDER BY id DESC");
		
		$username = strtolower($username);
		
        $string = '';
        
        while ($get_data = mysqli_fetch_assoc($data)){
        	
			$user = strtolower($get_data['user']);
			
        	if ($username == $user || $username == 'admin'){
	            if ($get_data['draft'] == 'yes' && $get_data['status'] == 'draft'){
	                $string .= $this->limitText($get_data['posttitle'], 50)."<a class='txtTag'>&nbsp;&nbsp;{".$this->getCategory($get_data['category'])."}&nbsp;&nbsp;[draft]</a>";
	            }
	            else{
	                $string .= $this->limitText($get_data['posttitle'], 50)."<a class='txtTag'>&nbsp;&nbsp;{".$this->getCategory($get_data['category'])."}</a>";
	            }
	            $string .= "<a href='".$path."EditPost.php?id=".$get_data['id']."' class='pEditLinkButton'>Edit</a>";
                if ($get_data['draft'] == 'yes' && $get_data['status'] != 'draft'){
                    if (file_exists('../view/drafts/posts/postDraft-'.$get_data['id'].'.json')){
                        $string .= "<a href='".$path."EditPost.php?id=".$get_data['id']."&draft=yes' class='pEditLinkButton'>Open Draft</a>";
                    }
                }
                $string .= "<a href='addToCategory.php?page=".$get_data['posttitle']."&id=".$get_data['id']."' class='pEditLinkButton'>Add To Category</a>";
                if ($get_data['status'] == 'hidden'){
                        $string .= "<a class='pDisableLinkButton' href='changePostStatus.php?id=" . $get_data['id'] . "&status=active'>Unhide</a>";
                }
                elseif($get_data['status'] == 'active'){
                    $string .= "<a class='pEnableLinkButton' href='changePostStatus.php?id=" . $get_data['id'] . "&status=hidden'>Hide</a>";
                }
                $string .= "<a href='deletePostConfirmation.php?id=" . $get_data['id'] ."&page=".$get_data['posttitle']."' class='pDeleteLinkButton'>Delete<a>";
	            $string .= "<br>";
	            $string .= "<br>";
			}
        }
        
        return $string;
        $db->close();
    }
    public function fetchCategories(){
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $data = mysqli_query($db,"SELECT * FROM categories");

        while ($get_data = mysqli_fetch_assoc($data)){
            if ($get_data['id'] == 1){
                echo "<p class='pbodyTxt'>".$get_data['category']."</p>";
            }
            else{
                echo "<p class='pbodyTxt'>".$get_data['category']."<a class='pEditLinkButton' href='editCategory.php?id=" .$get_data['id'] ."&category=".$get_data['category']."'>Edit</a><a class='pDeleteLinkButton' href='deleteCategory.php?id=" .$get_data['id'] ."&category=".$get_data['category']."'>Delete</a></p>";
            }
        }
        $db->close();
    }

	


    public function fetchUsers($currentuser){
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $data = mysqli_query($db,"SELECT * FROM users");
        $GetUser = "SELECT * FROM users WHERE username='$currentuser'";
        $data2 = mysqli_query($db,$GetUser);
        $Retrieve = mysqli_fetch_array($data2);
        $UserType = $Retrieve['acctype'];

        while ($get_data = mysqli_fetch_assoc($data)){
            if ($get_data['id'] == 1 && $currentuser == $get_data['username']){
                echo "<p class='pbodyTxt'>User: ".$get_data['username']." <a class='txtTag'>{administrator}</a><a class='pEditLinkButton' href='editUserDetails.php?id=" .$get_data['id'] ."'>Edit Details</a></p>";
            }
            elseif ($get_data['id'] == 1){
                echo "<p class='pbodyTxt'>User: ".$get_data['username']." <a class='txtTag'>{administrator}</a></p>";
            }
            elseif ($currentuser == $get_data['username'] && $this->checkPrivileges($currentuser) == 'administrator'){
                echo "<p class='pbodyTxt'>User: ".$get_data['username']." <a class='txtTag'>{administrator}</a><a class='pEditLinkButton' href='editUserDetails.php?id=" .$get_data['id'] ."'>Edit</a><a class='pDeleteLinkButton' href='deleteUser.php?id=" .$get_data['id'] ."'>Delete</a></p>";
            }
            elseif ($currentuser == strtolower($get_data['username'])){
                echo "<p class='pbodyTxt'>User: ".$get_data['username']."<a class='pEditLinkButton' href='editUserDetails.php?id=" .$get_data['id'] ."'>Edit</a><a class='pDeleteLinkButton' href='deleteUserConfirmation.php?id=" .$get_data['id'] . "&user=".$get_data['username']."'>Delete</a></p>";
            }
            elseif ($get_data['acctype'] == 'administrator'){

                if ($this->checkPrivileges($currentuser) == 'administrator') {
                    echo "<p class='pbodyTxt'>User: ".$get_data['username']." <a class='txtTag'>{administrator}</a>&nbsp;&nbsp;&nbsp;&nbsp;<a class='pDeleteLinkButton' href='deleteUserConfirmation.php?id=" .$get_data['id'] ."&user=".$get_data['username']."'>Delete</a></p>";
                }
                else{
                    echo "<p class='pbodyTxt'>User: ".$get_data['username']." <a class='txtTag'>{administrator}</a></p>";
                }
            }
            elseif ($this->checkPrivileges($currentuser) == 'administrator') {
                echo "<p class='pbodyTxt'>User: ".$get_data['username']."&nbsp;&nbsp;&nbsp;&nbsp;<a class='pDeleteLinkButton' href='deleteUserConfirmation.php?id=" .$get_data['id'] ."&user=".$get_data['username']."'>Delete</a></p>";
            }
            else{
               echo "<p class='pbodyTxt'>User: ".$get_data['username']."</p>"; 
            }
        }

        if ($UserType == 'administrator'){
            echo "<p align='right'>
                <a class='pContentbtn' name='NewUserBtn'>
                	Create New User
                </a>
            </p>";
        }
        $db->close();
    }
	
	
	
	public function setActiveStatus ($id, $string){
		$sqlconnect = new Connectdb;
	    $db = $sqlconnect->connectTo();
	    $SentToDatabase = "UPDATE pages SET status='$string' WHERE id='$id'";
	    $sql = mysqli_query($db, $SentToDatabase);
		$db->close();
	}
    
    public function setActivePostStatus ($id, $string){
		$sqlconnect = new Connectdb;
	    $db = $sqlconnect->connectTo();
	    $SentToDatabase = "UPDATE blog SET status='$string' WHERE id='$id'";
	    $sql = mysqli_query($db, $SentToDatabase);
		$db->close();
	}
	
	public function getPageStatus ($id){
		$sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $data = mysqli_query($db,"SELECT * FROM pages WHERE id='$id'");
        $get_data = mysqli_fetch_assoc($data);
        return $get_data['status'];
        $db->close();
	}
	
	public function isPageHidden ($id){
		if ($this->getPageStatus($id == 'hidden')){
			return true;
		}else{
			return false;
		}
	}
	
	public function fetchPluginsList (){
		$sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
		$data = mysqli_query($db,"SELECT * FROM plugins");
		
		while ($get_data = mysqli_fetch_assoc($data)){
			echo $get_data['pluginName']." <a class='pDeleteLinkButton' href='RemovePlugin.php?id=" .$get_data['id'] ."'>Remove</a>";
		}
	}
	
	public function loadPlugins (){
		$sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
		$data = mysqli_query($db,"SELECT * FROM plugins");

		$count = 0;
		$pluginName = Array();
		
		while ($get_data = mysqli_fetch_assoc($data)){

			if ($get_data['pluginName'] != null){
				$pluginName[$count] = $get_data['pluginName'];
				$count = $count + 1;
			}

			
		}

		for ($i = 0; $i < $count; $i++){
			include_once ("plugins/".$pluginName[$i]."/plugin.php");
		}
	}
	
    
    public function storeToFile ($filename, $content, $type = 'txt'){
        $type = strtolower($type);
        if ($type == 'json'){
            $content = json_encode($content);
        }
        $myfile = fopen('../'.$filename, "w");
        fwrite($myfile, $content);
        fclose($myfile);
    }

	
	
	
	
	
	
	
	//Legacy old code! =======================================================
	// -CAN STILL BE USED BUT NOT RECOMMENDED-
	
	public function displayPageLinks($LinkType, $cssStyle, $cssSubLinkStyle, $stripTags = true){
    	
		$LinkType = strtolower($LinkType);
		
	    $DoOnce = false;
	    $DoOnce2 = false;
	        
	    $sqlconnect = new Connectdb;
	    $db = $sqlconnect->connectTo();
	    $sql = mysqli_query($db, "SELECT * FROM pages ORDER BY pageorder");

        $pageName = '';
	        
	    echo "<ul class='$cssStyle'>";
	
	    while ($get_data = mysqli_fetch_assoc($sql)){

            if ($stripTags == true){
                $pageName = strip_tags($get_data['pagename']);
            }else{
                $pageName = strip_tags($get_data['pagename']);
            }
	
		    if ($get_data['draft'] == 'no' && $get_data['pagetype'] == 'normal' && $get_data['status'] == 'active' && $get_data['status'] == 'active'){
		    	echo "<li><a href='page.php?page=" . $get_data['id'] . "'>".$pageName ."</a></li>";
		    }
            
            if ($get_data['draft'] == 'no' && $get_data['status'] == 'active' && $get_data['pagetype'] == 'homepage' && $get_data['status'] == 'active'){
		    	echo "<li><a href='index.php'>".$pageName ."</a></li>";
		    }
	
            elseif ($get_data['pagetype'] == 'blog' && $get_data['status'] == 'active' && $DoOnce == false){
                echo "<li><a href='blog.php'>".$pageName."</a></li>";
				if ($LinkType == "blog"){
					echo $this->blogCategoryLinks($cssSubLinkStyle);
				}
                $DoOnce=true;
            }

            elseif ($get_data['pagetype'] == 'contact' && $get_data['status'] == 'active' && $DoOnce2 == false){
                echo "<li><a href='contact.php'>".$pageName."</a></li>";   
                $DoOnce2=true;
            }

            elseif ($get_data['pagetype'] == 'relink' && $get_data['status'] == 'active'){
                echo "<li><a href='".$get_data['additional']."'>".$pageName ."</a></li>";   
            }
        }
        
        echo "</ul>";
        $db->close();
    }
	
	public function displayBlogPostList($cssStyle, $LinkTxt, $MaxChar, $PostCount, $UseImg){
		$sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        //$query = "SELECT * FROM blog ORDER BY id DESC LIMIT $PostCount";
		$query = "SELECT * FROM blog ORDER BY id DESC LIMIT $PostCount";
        $data = mysqli_query($db,$query);
		
		echo "<ul class='$cssStyle'>";
		
		while ($get_data = mysqli_fetch_assoc($data)){
			
			if ($get_data['draft'] == 'no'){
				$StripTags = strip_tags($get_data['postcontent']);	
				$LimitBody = substr($StripTags, 0, $MaxChar);
				
				$imgFile = $get_data['image'];
				$postTitle = $get_data['posttitle'];
				
				echo "<li>";
				
				if ($UseImg == TRUE && $imgFile != null){
					echo "<image src='image/$imgFile'>";
				}
				echo "<h1>$postTitle</h1>";
				echo "<span>$LimitBody...</span><br>";
				echo "<a href='blogPost.php?postID=".$get_data['id']."'>$LinkTxt</a>";
				echo "</li>";
			}
			
		}
		
		echo "</ul>";
		$db->close();
		
	}
	
    public function displayNewestBlogPost($cssStyle, $cssNavStyle, $cssHeadStyle){
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $data = mysqli_query($db,"SELECT * FROM blog ORDER BY id DESC");

        while ($get_data = mysqli_fetch_assoc($data)){

            if ($get_data['draft'] == 'no'){
                $viewcount = $get_data['views'] + 1;
                $UpdatePageViews = "UPDATE blog SET views=".$viewcount." WHERE id='".$get_data['id']."'";
                mysqli_query($db,$UpdatePageViews);
				
                echo "<ul class='$cssStyle'><li>";
                for ($i = $get_data['id'] - 1; $i > 0; $i--){
					if ($this->checkPostIDExistsNoDrafts($i) == TRUE){
						echo "<table width='100%'><tr>";
						echo "<td width='50%'></td>";
						echo "<td width='50%' align='right'><a class='$cssNavStyle' href='blogPost.php?postID=".$i."'>Older Post</a></td>";
						echo "</tr></table><br>";
						break;
					}
                }
				$this->blogPostHeader($cssHeadStyle, $get_data['posttitle'], $get_data['user'], $this->getCategory($get_data['category']), $get_data['date'], $viewcount);

                echo "<span>".$get_data['postcontent']."</span>";
				
                for ($i = $get_data['id'] - 1; $i > 0; $i--){
					if ($this->checkPostIDExistsNoDrafts($i) == TRUE){
						echo "<table width='100%'><tr>";
						echo "<td width='50%'></td>";
						echo "<td width='50%' align='right'><a class='$cssNavStyle' href='blogPost.php?postID=".$i."'>Older Post</a></td>";
						echo "</tr></table>";
						break;
					}
                }
                echo "</li></ul>";
                break;
            }
        }
        $db->close();
    }

    public function displayBlogCategoryPosts($category, $cssStyle = null){
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $data = mysqli_query($db,"SELECT * FROM blog ORDER BY id DESC");
        while ($get_data = mysqli_fetch_assoc($data)){
              if ($get_data['category'] == $category){      
                if ($get_data['draft'] == 'no'){
                	echo "<ul class='$cssStyle'>";
						echo "<li><a href='blogPost.php?postID=".$get_data['id']."'>".$get_data['posttitle']."</a></li>";
						echo "<li>By: ".$get_data['user']."</li>";
						echo "<li>Posted on: ".$get_data['date']."</li>";
						echo "<li>Views: ".$get_data['views']."</li>";
						echo "<li>".$this->removeHashTags($this->limitText($get_data['postcontent'],150))."...</li>";
					echo "</ul>";
                }
            }
        }
        $db->close();
    }
	
    public function displayPost($id, $cssStyle, $cssHeadStyle){
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $query = "SELECT * FROM blog WHERE id=$id";
        $data = mysqli_query($db,$query);
        $get_data = mysqli_fetch_assoc($data);

        if ($get_data['draft'] == 'no'){
            $viewcount = $get_data['views'] + 1;
            $UpdatePageViews = "UPDATE blog SET views=".$viewcount." WHERE id='".$get_data['id']."'";
            mysqli_query($db,$UpdatePageViews);
			
			echo"<ul class='$cssStyle'><li>";
			
            $this->blogPostHeader($cssHeadStyle, $get_data['posttitle'], $get_data['user'], $this->getCategory($get_data['category']), $get_data['date'], $viewcount);
			
            echo "<span>".$get_data['postcontent']."</span>";
			echo "</li></ul>";
        }
        $db->close();
    }
	
	public function displayMultiPost($StartID, $NumOfPosts, $cssStyle, $cssHeadStyle, $cssNewerBtnStyle, $cssOlderBtnStyle){
        
		$Analytics = new PageAnalytics;
		
		$Count = 1;
		$ID = 0;
		
		if ($StartID == null || $StartID == ''){
			$ID = $this->getLastPostID();
		}else{
			$ID = $StartID;
		}
		
		
		while ($Count <= $NumOfPosts){
			
			if ($this->checkPostIDExistsNoDrafts($ID) == TRUE){
				echo $this->displayPost($ID, $cssStyle, $cssHeadStyle);
				$Count = $Count + 1;
				$ID = $ID - 1;
			}else{
				break;
			}
		}
		
		echo "<a href='blog.php?type=older?id=".$ID."' class='".$cssOlderBtnStyle."'>Older Posts</a>";
		
		if ($StartID != null || $StartID != ''){
			echo "<a href='blog.php?type=newer?id=".$ID."' class='".$cssNewerBtnStyle."'>Newer Posts</a>";
		}

    }

    public function postFooterLinks ($id, $cssStyle){
    	$sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
		$data = mysqli_query($db,"SELECT * FROM blog ORDER BY id DESC LIMIT 1");
    	$get_data = mysqli_fetch_assoc($data);
	    $MaxID = $get_data['id'];

        echo "<table width='100%'><tr>";
		
		//Newer Post
		for ($ni = $id + 1; $ni <= $MaxID; $ni++){
			if ($this->checkPostIDExistsNoDrafts($ni) == TRUE){
				echo "<td width='50%'><a class='".$cssStyle."' href='blogPost.php?postID=".$ni."'>Newer Post</a></td>";
				break;
			}
        }
		
		//Older Post
		for ($oi = $id - 1; $oi > 0; $oi--){
			if ($this->checkPostIDExistsNoDrafts($oi) == TRUE){
				echo "<td width='50%' align='right'><a class='".$cssStyle."' href='blogPost.php?postID=".$oi."'>Older Post</a></td>";
				break;
			}
        }

        echo "</tr></table>";
		$db->close();
    }

	public function blogPostHeader($cssStyle, $postTitle, $postUser, $postCategory, $postDate, $postViews){
		echo "<ul class='$cssStyle'>";
			echo "<li><a>$postTitle</a></li>";
			echo "<li>By: $postUser</li>";
			echo "<li>Category: $postCategory</li>";
			echo "<li>Posted on: ".$this->formatDate(substr($postDate, 0, -9))."</li>";
			echo "<li>Views: $postViews</li>";
		echo "</ul>";
	}
	
	public function editableBlogPostHeaderTitle ($cssStyle, $postTitle, $postUser, $postCategory, $postDate, $postViews){
		echo "<ul id='$cssStyle'>";
			echo "<li><input type='text' name='postname' value='$postTitle' size='50'></li>";
			echo "<li>By: $postUser</li>";
			echo "<li>Category: $postCategory</li>";
			echo "<li>Posted on: $postDate</li>";
			echo "<li>Views: $postViews</li>";
		echo "</ul>";
	}

	public function previewPageLinks($LinkType, $cssStyle, $cssSubLinkStyle, $stripTags = true){
    	
		$LinkType = strtolower($LinkType);
		
	    $DoOnce = false;
	    $DoOnce2 = false;
	        
	    $sqlconnect = new Connectdb;
	    $db = $sqlconnect->connectTo();
	    $sql = mysqli_query($db, "SELECT * FROM pages ORDER BY pageorder");

        $pageName = '';
	        
	    echo "<ul class='$cssStyle'>";
	
	    while ($get_data = mysqli_fetch_assoc($sql)){

            if ($stripTags == true){
                $pageName = strip_tags($get_data['pagename']);
            }else{
                $pageName = $get_data['pagename'];
            }
	
		    if ($get_data['draft'] == 'no' && $get_data['pagetype'] == 'normal' || $get_data['pagetype'] == 'homepage'){
		    	echo "<li><a href='#'>".$pageName."</a></li>";
		    }
	
            elseif ($get_data['pagetype'] == 'blog' && $get_data['status'] == 'active' && $DoOnce == false){
                echo "<li><a href='#'>".$pageName."</a></li>";
				if ($LinkType == "blog"){
					echo $this->blogCategoryLinks($cssSubLinkStyle);
				}
                $DoOnce=true;
            }

            elseif ($get_data['pagetype'] == 'contact' && $get_data['status'] == 'active' && $DoOnce2 == false){
                echo "<li><a href='#'>".$pageName."</a></li>";   
                $DoOnce2=true;
            }

            elseif ($get_data['pagetype'] == 'relink' && $get_data['status'] == 'active'){
                echo "<li><a href='#'>".$pageName."</a></li>";   
            }
        }
        
        echo "</ul>";
        $db->close();
    }

	public function previewBlogCategoryLinks ($cssStyle){
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $data = mysqli_query($db,"SELECT * FROM categories");

        while ($get_data = mysqli_fetch_assoc($data)){
            if ($this->numOfCategoryPosts($get_data['id']) != 0){
            echo "<li class='$cssStyle'><a href='#'>".$get_data['category']."&nbsp;&nbsp;("
            .$this->numOfCategoryPosts($get_data['id']).")</a></li>";
            }
        }
        $db->close();
    }

    public function blogCategoryImageLinks ($cssStyle, $ShowTotalNum){
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $data = mysqli_query($db,"SELECT * FROM categories");

        while ($get_data = mysqli_fetch_assoc($data)){
            if ($this->numOfCategoryPosts($get_data['id']) != 0){
            echo "<li class='$cssStyle'>
            
            <a href='blogCategory.php?id="
            . $get_data['id'] . "'>";
			
			if ($get_data['icon'] != null || $get_data['icon'] != ''){
				echo "<image src='view/image/".$get_data['icon']."'>";
			}
			
			echo $get_data['category'];
            
	            if ($ShowTotalNum == TRUE){
	            	echo "&nbsp;&nbsp;(".$this->numOfCategoryPosts($get_data['id']).")";
				}
				
            echo "</a></li>";
            }
        }
        $db->close();
    }

    public function blogCategoryLinks ($cssStyle,$showPostCount = true){
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $data = mysqli_query($db,"SELECT * FROM categories");

        while ($get_data = mysqli_fetch_assoc($data)){
            if ($this->numOfCategoryPosts($get_data['id']) != 0){
            	if ($showPostCount == true){
            		echo "<li class='$cssStyle'><a href='blogCategory.php?id="
            			. $get_data['id'] . "'>".$get_data['category']."&nbsp;&nbsp;("
            			.$this->numOfCategoryPosts($get_data['id']).")</a></li>";
            	}
            	else{
            		echo "<li class='$cssStyle'><a href='blogCategory.php?id="
            		. $get_data['id'] . "'>".$get_data['category']."</a></li>";
            	}
            }
        }
        $db->close();
    }






}


?>