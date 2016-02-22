<?php
/**
 * @license Copyright (c) 2014 - 2016, Peacock CMS by Clyde Smets <clyde@peacockcms.com>
 * Peacock CMS is under the GNU - General Public License V3.
 */



class Peacock {


    public function __construct (){

    }


	public function peacockVersion(){
        return "Version 1.1.0";
    }




    /*  ===== Get Functions Start ========  */
  public function getBlogPosts($limit = 0,$removeDrafts = true){
    $DB = new DatabaseConnection;
    if ($removeDrafts == true){
      $query = "SELECT * FROM blog WHERE draft='no' ORDER BY id DESC";
    }else{
      $query = "SELECT * FROM blog ORDER BY id DESC";
    }

    if ($limit !== 0){
      $posts = $DB->fetch($query,$limit);
    }else{
      $posts = $DB->fetch($query);
    }

    return $posts;
  }

	public function getPostContent ($id, $incDraft = false, $showTags = false){
    $query = "SELECT * FROM blog WHERE id='$id'";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query,1);
    $draft = $get_data['draft'];
    $useDraftFile = $_GET['draft'];
    if ($incDraft == true && $draft == 'yes' && $useDraftFile == 'yes'){
        if (file_exists('view/drafts/posts/postDraft-'.$id.'.json')){
            $file = file_get_contents('view/drafts/posts/postDraft-'.$id.'.json');
            $json = json_decode($file, true);
            return $json['body'];
        }
    }else{
        $string = stripslashes($get_data['postcontent']);

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
	}

	public function getPostDate ($id, $incDraft = false){
    $query = "SELECT * FROM blog WHERE id='$id'";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query,1);

		if ($incDraft == TRUE){
			return $get_data['date'];
		}
		if ($incDraft == FALSE){
			if ($get_data['draft'] == 'no'){
				return $get_data['date'];
			}
		}
	}

	public function getPostAuthor ($id, $incDraft = false){
    $query = "SELECT * FROM blog WHERE id='$id'";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query,1);

		if ($incDraft == TRUE){
			return $get_data['user'];
		}
		if ($incDraft == FALSE){
			if ($get_data['draft'] == 'no'){
				return $get_data['user'];
			}
		}
	}

	public function getPostAuthorName ($username){
    $query = "SELECT * FROM users WHERE username='$username'";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query,1);
		$fullname = $get_data['firstname'] . ' ' . $get_data['lastname'];
		return $fullname;
	}

	public function getPostCategory ($id, $incDraft = false){
    $query = "SELECT * FROM blog WHERE id='$id'";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query,1);

		if ($incDraft == TRUE){
			return $this->getCategory($get_data['category']);
		}
		if ($incDraft == FALSE){
			if ($get_data['draft'] == 'no'){
				return $this->getCategory($get_data['category']);
			}
		}
	}

	public function getPostViews ($id, $incDraft = false){
    $query = "SELECT * FROM blog WHERE id='$id'";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query,1);

		if ($incDraft == TRUE){
			return $get_data['views'];
		}
		if ($incDraft == FALSE){
			if ($get_data['draft'] == 'no'){
				return $get_data['views'];
			}
		}
	}


	public function getPostImage($id){
    $query = "SELECT * FROM blog WHERE id='$id'";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query,1);
		return $get_data['image'];
	}

	public function getCategoryIcon ($id){
    $query = "SELECT * FROM categories WHERE id='$id'";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query,1);
		return $get_data['icon'];
	}

	public function getUserAvatar ($username){
    $query = "SELECT * FROM users WHERE username='$username'";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query,1);
		return $get_data['profileimg'];
	}

  public function getUserFirstName($username){
    $query = "SELECT * FROM users WHERE username='$username'";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query,1);
		return $get_data['firstname'];
  }

  public function getCategory ($id){	//Returns Category Name
    $query = "SELECT * FROM categories WHERE id='$id'";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query,1);
    return $get_data['category'];
  }
  public function getPostName ($id, $removeTags = false){
    $query = "SELECT * FROM blog WHERE id='$id'";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query,1);
    $postName = '';
    if ($removeTags == true){
    	$postName = strip_tags($get_data['posttitle']);
    }else{
    	$postName = $get_data['posttitle'];
    }
    return stripslashes($postName);
  }
  public function getPageName ($id, $removeTags = false){
    $query = "SELECT * FROM pages WHERE id='$id'";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query,1);
    $pageName = '';
    if ($removeTags == true){
    	$pageName = strip_tags($get_data['pagename']);
    }else{
    	$pageName = $get_data['pagename'];
    }
    return stripslashes($pageName);
  }

	public function getPageContent ($id){
    $useDraftFile = $_GET['draft'];
    $query = "SELECT * FROM pages WHERE id='$id'";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query,1);
    $draft = $get_data['draft'];

    if ($draft == 'yes' && $useDraftFile == 'yes'){
        if (file_exists("/peacock/drafts/pages/pageDraft-".$id.".json")){
            $file = file_get_contents("/peacock/drafts/pages/pageDraft-".$id.".json");
            $json = json_decode($file, true);
            return $json['body'];
        }else{
            echo 'NO DRAFT FILE FOUND!';
        }
    }else{
        return stripslashes($get_data['bodycontent']);
    }
  }

	public function getPageImage ($id){
    $query = "SELECT * FROM pages WHERE id='$id'";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query,1);
    return $get_data['image'];
  }

  public function getPageAdditional($id){
    $query = "SELECT * FROM pages WHERE id='$id'";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query,1);
    return $get_data['additional'];
  }

  public function getPageAdditional2($id){
    $query = "SELECT * FROM pages WHERE id='$id'";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query,1);
    return $get_data['additional2'];
  }

  public function getPageAdditional3($id){
    $query = "SELECT * FROM pages WHERE id='$id'";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query,1);
    return $get_data['additional3'];
  }

  public function getSiteName (){
    $query = "SELECT * FROM site WHERE id='1'";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query,1);
    return $get_data['sitename'];
  }
	public function getSiteTheme (){
    $query = "SELECT * FROM site WHERE id='1'";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query,1);
    return $get_data['theme'];
  }
  public function getSiteImage ($showAnyways = false){
    $query = "SELECT * FROM site WHERE id='1'";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query,1);
    if ($get_data['useimage'] == 'yes' || $showAnyways == true){
        return $get_data['image'];
    }
    else{
        return null;
    }
  }
  public function getImageName ($id){
    $query = "SELECT * FROM images WHERE id='$id'";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query,1);
    if ($get_data['imagename'] == null){
        return $get_data['image'];
    }
    else{
        return $get_data['imagename'];
    }
  }
  public function getImageFolders(){
    $query = "SELECT * FROM imageFolders ORDER BY folderOrder";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query);
    $result = array();
    foreach($get_data as $data){
        $result[] = $data['folderName'];
    }
    return $result;
  }
  public function getImages($folder = null){
    $query = "SELECT * FROM images ORDER BY imageOrder";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query);
    $result = array();
    foreach($get_data as $data){
      if ($folder == null){
          $result[] = $data['id'];
      }else{
          if ($data['imageFolder'] == $folder){
              $result[] = $data['id'];
          }
      }
    }
    return $result;
  }
	public function getImageFilename ($id){
    $query = "SELECT * FROM images WHERE id='$id'";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query,1);
    return $get_data['image'];
  }
  public function getSiteTags (){
    $query = "SELECT * FROM site WHERE id='1'";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query,1);
    return $get_data['tags'];
  }
  public function getSiteDescription (){
    $query = "SELECT * FROM site WHERE id='1'";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query,1);
    return $get_data['description'];
  }
	public function getLastPostID (){
    $query = "SELECT * FROM blog ORDER BY id DESC";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query,1);
    return $get_data['id'];
	}
  public function getFirstPostID (){
    $query = "SELECT * FROM blog";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query,1);
    return $get_data['id'];
	}
  public function getLastPageID (){
    $query = "SELECT * FROM pages ORDER BY pageorder";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query,1);
    return $get_data['id'];
  }

	public function getPageData ($id, $ColumnName){
    $query = "SELECT * FROM pages WHERE id='$id'";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query,1);
		$sqlconnect = new Connectdb;
		return $get_data[$ColumnName];
	}

  public function getBlogData ($id, $ColumnName){
    $query = "SELECT * FROM blog WHERE id='$id'";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query,1);
    return $get_data[$ColumnName];
  }

	public function getTableData ($id, $table, $columnName){
    $query = "SELECT * FROM ".$table." WHERE id='".$id."'";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query,1);
    return $get_data[$ColumnName];
  }

	public function getPageID ($pageName){
    $query = "SELECT * FROM pages WHERE pagename='$pageName'";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query,1);
    if ($get_data){
    	return $get_data['id'];
    }else{
    	echo "Page Doesn't Exist";
    }
	}

  public function getGroupName ($id){
    $query = "SELECT * FROM pages WHERE id='$id'";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query,1);
    if ($get_data){
        if ($get_data['pagetype'] == 'group'){
            return $get_data['pagename'];
        }
        else{
            echo "ID is not a Group Type";
        }
    }else{
    	echo "Group Doesn't Exist";
    }
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
                        $insertPageLink = str_replace("pageLink", strip_tags($pageLink), $format);

                        $insertPageName = str_replace("pageName", $pageName, $insertPageLink);

                        echo $insertPageName;
                    }
                }
                if($get_data['pagetype'] == 'group' && $showGroupPages == true && $get_data['groupID'] == 0 && $get_data['status'] == 'active'){
                    $pageLink = '';
                    $pageName = $this->siteLinkTags($get_data['pagename'], $stripTags);

                    if ($get_data['additional'] != null){
                         $insertPageLink = str_replace("pageLink", $get_data['additional'], $format);
                    }else{
                         $insertPageLink = str_replace("pageLink", "#", $format);
                    }

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
                            if ($get_page['pagetype'] == "group"){
                                $subGrpID = $get_page['id'];
                                echo "<ul>";
                                while($get_subGroupPages = mysqli_fetch_assoc($querydropdown)){
                                    if ($get_subGroupPages['groupID'] == $subGrpID){
                                        echo "<li><a href='/".$this->returnPageLink($get_subGroupPages['pagetype'], $get_subGroupPages['id'])."'>".$get_subGroupPages['pagename']."</a></li>";

                                    }
                                }
                                echo "</ul>";
                            }
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
                            echo "<a href='/".$this->returnPageLink($get_pagelinks['pagetype'], $get_pagelinks['id'])."'>".$get_pagelinks['pagename']."</a>";
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
              $pageLink = "/index";
          }else{
              $pageName = $this->getPageName($id);
              $pageLink = "/page/" . $id . "/" . $pageName;
          }
      }

      elseif ($type == 'blog'){
          $pageLink = "/blog";
      }

      elseif ($type == 'contact'){
          $pageLink = "/contact";
      }

      elseif ($type == 'relink'){
          $pageLink = $this->getPageLink($id);
      }
      return $pageLink;
  }

  public function getSiteLinksArray(){

    $query = "SELECT * FROM pages ORDER BY pageorder";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query,1);

    $array = array();
    $appendArray = array();

    foreach ($get_data as $data){
      $appendArray = array(
          $data['id'],
          $data['isGrouped'],
          $data['groupID'],
          $data['pagetype']
      );
      $array[] = $appendArray;
    }
    return $array;
  }

    public function getPageLink($id){
      $query = "SELECT * FROM pages WHERE id='$id'";
      $dbq = new DatabaseConnection();
      $get_data = $dbq->fetch($query,1);
      return $get_data['additional'];
    }

    public function getTotalBlogEntries($countDraft = true){
      $query = "SELECT * FROM blog";
      $dbq = new DatabaseConnection();
      $get_data = $dbq->fetch($query,1);
      $count = 0;
      foreach ($get_data as $data){
          if ($countDraft == true){
              if ($data['posttitle'] != null){
                  $count++;
              }
          }
          elseif ($countDraft == false){
              if ($data['posttitle'] != null && $data['draft'] == 'no'){
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
      $query = "SELECT * FROM blog";
      $dbq = new DatabaseConnection();
      $get_data = $dbq->fetch($query);
      $count = 0;
      foreach($get_data as $data){
          if ($data['status'] == 'active'){
              $count++;
          }
      }
      return $count;
    }

    public function getFolderId($folderName){
      $query = "SELECT * FROM imageFolders WHERE folderName='$folderName'";
      $dbq = new DatabaseConnection();
      $get_data = $dbq->fetch($query,1);
      if ($get_data['id'] != null){
          return $get_data['id'];
      }
    }

    public function getFolderName($id){
      $query = "SELECT * FROM imageFolders WHERE id='$id'";
      $dbq = new DatabaseConnection();
      $get_data = $dbq->fetch($query,1);
      if ($get_data['folderName'] != null){
          return $get_data['folderName'];
      }
    }

    public function getFileContents($file){
      $content = "";
        if (file_exists($file)){
            $content = file_get_contents($file);
        }else{
            die("FILE DOES NOT EXIST");
        }
        return $content;
    }

    public function getAllPostsByMonthAndYear ($year, $month){
      $query = "SELECT * FROM blog";
      $dbq = new DatabaseConnection();
      $get_data = $dbq->fetch($query);
      $posts = array();
      foreach($get_data as $data){
          $postYear = substr($data['date'], 0, 4);
          $postMonth = substr($data['date'], 5, 2);
          if ($postYear == $year && $postMonth == $month){
              $posts[] = array($data['id'],$data['posttitle'],$data['postcontent']);
          }
      }
      return $posts;
    }

    public function getImageListArray($folder = null){
      $query = "SELECT * FROM images ORDER by imageOrder";
      $dbq = new DatabaseConnection();
      $get_data = $dbq->fetch($query);

      $imageArray = array();

      foreach($get_data as $data){
          $imageName = $data['imagename'];
          $imageFile = $data['image'];
          if ($imageName == null){
              $imageName = $imageFile;
          }
          if ($folder != null){
              $imageFolder = $data['imageFolder'];
              if ($imageFolder == $folder){
                  $imageArray[$imageName][0] = $imageName;
                  $imageArray[$imageName][1] = $imageFile;
              }
          } else {
              $imageArray[$imageName][0] = $imageName;
              $imageArray[$imageName][1] = $imageName;
          }
      }

      return $imageArray;
    }

	/*  ===== Get Functions End ========  */







	/*  ===== Check Functions Start ========  */

	public function checkPostIDExists ($id){
    $query = "SELECT * FROM blog WHERE id='$id'";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query,1);
		if ($get_data['id'] != null){
			return TRUE;
		}
		else {
			return FALSE;
		}
	}

	public function checkPostIDExistsNoDrafts ($id){
    $query = "SELECT * FROM blog WHERE id='$id'";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query,1);
		if ($get_data['id'] != null && $get_data['draft'] == 'no'){
			return TRUE;
		}
		else {
			return FALSE;
		}
	}

  public function checkPostIDisActive ($id){
    $query = "SELECT * FROM blog WHERE id='$id'";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query,1);
		if ($get_data['id'] != null && $get_data['status'] == 'active'){
			return TRUE;
		}
		else {
			return FALSE;
		}
	}

  public function checkPageIDExists ($id){
    $query = "SELECT * FROM pages WHERE id='$id'";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query,1);
		if ($get_data['id'] != null){
			return TRUE;
		}
		else {
			return FALSE;
		}
  }

	public function checkImageFolderExist($folder){
    $query = "SELECT * FROM imageFolders WHERE folderName='$folder'";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query,1);
		if ($get_data['folderName'] != null){
			return TRUE;
		}
		else {
			return FALSE;
		}
	}

  public function checkUser ($user){
      if ($user != null){
        $query = "SELECT * FROM users WHERE username='$user'";
        $dbq = new DatabaseConnection();
        $get_data = $dbq->fetch($query,1);
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
    $query = "SELECT * FROM users WHERE username='$user'";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query,1);
    $EditorType = $get_data['acctype'];
    return $EditorType;
  }

  public function checkPluginExist($plugin){
    $query = "SELECT * FROM plugins WHERE pluginName='$plugin'";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query,1);
    if ($get_data['pluginName'] != null){
      return true;
    }else{
      return false;
    }
  }

  public function checkSiteImageStatus(){
    $query = "SELECT * FROM site";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query,1);
    if ($get_data['useimage'] != null){
        return $get_data['useimage'];
    }else{
        return null;
    }
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


	/*  ===== Display Functions Start ========  */

  public function displayPostImage($id){
    $query = "SELECT * FROM blog WHERE id='$id'";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query,1);
		echo "<image src='image/".$get_data['image']."'>";
  }


  public function displayTotalPageViews(){
    $query = "SELECT * FROM pages";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query,1);
    $views = 0;
    foreach ($get_data as $data){
      if ($data['views'] > 0){
          $views = $views + $data['views'];
      }
    }
    return $views;
  }


  public function displayTotalBlogViews(){
    $query = "SELECT * FROM blog";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query,1);
    $views = 0;
    foreach ($get_data as $data){
        if ($data['views'] > 0){
            $views = $views + $data['views'];
        }
    }
    return $views;
  }

  public function displayTotalSiteViews(){
      $views = $this->displayTotalPageViews() + $this->displayTotalBlogViews();
      return $views;
  }

  public function displayPopularBlog(){
    $query = "SELECT * FROM blog ORDER BY views DESC LIMIT 3";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query,1);
    $rank = 1;
    foreach ($get_data as $data){
        echo "<p class='pWhiteBasicTxt'>$rank. ".$this->limitText($data['posttitle'], 40)."&nbsp;&nbsp;<span class='pHightlightTxt'>views: ".$data['views']."</span></p>";
        $rank = $rank + 1;
    }
  }

  public function displayPopularPages(){
    $query = "SELECT * FROM pages ORDER BY views DESC LIMIT 3";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query,1);
    $rank = 1;
    foreach ($get_data as $data){
  		echo "<p class='pWhiteBasicTxt'>$rank. ".$this->limitText($data['pagename'], 40)."&nbsp;&nbsp;<span class='pHightlightTxt'>views: ".$data['views']."</span></p>";
    	$rank = $rank + 1;
    }
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
    $query = "SELECT * FROM blog";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query);
    foreach($get_data as $data){
      $get_year = substr($data['date'],0,4);
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
    $query = "SELECT * FROM blog";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query);
    foreach($get_data as $data){
      $postYear = substr($data['date'],0,4);
      $this->_displayPostMonths($postYear, $year);
    }
  }

  private $_storeUsedMonths = array();

  private function _displayPostMonths($postYear, $year){
    if ($postYear == $year){
        $postMonth =  substr($data['date'],5,2);
        $isUsed = false;
        foreach($this->_storeUsedMonths as $month){
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
            $this->_storeUsedMonths[] = $postMonth;
        }
    }
  }

  private function countMonthlyPosts($year, $month){
    $query = "SELECT * FROM blog";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query,1);
    $count = 0;
    if ($dbq->is_multidim_array() == true){
      foreach ($get_data as $data){
          $getMonth = substr($data['date'],5,2);
          $getYear = substr($data['date'],0,4);
          if ($year == $getYear && $month == $getMonth){
              $count++;
          }
      }
    }else{
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






    //Other public functions

    public function isPageSourceEditingAllow(){
      $query = "SELECT * FROM site WHERE id='1'";
      $dbq = new DatabaseConnection();
      $get_data = $dbq->fetch($query,1);
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
      $dbq = new DatabaseConnection();
      $get_data = $dbq->fetch($query);
      $count = 0;
      foreach($get_data as $row){
        if ($row['category'] && $row['status'] == 'active'){
            $count = $count + 1;
        }
      }
      return $count;
    }

    public function blogExist (){
      $query = "SELECT * FROM blog";
      $dbq = new DatabaseConnection();
      $get_data = $dbq->fetch($query,1);
      if($dbq->is_multidim_array() == true){
        foreach ($get_data as $data){
          if ($data['id'] == NULL){
            return FALSE;
            break;
          }else{
            return TRUE;
            break;
          }
        }
      }else{
        if ($get_data['id'] == NULL){
          return FALSE;
          break;
        }else{
          return TRUE;
          break;
        }
      }
    }

    public function removePageMargins(){
        echo "<style type='text/css'>";
        echo "html, body, #page {height: 100%;width: 100%;margin-top: 0px;margin-bottom: 0px;margin-left:0px;padding: 0;}";
        echo "#header{margin: 0;padding: 0;height : 20px;background-color : green;}";
        echo "</style>";
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
		$query = "SELECT * FROM blog ORDER BY id DESC LIMIT $PostCount";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query,1);

		$html = '';

		$html .= "<ul>";

		$count = 1;

		foreach ($get_data as $data){

			if ($count <= $PostCount){
				if ($get_data['draft'] == 'no'){
					$StripTags = strip_tags($data['postcontent']);
					$LimitBody = substr($StripTags, 0, $MaxChar);

					$imgFile = $data['image'];
					$postTitle = $data['posttitle'];

					$html .= "<a href='blogPost.php?postID=".$data['id']."'>";
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


//************************************************************************
//************************************************************************

//Peacock Control Panel Code =============================================

//************************************************************************
//************************************************************************

    /*  ===== Fetch Functions Start ========  */

  public function fetchImageFolders(){
    $query = "SELECT * FROM imageFolders ORDER BY folderOrder";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query);
    $array = array();
		foreach ($get_data as $data){
      $array[] = $data['folderName'];
		}
    return $array;
	}

	public function fetchImageList($folder){
    $query = "SELECT * FROM images ORDER BY imageOrder";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query);
		$count = 0;
		foreach ($get_data as $data){

			if ($data['imageFolder'] == $folder){
				echo "<a href='/view/image/".$data['image']."' data-lightbox='$folder' data-title='";
				if ($data['imagename'] != null){
					echo $data['imagename']."'>
					<ul><li><img src='/view/image/"
					.$data['image']."'></li><li><p>"
					.$data['imagename']."</p>";

				}else{
					echo $data['image']."'><ul><li><img src='/view/image/"
					.$data['image']."'></li><li><p>"
					.$data['image']."</p>";
				}
				echo "<a href='RenameImage.php?file="
				.$data['image']."&id="
				.$data['id']."&folder="
				.$data['imageFolder']
				."'><span class='pEditLinkButton'>Rename</span></a></li></ul></a>";
				$count++;
			}

		}

		if ($count < 1){
			echo "<h2>EMPTY FOLDER</h2>";
		}
	}

	public function fetchImageSortList($folder, $path = null){
    $query = "SELECT * FROM images ORDER BY imageOrder";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query);
		$count = 0;
		foreach ($get_data as $data){

			if ($data['imageFolder'] == $folder){
				echo "<li id='item_".$data['id']."'><img src='".$path."image/".$data['image']."' width='50px'><br>".$data['image']."</li>";
				$count++;
			}

		}

		if ($count < 1){
			echo "<h2>EMPTY FOLDER</h2>";
		}
	}

	public function fetchImageFolderNames(){
    $query = "SELECT * FROM imageFolders ORDER BY folderOrder";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query);
		foreach ($get_data as $data){
			echo "<li id='item_".$data['id']."'>".$data['folderName']."</li>";
		}
	}


    public function fetchListOfTemplates($type){
        $html = '';
        $query = "SELECT * FROM templates ORDER BY templateOrder";
        $dbq = new DatabaseConnection();
        $get_data = $dbq->fetch($query);
    		foreach ($get_data as $data){
            $html .= '
            <a href="/CreatePage/'.$type.'/'.$data['id'].'">
                <ul>
                    <li><img src="Images/templateIcon.png" style="width:60px"></li>
                    <li><h1>'.$data['templateName'].'</h1>
                    <a href="/CreatePage/'.$type.'/'.$data['id'].'/yes">
                      <i class="fa fa-pencil-square-o"></i>
                    </a>
                    <a class="delete" href="deleteTemplate.php?template='.$data['id'].'">
                      <i class="fa fa-trash-o"></i>
                    </a>
                    </li>
                </ul>
            </a>';
        }
        print $html;
    }

    public function getTemplateContent(){
        @$template = $_GET['template'];
        if ($template != 'blankPage' || $template != 'NewTemplate'){
          $query = "SELECT * FROM templates WHERE id='$template'";
          $dbq = new DatabaseConnection();
          $get_data = $dbq->fetch($query,1);
          if ($get_data != null){
              echo stripslashes($get_data['templateContent']);
          }
        }
    }

    public function getTemplateName($id){
      $query = "SELECT * FROM templates WHERE id='$id'";
      $dbq = new DatabaseConnection();
      $get_data = $dbq->fetch($query,1);
      return $get_data['templateName'];
    }


    public function fetchImagesArray($limit = 0,$arrangeOrder = 'imageOrder'){
      if ($arrangeOrder == 'imageOrder'){
        $query = "SELECT * FROM images ORDER BY imageOrder";
      }elseif($arrangeOrder == 'newest'){
        $query = "SELECT * FROM images ORDER BY id DESC";
      }else{
        $query = "SELECT * FROM images";
      }
      $dbq = new DatabaseConnection();
      $get_data = $dbq->fetch($query);
      $array = array();
      $index = 0;
      foreach ($get_data as $data){
        if ($limit != 0 && $index < $limit){
          if ($data['image']){
            $array[$index]['id'] = $data['id'];
            $array[$index]['image'] = $data['image'];
            $array[$index]['name'] = $data['imagename'];
            $array[$index]['folder'] = $data['imageFolder'];
          }
        }
        if ($limit == 0){
          if ($data['image']){
            $array[$index]['id'] = $data['id'];
            $array[$index]['image'] = $data['image'];
            $array[$index]['name'] = $data['imagename'];
            $array[$index]['folder'] = $data['imageFolder'];
          }
        }
        $index++;
      }
      return $array;
    }

    public function fetchImagesLimited($path = null){
      $query = "SELECT * FROM images ORDER BY id DESC LIMIT 5";
      $dbq = new DatabaseConnection();
      $get_data = $dbq->fetch($query);

        echo "<p class='ph3'>Upload Images to use on your Page or Post.</p>";
        echo "<table width='100%'>";

        foreach ($get_data  as $data){
            if ($data['image']){
                echo "<tr>";
                echo "<td width='60px'><img src='".$path."image/".$data['image']."' width='100%'></td>";
                echo "<td><p class='pbodyTxt'>".$this->getImageName($data['id']);
                echo "<a href='RenameImage.php?id=".$data['id']."&file=".$data['image']."' class='pEditLinkButton'>Rename</a><a href='deleteImage.php?id=".$data['id']."&file=".$data['image']."' class='pDeleteLinkButton'>Delete</a>";
                echo "</p></td>";
                echo "<tr>";
            }
        }
        echo "<tr><td >&nbsp;</td><td></td></tr>";
        echo "<tr><td></td><td align='right'><a href='viewImageFolders.php' class='pEnableLinkButton' style='padding:10px;text-transform:uppercase'>Image Manager (No. of imgs ".$this->fetchNumberOfImages().")</a></td></tr>";
        echo "</table>";
    }
    public function fetchImages(){
      $query = "SELECT * FROM images ORDER BY id DESC";
      $dbq = new DatabaseConnection();
      $get_data = $dbq->fetch($query);

      echo "<table width='100%'>";
      echo "<tr><td>Thumbnail</td><td>Code to Copy & Paste</td></tr>";

      foreach ($get_data as $data){
          if ($data['image']){
              echo "<tr>";
              echo "<td width='150px'><img src='image/".$data['image']."' height='80'></td>";
              echo "<td><p class='pbodyTxt'>Name: ".$this->getImageName($data['id'])."</p>";
              echo "<p class='pbodyTxt'>Location: image/".$data['image']."</p>";
              echo "<a href='RenameImage.php?id=".$data['id']."&file=".$data['image']."' class='pEditLinkButton'>Rename</a><a href='deleteImage.php?id=".$data['id']."&file=".$data['image']."' class='pDeleteLinkButton'>Delete</a>";
              echo "</td>";
              echo "<tr>";
              echo "<tr><td >&nbsp;</td><td></td></tr>";
          }
      }
      echo "</table>";
    }
	public function fetchNumberOfImages(){
    $query = "SELECT * FROM images";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query);

		$imageNum = 0;

		foreach($get_data as $data){
			if ($data['image'] != null){
				$imageNum = $imageNum + 1;
			}
		}

		return $imageNum;
	}

  public function fetchPagesArray($textLimit = 80){
    $query = "SELECT * FROM pages ORDER BY pageorder";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query);

    $array = array();
    $index = 0;

    foreach ($get_data as $data){
      $pageName = null;
      if ($textLimit != null){
        $pageName = $this->limitText($data['pagename'],$textLimit);
      }else{
        $pageName = $data['pagename'];
      }

      $array[$index]['pagename'] = $pageName;
      $array[$index]['id'] = $data['id'];
      $array[$index]['type'] = $data['pagetype'];
      $array[$index]['status'] = $data['status'];
      $array[$index]['draft'] = $data['draft'];
      $array[$index]['isGrouped'] = $data['isGrouped'];
      $array[$index]['groupID'] = $data['groupID'];
      $array[$index]['image'] = $data['image'];
      $array[$index]['additional'] = $data['additional'];
      $array[$index]['additional2'] = $data['additional2'];
      $array[$index]['additional3'] = $data['additional2'];
      $index++;
    }
    return $array;
  }

    public function fetchPages($showBlog = true, $pageImage = false, $showGroups = false){
      $query = "SELECT * FROM pages ORDER BY pageorder";
      $dbq = new DatabaseConnection();
      $get_data = $dbq->fetch($query);

      $PageEditStatus = 'hidden';

        foreach ($get_data as $data){

        	$pageName = $this->limitText($data['pagename'], 80);
            if ($data['isGrouped'] == 'false'){


                if ($data['pagetype'] == 'homepage'){
                    if ($data['draft'] == 'yes' && $data['status'] == 'draft'){
                        echo $pageName."<a class='txtTag'>[draft]</a>";
                    }
                    else{
                        echo $pageName;
                    }
                    echo "<a class='txtTag'>{homepage}</a><a class='pEditLinkButton' href='../EditPage/" . $data['id'] . "'>Edit</a>";

                    if ($data['draft'] == 'yes' && $data['status'] != 'draft'){
                        if (file_exists('../view/drafts/pages/pageDraft-'.$data['id'].'.json')){
                            echo "<a class='pEditLinkButton' href='../EditPage/" . $data['id'] . "/draft'>Open Draft</a>";
                        }
                    }

                    if ($pageImage == true){
                        if ($data['image'] != null){
                            echo "<a class='pEditLinkButton' href='setPageImage.php?id="
                                . $data['id'] . "&img=".$data['image']."'>Page Image</a>";
                        }else{
                            echo "<a class='pEditLinkButton' href='setPageImage.php?id="
                                . $data['id'] . "'>Page Image</a>";
                        }
                    }

                    if ($this->isPageSourceEditingAllow() == true){
                        echo "<a class='pEditLinkButton' href='editPageSource.php?id="
                                . $data['id'] . "'>Edit Source</a>";
                    }


                    if ($data['status'] == 'hidden' && $data['status'] != 'draft'){
                        echo "<a class='pDisableLinkButton' href='changePageStatus.php?id=" . $data['id'] . "&status=active'>Unhide</a>";
                    }
                    elseif($data['status'] == 'active' && $data['status'] != 'draft'){
                        echo "<a class='pEnableLinkButton' href='changePageStatus.php?id=" . $data['id'] . "&status=hidden'>Hide</a>";
                    }

                    echo "<br>";
                    echo "<br>";
                }



                elseif($data['pagetype'] == 'blog' && $showBlog == true){
                    echo $pageName;
                    echo "<a class='txtTag'>{blog}</a><a class='pEditLinkButton' href='../EditPage/" . $data['id'] . "'>Edit</a>";
                    if ($pageImage == true){
                        if ($data['image'] != null){
                            echo "<a class='pEditLinkButton' href='setPageImage.php?id="
                                . $data['id'] . "&img=".$data['image']."'>Page Image</a>";
                        }else{
                            echo "<a class='pEditLinkButton' href='setPageImage.php?id="
                                . $data['id'] . "'>Page Image</a>";
                        }
                    }
                    if ($this->isPageSourceEditingAllow() == true){
                        echo "<a class='pEditLinkButton' href='editPageSource.php?id="
                                . $data['id'] . "'>Edit Source</a>";
                    }
                    if ($data['status'] == 'active'){
                        echo "<a class='pEnableLinkButton' href='PageUpdateStatus.php?id=" . $data['id'] . "&status=disable'>Enabled</a>";
                    }else{
                        echo "<a class='pDisableLinkButton' href='PageUpdateStatus.php?id=" . $data['id'] . "&status=active'>Disabled</a>";
                    }
                    echo "<br>";
                    echo "<br>";
                }


                elseif($data['pagetype'] == 'contact'){
                    echo $pageName;
                    echo "<a class='txtTag'>{contact}</a><a class='pEditLinkButton' href='editContactPage.php?id=" . $data['id'] . "' class='pLinkTxt'>Edit</a>";
                    if ($pageImage == true){
                        if ($data['image'] != null){
                            echo "<a class='pEditLinkButton' href='setPageImage.php?id="
                                . $data['id'] . "&img=".$data['image']."'>Page Image</a>";
                        }else{
                            echo "<a class='pEditLinkButton' href='setPageImage.php?id="
                                . $data['id'] . "'>Page Image</a>";
                        }
                    }
                    if ($data['status'] == 'active'){
                        echo "<a class='pEnableLinkButton' href='PageUpdateStatus.php?id=" . $data['id'] . "&status=disable'>Enabled</a>";
                    }else{
                        echo "<a class='pDisableLinkButton' href='PageUpdateStatus.php?id=" . $data['id'] . "&status=active'>Disabled</a>";
                    }
                    echo "<br>";
                    echo "<br>";
                }



                elseif ($data['pagetype'] == 'relink'){
                    echo $pageName;
                    $editlink = $data['additional2'];

                    echo "<a class='txtTag'>{custom}</a>";

                    if ($editlink != null | $editlink != ''){
                        echo "<a class='pEditLinkButton' href='editCustomPage.php?id=" . $data['id'] . "&page=".$data['pagename']."&url=".$data['additional']."&edit=".$editlink."'>Edit Link</a><a class='pEditLinkButton' href='$editlink?id=" . $data['id'] . "'>Edit Page</a>";
                    }else{
                        echo "<a class='pEditLinkButton' href='editCustomPage.php?id=" . $data['id'] . "&page=".$data['pagename']."&url=".$data['additional']."'>Edit</a>";
                    }

                    if ($data['status'] == 'hidden'){
                        echo "<a class='pDisableLinkButton' href='changePageStatus.php?id=" . $data['id'] . "&status=active'>Unhide</a>";
                    }elseif($data['status'] == 'active'){
                        echo "<a class='pEnableLinkButton' href='changePageStatus.php?id=" . $data['id'] . "&status=hidden'>Hide</a>";
                    }

                    echo "<a href='deletePageConfirmation.php?id=" . $data['id'] ."&page=".$data['pagename']."' class='pDeleteLinkButton'>Delete<a>";

                    echo "<br>";
                    echo "<br>";
                }



                elseif ($data['pagetype'] == 'normal'){
                    if ($data['draft'] == 'yes' && $data['status'] == 'draft'){
                        echo $pageName."<a class='txtTag'>[draft]</a>";
                    }
                    else{
                        echo $pageName;
                    }
                    echo "<a class='pEditLinkButton' href='../EditPage/" . $data['id'] . "'>Edit</a>";

                    if ($data['draft'] == 'yes' && $data['status'] != 'draft'){
                        if (file_exists('../view/drafts/pages/pageDraft-'.$data['id'].'.json')){
                            echo "<a class='pEditLinkButton' href='../EditPage/" . $data['id'] . "/draft'>Open Draft</a>";
                        }
                    }

                    if ($pageImage == true){
                        if ($data['image'] != null){
                            echo "<a class='pEditLinkButton' href='setPageImage.php?id="
                                . $data['id'] . "&img=".$data['image']."'>Page Image</a>";
                        }else{
                            echo "<a class='pEditLinkButton' href='setPageImage.php?id="
                                . $data['id'] . "'>Page Image</a>";
                        }
                    }

                    if ($this->isPageSourceEditingAllow() == true){
                        echo "<a class='pEditLinkButton' href='editPageSource.php?id="
                                . $data['id'] . "'>Edit Source</a>";
                    }

                    echo "<a href='deletePageConfirmation.php?id=" . $data['id'] ."&page=".strip_tags($data['pagename'])."' class='pDeleteLinkButton'>Delete<a>";

                    if ($data['status'] == 'hidden' && $data['status'] != 'draft'){
                        echo "<a class='pDisableLinkButton' href='changePageStatus.php?id=" . $data['id'] . "&status=active'>Unhide</a>";
                    }
                    elseif($data['status'] == 'active' && $data['status'] != 'draft'){
                        echo "<a class='pEnableLinkButton' href='changePageStatus.php?id=" . $data['id'] . "&status=hidden'>Hide</a>";
                    }

                    echo "<br>";
                    echo "<br>";
                }



                elseif ($data['pagetype'] == 'group' && $showGroups == true){
                    echo "<a href='editPageGroup.php?grpID=".$data['id']."' class='plinkTxt'><b>".$pageName."</b></a>";
                    echo "<a class='pEditLinkButton' href='setGroupPageLink.php?grp=".$data['id']."'>Link To</a>";
                    echo "<br><br>";
                }
            }
        }
    }
    public function fetchGroupPages($ID, $path = null, $pageImage = false){
      $query = "SELECT * FROM pages ORDER BY pageorder";
      $dbq = new DatabaseConnection();
      $get_data = $dbq->fetch($query);

		  foreach ($get_data as $data){
			  $pageName = $this->limitText($data['pagename'], 80);
            if ($data['groupID'] == $ID){
                if ($data['pagetype'] == 'homepage'){
                    if ($data['draft'] == 'yes' && $data['status'] == 'draft'){
                        echo $pageName."<a class='txtTag'>[draft]</a>";
                    }
                    else{
                        echo $pageName;
                    }
                    echo "<a class='txtTag'>{homepage}</a><a class='pEditLinkButton' href='".$path."EditPage.php?id=" . $data['id'] . "'>Edit</a>";

                    if ($data['draft'] == 'yes' && $data['status'] != 'draft'){
                        if (file_exists('../view/drafts/pages/pageDraft-'.$data['id'].'.json')){
                            echo "<a class='pEditLinkButton' href='".$path."EditPage.php?id=" . $data['id'] . "&draft=yes'>Open Draft</a>";
                        }
                    }

                    if ($pageImage == true){
                        if ($data['image'] != null){
                            echo "<a class='pEditLinkButton' href='setPageImage.php?id="
                                . $data['id'] . "&img=".$data['image']."'>Page Image</a>";
                        }else{
                            echo "<a class='pEditLinkButton' href='setPageImage.php?id="
                                . $data['id'] . "'>Page Image</a>";
                        }
                    }

                    if ($this->isPageSourceEditingAllow() == true){
                        echo "<a class='pEditLinkButton' href='editPageSource.php?id="
                                . $data['id'] . "'>Edit Source</a>";
                    }

                    if ($data['status'] == 'hidden'){
                        echo "<a class='pDisableLinkButton' href='changePageStatus.php?id=" . $data['id'] . "&status=active'>Unhide</a>";
                    }
                    elseif($data['status'] == 'active'){
                        echo "<a class='pEnableLinkButton' href='changePageStatus.php?id=" . $data['id'] . "&status=hidden'>Hide</a>";
                    }
                }
                elseif($data['pagetype'] == 'blog'){
                    echo $pageName;
                    echo "<a class='txtTag'>{blog}</a><a class='pEditLinkButton' href='".$path."EditPage.php?id=" . $data['id'] . "'>Edit</a>";
                    if ($pageImage == true){
                        if ($data['image'] != null){
                            echo "<a class='pEditLinkButton' href='setPageImage.php?id="
                                . $data['id'] . "&img=".$data['image']."'>Page Image</a>";
                        }else{
                            echo "<a class='pEditLinkButton' href='setPageImage.php?id="
                                . $data['id'] . "'>Page Image</a>";
                        }
                    }
                    if ($data['status'] == 'active'){
                        echo "<a class='pEnableLinkButton' href='PageUpdateStatus.php?id=" . $data['id'] . "&status=disable'>Enabled</a>";
                    }else{
                        echo "<a class='pDisableLinkButton' href='PageUpdateStatus.php?id=" . $data['id'] . "&status=active'>Disabled</a>";
                    }
                }
                elseif($data['pagetype'] == 'contact'){
                    echo $pageName;
                    echo "<a class='txtTag'>{contact}</a><a class='pEditLinkButton' href='editContactPage.php?id=" . $data['id'] . "' class='pLinkTxt'>Edit</a>";
                    if ($pageImage == true){
                        if ($data['image'] != null){
                            echo "<a class='pEditLinkButton' href='setPageImage.php?id="
                                . $data['id'] . "&img=".$data['image']."'>Page Image</a>";
                        }else{
                            echo "<a class='pEditLinkButton' href='setPageImage.php?id="
                                . $data['id'] . "'>Page Image</a>";
                        }
                    }
                    if ($data['status'] == 'active'){
                        echo "<a class='pEnableLinkButton' href='PageUpdateStatus.php?id=" . $data['id'] . "&status=disable'>Enabled</a>";
                    }else{
                        echo "<a class='pDisableLinkButton' href='PageUpdateStatus.php?id=" . $data['id'] . "&status=active'>Disabled</a>";
                    }
                }
                elseif ($data['pagetype'] == 'relink'){
                    echo $pageName;
                    $editlink = $data['additional2'];

                    echo "<a class='txtTag'>{custom}</a>";

                    if ($editlink != null | $editlink != ''){
                        echo "<a class='pEditLinkButton' href='editCustomPage.php?id=" . $data['id'] . "&page=".$data['pagename']."&url=".$data['additional']."&edit=".$editlink."'>Edit Link</a><a class='pEditLinkButton' href='$editlink?id=" . $data['id'] . "'>Edit Page</a>";
                    }else{
                        echo "<a class='pEditLinkButton' href='editCustomPage.php?id=" . $data['id'] . "&page=".$data['pagename']."&url=".$data['additional']."'>Edit</a>";
                    }

                    echo "<a href='deletePageConfirmation.php?id=" . $data['id'] ."&page=".$data['pagename']."' class='pDeleteLinkButton'>Delete<a>";
                }
                elseif ($data['pagetype'] == 'normal'){
                    if ($data['draft'] == 'yes' && $data['status'] == 'draft'){
                        echo $pageName."<a class='txtTag'>[draft]</a>";
                    }
                    else{
                        echo $pageName;
                    }
                    echo "<a class='pEditLinkButton' href='".$path."EditPage.php?id=" . $data['id'] . "'>Edit</a>";

                    if ($data['draft'] == 'yes' && $data['status'] != 'draft'){
                        if (file_exists('../view/drafts/pages/pageDraft-'.$data['id'].'.json')){
                            echo "<a class='pEditLinkButton' href='".$path."EditPage.php?id=" . $data['id'] . "&draft=yes'>Open Draft</a>";
                        }
                    }

                    if ($pageImage == true){
                        if ($data['image'] != null){
                            echo "<a class='pEditLinkButton' href='setPageImage.php?id="
                                . $data['id'] . "&img=".$data['image']."'>Page Image</a>";
                        }else{
                            echo "<a class='pEditLinkButton' href='setPageImage.php?id="
                                . $data['id'] . "'>Page Image</a>";
                        }
                    }

                    if ($this->isPageSourceEditingAllow() == true){
                        echo "<a class='pEditLinkButton' href='editPageSource.php?id="
                                . $data['id'] . "'>Edit Source</a>";
                    }

                    echo "<a href='deletePageConfirmation.php?id=" . $data['id'] ."&page=".strip_tags($data['pagename'])."' class='pDeleteLinkButton'>Delete<a>";

                    if ($data['status'] == 'hidden'){
                        echo "<a class='pDisableLinkButton' href='changePageStatus.php?id=" . $data['id'] . "&status=active'>Unhide</a>";
                    }
                    elseif($data['status'] == 'active'){
                        echo "<a class='pEnableLinkButton' href='changePageStatus.php?id=" . $data['id'] . "&status=hidden'>Hide</a>";
                    }
                }
                elseif ($data['pagetype'] == 'group'){
                    echo "<a href='editPageGroup.php?grpID=".$data['id']."' class='plinkTxt'><b>".$pageName."</b></a>";
                    echo "<a class='pEditLinkButton' href='setGroupPageLink.php?grp=".$data['id']."'>Link To</a>";
                    echo "&nbsp&nbsp";
                }
                echo "<a class='pDisableLinkButton' href='ungroupPage.php?id=" . $data['id'] . "?grpID=".$ID."'>Ungroup</a>";
                echo "<br><br>";
            }

		}
    }
    public function fetchSubPages($path){
      $query = "SELECT * FROM pages ORDER BY pageorder";
      $dbq = new DatabaseConnection();
      $get_data = $dbq->fetch($query);
      foreach ($get_data as $data){
            if ($data['pagetype'] == 'subpage'){
                if ($data['draft'] == 'yes' && $data['status'] == 'draft'){
                    echo $this->limitText($data['pagename'],80)."<a class='txtTag'>&nbsp;&nbsp;[draft]</a>";
                }
                else{
                    echo $this->limitText($data['pagename'],80);
                }
                echo "<a href='".$path."EditPage.php?id=" . $data['id'] . "' class='pEditLinkButton'>Edit</a>";
                if ($data['draft'] == 'yes' && $data['status'] != 'draft'){
                    echo "<a href='".$path."EditPage.php?id=" . $data['id'] . "&draft=yes' class='pEditLinkButton'>Open Draft</a>";
                }
                if ($this->isPageSourceEditingAllow() == true){
                    echo "<a class='pEditLinkButton' href='editPageSource.php?id="
                            . $data['id'] . "'>Edit Source</a>";
                }
                echo "<a href='deletePageConfirmation.php?id=" . $data['id'] ."&page=".$data['pagename']."' class='pDeleteLinkButton'>Delete<a>";
                echo "<br>";
                echo "<br>";
            }
        }
    }

    public function fetchBlogPostsArray($username, $limitText = 80){
      $query = "SELECT * FROM blog ORDER BY id DESC";
      $dbq = new DatabaseConnection();
      $get_data = $dbq->fetch($query);
      $username = strtolower($username);
      $privilege = $this->checkPrivileges($username);
      $index = 0;
      $array = array();
      foreach($get_data as $data){
        $user = strtolower($data['user']);
        if ($user == $username || $privilege == 'administrator'){
          $postTitle = $this->limitText($data['posttitle'],$limitText);
          $array[$index]['title'] = $postTitle;
          $array[$index]['id'] = $data['id'];
          $array[$index]['draft'] = $data['draft'];
          $array[$index]['status'] = $data['status'];
          $array[$index]['category'] = $data['category'];
          $index++;
        }
      }
      return $array;
    }
    public function fetchBlogPosts($username, $path){
      $query = "SELECT * FROM blog ORDER BY id DESC";
      $dbq = new DatabaseConnection();
      $get_data = $dbq->fetch($query);

		    $username = strtolower($username);

        $string = '';

      foreach ($get_data as $data){

			  $user = strtolower($data['user']);

      	if ($username == $user || $username == 'admin'){
            if ($data['draft'] == 'yes' && $data['status'] == 'draft'){
                $string .= $this->limitText($data['posttitle'], 50)."<a class='txtTag'>&nbsp;&nbsp;{".$this->getCategory($data['category'])."}&nbsp;&nbsp;[draft]</a>";
            }
            else{
                $string .= $this->limitText($data['posttitle'], 50)."<a class='txtTag'>&nbsp;&nbsp;{".$this->getCategory($data['category'])."}</a>";
            }
            $string .= "<a href='".$path."EditPost/".$data['id']."' class='pEditLinkButton'>Edit</a>";
              if ($data['draft'] == 'yes' && $data['status'] != 'draft'){
                  if (file_exists('../view/drafts/posts/postDraft-'.$data['id'].'.json')){
                      $string .= "<a href='".$path."EditPost/".$data['id']."/yes' class='pEditLinkButton'>Open Draft</a>";
                  }
              }
              $string .= "<a href='addToCategory.php?page=".$data['posttitle']."&id=".$data['id']."' class='pEditLinkButton'>Add To Category</a>";
              if ($data['status'] == 'hidden'){
                      $string .= "<a class='pDisableLinkButton' href='changePostStatus.php?id=" . $data['id'] . "&status=active'>Unhide</a>";
              }
              elseif($data['status'] == 'active'){
                  $string .= "<a class='pEnableLinkButton' href='changePostStatus.php?id=" . $data['id'] . "&status=hidden'>Hide</a>";
              }
              $string .= "<a href='deletePostConfirmation.php?id=" . $data['id'] ."&page=".$data['posttitle']."' class='pDeleteLinkButton'>Delete<a>";
            $string .= "<br>";
            $string .= "<br>";
			}
        }

        return $string;
    }
    public function fetchCategories(){
      $query = "SELECT * FROM categories ORDER BY categoryOrder";
      $dbq = new DatabaseConnection();
      $get_data = $dbq->fetch($query);
      $list = array();
      $index = 0;
      foreach ($get_data as $data){
          $list[$index]['id'] = $data['id'];
          $list[$index]['name'] = $data['category'];
          $list[$index]['icon'] = $data['icon'];
          $index++;
      }
      return $list;
    }




    public function fetchUsers($currentuser){
      $query = "SELECT * FROM users";
      $dbq = new DatabaseConnection();
      $get_data = $dbq->fetch($query);

      $query2 = "SELECT * FROM users WHERE username='$currentuser'";
      $get_user = $dbq->fetch($query2,1);
      $UserType = $get_user['acctype'];
      $array = array();
      $index = 0;
      foreach ($get_data as $data){
          if ($data['id'] == 1 && $currentuser == $data['username']){
            $array[$index]['user'] = $data['username'];
            $array[$index]['id'] = $data['id'];
            $array[$index]['editable'] = true;
            $array[$index]['deletable'] = false;
            $array[$index]['admin'] = true;
            //echo "<p class='pbodyTxt'>User: ".$data['username']." <a class='txtTag'>{administrator}</a><a class='pEditLinkButton' href='editUserDetails.php?id=" .$data['id'] ."'>Edit Details</a></p>";
          }
          elseif ($data['id'] == 1){
            $array[$index]['user'] = $data['username'];
            $array[$index]['id'] = $data['id'];
            $array[$index]['editable'] = false;
            $array[$index]['deletable'] = false;
            $array[$index]['admin'] = true;
            //echo "<p class='pbodyTxt'>User: ".$data['username']." <a class='txtTag'>{administrator}</a></p>";
          }
          elseif ($currentuser == $data['username'] && $this->checkPrivileges($currentuser) == 'administrator'){
            $array[$index]['user'] = $data['username'];
            $array[$index]['id'] = $data['id'];
            $array[$index]['editable'] = true;
            $array[$index]['deletable'] = true;
            $array[$index]['admin'] = true;
            //echo "<p class='pbodyTxt'>User: ".$data['username']." <a class='txtTag'>{administrator}</a><a class='pEditLinkButton' href='editUserDetails.php?id=" .$data['id'] ."'>Edit</a><a class='pDeleteLinkButton' href='deleteUser.php?id=" .$data['id'] ."'>Delete</a></p>";
          }
          elseif ($currentuser == strtolower($data['username'])){
            $array[$index]['user'] = $data['username'];
            $array[$index]['id'] = $data['id'];
            $array[$index]['editable'] = true;
            $array[$index]['deletable'] = true;
            $array[$index]['admin'] = false;
            //echo "<p class='pbodyTxt'>User: ".$data['username']."<a class='pEditLinkButton' href='editUserDetails.php?id=" .$data['id'] ."'>Edit</a><a class='pDeleteLinkButton' href='deleteUserConfirmation.php?id=" .$data['id'] . "&user=".$data['username']."'>Delete</a></p>";
          }
          elseif ($data['acctype'] == 'administrator'){

              if ($this->checkPrivileges($currentuser) == 'administrator') {
                $array[$index]['user'] = $data['username'];
                $array[$index]['id'] = $data['id'];
                $array[$index]['editable'] = true;
                $array[$index]['deletable'] = true;
                $array[$index]['admin'] = true;
                //echo "<p class='pbodyTxt'>User: ".$data['username']." <a class='txtTag'>{administrator}</a>&nbsp;&nbsp;&nbsp;&nbsp;<a class='pDeleteLinkButton' href='deleteUserConfirmation.php?id=" .$data['id'] ."&user=".$data['username']."'>Delete</a></p>";
              }
              else{
                $array[$index]['user'] = $data['username'];
                $array[$index]['id'] = $data['id'];
                $array[$index]['editable'] = false;
                $array[$index]['deletable'] = false;
                $array[$index]['admin'] = true;
                //echo "<p class='pbodyTxt'>User: ".$data['username']." <a class='txtTag'>{administrator}</a></p>";
              }
          }
          elseif ($this->checkPrivileges($currentuser) == 'administrator') {
            $array[$index]['user'] = $data['username'];
            $array[$index]['id'] = $data['id'];
            $array[$index]['editable'] = false;
            $array[$index]['deletable'] = true;
            $array[$index]['admin'] = false;
            //echo "<p class='pbodyTxt'>User: ".$data['username']."&nbsp;&nbsp;&nbsp;&nbsp;<a class='pDeleteLinkButton' href='deleteUserConfirmation.php?id=" .$data['id'] ."&user=".$data['username']."'>Delete</a></p>";
          }
          else{
            $array[$index]['user'] = $data['username'];
            $array[$index]['id'] = $data['id'];
            $array[$index]['editable'] = false;
            $array[$index]['deletable'] = false;
            $array[$index]['admin'] = false;
            //echo "<p class='pbodyTxt'>User: ".$data['username']."</p>";
          }
          $index++;
      }
      /*
      if ($UserType == 'administrator'){
          echo "<p align='right'>
              <a class='pContentbtn' name='NewUserBtn'>
              	Create New User
              </a>
          </p>";
      }
      */
      return $array;
    }



	/*  ===== Fetch Functions End ========  */





	public function setActiveStatus ($id, $string){
    $query = "UPDATE pages SET status='$string' WHERE id='$id'";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->query($query);
	}

  public function setActivePostStatus ($id, $string){
    $query = "UPDATE blog SET status='$string' WHERE id='$id'";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->query($query);
	}

	public function getPageStatus ($id){
    $query = "SELECT * FROM pages WHERE id='$id'";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query,1);
    return $get_data['status'];
	}

	public function isPageHidden ($id){
		if ($this->getPageStatus($id == 'hidden')){
			return true;
		}else{
			return false;
		}
	}

	public function fetchPluginsList (){
    $query = "SELECT * FROM plugins";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query);
    $array = array();
    $index = 0;
		foreach ($get_data as $data){
      $array[$index]['plugin'] = $data['pluginName'];
      $array[$index]['id'] = $data['id'];
      $index++;
		}
    return $array;
	}

	public function loadPlugins (){
    $query = "SELECT * FROM plugins";
    $dbq = new DatabaseConnection();
    $get_data = $dbq->fetch($query);

		$count = 0;
		$pluginName = Array();

		foreach ($get_data as $data){

			if ($data['pluginName'] != null){
				$pluginName[$count] = $data['pluginName'];
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
		    	echo "<li><a href='page/" . $get_data['id'] . "'>".$pageName ."</a></li>";
		    }

            if ($get_data['draft'] == 'no' && $get_data['status'] == 'active' && $get_data['pagetype'] == 'homepage' && $get_data['status'] == 'active'){
		    	echo "<li><a href='index'>".$pageName ."</a></li>";
		    }

            elseif ($get_data['pagetype'] == 'blog' && $get_data['status'] == 'active' && $DoOnce == false){
                echo "<li><a href='/blog'>".$pageName."</a></li>";
				if ($LinkType == "blog"){
					echo $this->blogCategoryLinks($cssSubLinkStyle);
				}
                $DoOnce=true;
            }

            elseif ($get_data['pagetype'] == 'contact' && $get_data['status'] == 'active' && $DoOnce2 == false){
                echo "<li><a href='/contact'>".$pageName."</a></li>";
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
        $data = mysqli_query($db,"SELECT * FROM categories ORDER BY categoryOrder");

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
        $data = mysqli_query($db,"SELECT * FROM categories ORDER BY categoryOrder");

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

    public function blogCategoryLinks ($cssStyle = null,$showPostCount = true){
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $data = mysqli_query($db,"SELECT * FROM categories ORDER BY categoryOrder");

        while ($get_data = mysqli_fetch_assoc($data)){
            if ($this->numOfCategoryPosts($get_data['id']) != 0){
            	if ($showPostCount == true){
                    if ($cssStyle == null){
                        echo "<li><a href='/blogCategory/"
            			. $get_data['id'] . "'>".$get_data['category']."&nbsp;&nbsp;("
            			.$this->numOfCategoryPosts($get_data['id']).")</a></li>";
                    }else{
                        echo "<li class='$cssStyle'><a href='/blogCategory/"
            			. $get_data['id'] . "'>".$get_data['category']."&nbsp;&nbsp;("
            			.$this->numOfCategoryPosts($get_data['id']).")</a></li>";
                    }
            	}
            	else{
                    if ($cssStyle == null){
                        echo "<li><a href='/blogCategory/"
            		. $get_data['id'] . "'>".$get_data['category']."</a></li>";
                    }else{
                        echo "<li class='$cssStyle'><a href='/blogCategory/"
            		. $get_data['id'] . "'>".$get_data['category']."</a></li>";
                    }
            	}
            }
        }
        $db->close();
    }




}


?>
