<?php


class Gallery{
	
	
	
	
	public function __Construct(){
		
	}
	
	public function fetchFolderList(){
		$sqlconnect = new Connectdb;
    	$db = $sqlconnect->connectTo();
		$sql = "SELECT * FROM GalleryFolders ORDER BY FolderOrder";
		$query = mysqli_query($db,$sql);
		while ($get_data = mysqli_fetch_assoc($query)){
			echo "<a href='GalleryFolder.php?folder=".$get_data['FolderName']."'><ul><li><img src='plugins/Gallery/folder.png'></li>";
			echo "<li>".$get_data['FolderName']."</li>";
			echo "</ul></a>";
		}
		$db->close();
	}
	
	public function fetchFolderNames(){
		$sqlconnect = new Connectdb;
    	$db = $sqlconnect->connectTo();
		$sql = "SELECT * FROM GalleryFolders ORDER BY FolderOrder";
		$query = mysqli_query($db,$sql);
		while ($get_data = mysqli_fetch_assoc($query)){
			echo "<li id='item_".$get_data['id']."'>".$get_data['FolderName']."</li>";
		}
		$db->close();
	}
	
	
	public function fetchGalleryList($folder, $imgPath = null){
		$sqlconnect = new Connectdb;
    	$db = $sqlconnect->connectTo();
		$sql = "SELECT * FROM gallery ORDER BY imageOrder";
		$query = mysqli_query($db,$sql);
		$count = 0;
		while ($get_data = mysqli_fetch_assoc($query)){
			
			if ($get_data['imageFolder'] == $folder){
				echo "<a href='GalleryEditImage.php?id=".$get_data['id']."'><ul><li><img src='".$imgPath."image/".$get_data['imageFile']."'></li><li>".$get_data['imageFile']."</li></ul></a>";
				$count++;
			}
			
		}
		
		if ($count < 1){
			echo "<h2>EMPTY FOLDER</h2>";
		}
		
		$db->close();
	}
	
	public function fetchImageList($folder, $imgPath = null){
		$sqlconnect = new Connectdb;
    	$db = $sqlconnect->connectTo();
		$sql = "SELECT * FROM gallery ORDER BY imageOrder";
		$query = mysqli_query($db,$sql);
		$count = 0;
		while ($get_data = mysqli_fetch_assoc($query)){
			
			if ($get_data['imageFolder'] == $folder){
				echo "<li id='item_".$get_data['id']."'><img src='".$imgPath."image/".$get_data['imageFile']."' width='50px'><br>".$get_data['imageFile']."</li>";
				$count++;
			}
			
		}
		
		if ($count < 1){
			echo "<h2>EMPTY FOLDER</h2>";
		}
		
		$db->close();
	}
	
	public function getImageTitle($id){
		$sqlconnect = new Connectdb;
    	$db = $sqlconnect->connectTo();
		$sql = "SELECT * FROM gallery WHERE id='$id'";
		$query = mysqli_query($db,$sql);
		$get_data = mysqli_fetch_assoc($query);
		return $get_data['imageTitle'];
		$db->close();
	}

	
	public function isImageVisible($id){
		$sqlconnect = new Connectdb;
    	$db = $sqlconnect->connectTo();
		$sql = "SELECT * FROM gallery WHERE id='$id'";
		$query = mysqli_query($db,$sql);
		$get_data = mysqli_fetch_assoc($query);
		$hidden = $get_data['hidden'];
		
		if ($hidden == 'no'){
			return true;
		}else{
			return false;
		}
		$db->close();
	}
	
	public function imageExist($FileName){
		$sqlconnect = new Connectdb;
    	$db = $sqlconnect->connectTo();
		$sql = "SELECT * FROM gallery WHERE imageFile='$FileName'";
		$query = mysqli_query($db,$sql);
		$Exist = mysqli_fetch_assoc($query);
		
		if ($Exist != null){
			return true;
		}else{
			return false;
		}
		$db->close();
	}
	
	public function getIDFromFileName ($FileName){
		$sqlconnect = new Connectdb;
    	$db = $sqlconnect->connectTo();
		$sql = "SELECT * FROM gallery WHERE imageFile='$FileName'";
		$query = mysqli_query($db,$sql);
		$Exist = mysqli_fetch_assoc($query);
		
		if ($Exist != null){
			return $Exist['id'];
		}else{
			return null;
		}
		$db->close();
	}
	
	public function getImageFolder ($id){
		$sqlconnect = new Connectdb;
    	$db = $sqlconnect->connectTo();
		$sql = "SELECT * FROM gallery WHERE id='$id'";
		$query = mysqli_query($db,$sql);
		$Exist = mysqli_fetch_assoc($query);
		
		return $Exist['imageFolder'];
		
		$db->close();
	}
	
	public function createGallery ($folder = '', $useLightbox, $IncDescInTitle, $imgPath = null){
		$sqlconnect = new Connectdb;
    	$db = $sqlconnect->connectTo();
		if ($folder == ''){
            $sql = "SELECT * FROM gallery ORDER BY id DESC";
        }else{
            $sql = "SELECT * FROM gallery ORDER BY imageOrder";   
        }
		$query = mysqli_query($db,$sql);

		while ($get_data = mysqli_fetch_assoc($query)){
			
			if ($get_data['imageFolder'] == $folder || $folder == ''){
				echo "<ul>";
				if ($useLightbox == true){
					if ($IncDescInTitle == false){
						echo "<li><a href='view/".$imgPath."image/".$get_data['imageFile']."' 
						data-title='".$get_data['imageTitle']."' 
						data-lightbox='gallery'>
						<img src='view/".$imgPath."image/".$get_data['imageFile']."'></a></li>";
					}else{
						
						$title = $get_data['imageTitle'] . " - " . $get_data['imageDesc'];
						
						echo "<li><a href='view/".$imgPath."image/".$get_data['imageFile']."' 
						data-title='$title' 
						data-lightbox='gallery'>
						<img src='view/".$imgPath."image/".$get_data['imageFile']."'></a></li>";
					}
					
				}else{
					echo "<li class='Img'><img src='view/".$imgPath."image/".$get_data['imageFile']."'></li>";
				}
				echo "<li class='Title'>".$get_data['imageTitle']."</li>";
				echo "<li class='Desc'>".$get_data['imageDesc']."</li>";
				echo "</ul>";
			}
		}
	}
    
    public function createLazyGallery ($folder = '', $useLightbox, $IncDescInTitle, $imgPath = null){
        $sqlconnect = new Connectdb;
    	$db = $sqlconnect->connectTo();
        if ($folder == ''){
            $sql = "SELECT * FROM gallery ORDER BY id DESC";
        }else{
            $sql = "SELECT * FROM gallery ORDER BY imageOrder";   
        }
		$query = mysqli_query($db,$sql);
        
        echo '<script type="text/javascript" src="view/js/jquery.lazyload.js"></script>';

		while ($get_data = mysqli_fetch_assoc($query)){
			
			if ($get_data['imageFolder'] == $folder || $folder == ''){
				echo "<ul>";
				if ($useLightbox == true){
					if ($IncDescInTitle == false){
						echo "<li><a href='view/".$imgPath."image/".$get_data['imageFile']."' 
						data-title='".$get_data['imageTitle']."' 
						data-lightbox='gallery'>
						<img src='view/".$imgPath."image/".$get_data['imageFile']."'></a></li>";
					}else{
						
						$title = $get_data['imageTitle'] . " - " . $get_data['imageDesc'];
						
						echo "<li><a href='view/".$imgPath."image/".$get_data['imageFile']."' 
						data-title='$title' 
						data-lightbox='gallery'>
						<img class='lazy' data-original='view/".$imgPath."image/".$get_data['imageFile']."'></a></li>";
					}
					
				}else{
					echo "<li class='Img'><img class='lazy' data-original='view/".$imgPath."image/".$get_data['imageFile']."'></li>";
				}
				echo "<li class='Title'>".$get_data['imageTitle']."</li>";
				echo "<li class='Desc'>".$get_data['imageDesc']."</li>";
				echo "</ul>";
			}
		}
    }
    
    
    
    public $galleryFolderLink = null;
    
	
	public function displayFolderList ($useImage, $name = '', $cssStyle = '',$showOnly = null){
		$sqlconnect = new Connectdb;
    	$db = $sqlconnect->connectTo();
        
        $sqlPages = "SELECT * FROM pages";
        $pagesQuery = mysqli_query($db,$sqlPages);
        $galleryLink = '';
        
        if ($this->galleryFolderLink == null){
            while ($page_data = mysqli_fetch_assoc($pagesQuery)){
                if ($page_data['additional3'] == "Gallery"){
                    $galleryLink = $page_data['additional'];
                    break;
                }
            }
        }else{
            $galleryLink = $this->galleryFolderLink;   
        }
        
		$catsql = "SELECT * FROM GalleryFolders ORDER BY FolderOrder";
		$catquery = mysqli_query($db,$catsql);

        $catString = '';
        
        if ($showOnly == null){
            
            while ($get_data = mysqli_fetch_assoc($catquery)){
                $catString .= $get_data['FolderName'].",";   
            }
            
            $catString = substr($catString, 0 ,-1);
            
        }else{
            $catString = $showOnly;   
        }

        $catString = explode(",", $catString);

        $sql = "SELECT * FROM GalleryFolders ORDER BY FolderOrder";
		$query = mysqli_query($db,$sql);

		while ($get_data = mysqli_fetch_assoc($query)){
            
            foreach ($catString as $category){
                if ($category == $get_data['FolderName']){
                    
                    
                    $categoriesString = '';
                    if ($showOnly != null){
                        $categoriesString = "&categories=".$showOnly;   
                    }
                    
                    if ($name == $get_data['FolderName']){
				
                        echo "<a class='$cssStyle' href='".$galleryLink."?folder=".$get_data['FolderName'].$categoriesString."'>";

                        if ($get_data['FolderImage'] != null && $useImage == true){
                            echo "<li>".$get_data['FolderImage']."</li>";
                        }

                        echo "<li>".$get_data['FolderName']."</li>";

                        echo "</a>";

                    }else{

                        echo "<a href='".$galleryLink."?folder=".$get_data['FolderName'].$categoriesString."'>";

                        if ($get_data['FolderImage'] != null && $useImage == true){
                            echo "<li>".$get_data['FolderImage']."</li>";
                        }

                        echo "<li>".$get_data['FolderName']."</li>";

                        echo "</a>";

                    }
                }
            }
			
		}

	}
    
    public function getGalleryPageId(){
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
		$sql = "SELECT * FROM pages";
		$query = mysqli_query($db,$sql);
        
        $id = null;
        
        while ($get_data = mysqli_fetch_assoc($query)){
            if ($get_data['additional3'] == 'Gallery'){
                $id = $get_data['id'];
            }
        }
        
        return $id;
    }
    
    /*
    
        Types of replacements
        imageSrc = Image file name
        imageTitle = Image Title
        imageDesc = Image Description
        random = put random int value here
    
    */
    
    public $customStartSequence = null;
    public $customImageFormat = "<img src='view/image/imageSrc' /><p>imageTitle</p><p>imageDesc</p>";
    public $customEndSquence = null;
    public $randRangeMin = 100;
    public $randRangeMax = 500;
    
    public function createCustomGallery($folder = ''){
        $sqlconnect = new Connectdb;
    	$db = $sqlconnect->connectTo();
		if ($folder == ''){
            $sql = "SELECT * FROM gallery ORDER BY id DESC";
        }else{
            $sql = "SELECT * FROM gallery ORDER BY imageOrder";   
        }
		$query = mysqli_query($db,$sql);
        echo $this->customStartSequence;
		while ($get_data = mysqli_fetch_assoc($query)){
			
			if ($get_data['imageFolder'] == $folder || $folder == ''){
				
				$insertImage = str_replace("imageSrc",$get_data['imageFile'],$this->customImageFormat);
                $insertImageTitle = str_replace("imageTitle",$get_data['imageTitle'], $insertImage);
                $insertImageDesc = str_replace("imageDesc",$get_data['imageDesc'], $insertImageTitle);
                $insertRandom = str_replace("random", rand($this->randRangeMin, $this->randRangeMax), $insertImageDesc);
                echo $insertRandom;
				
			}
		}
        echo $this->customEndSequence;
    }
	
}




?>