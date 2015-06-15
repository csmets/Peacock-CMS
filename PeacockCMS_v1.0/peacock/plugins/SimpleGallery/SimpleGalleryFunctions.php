<?php

class SimpleGallery{
	
	
	
	
	public function __Construct(){
		
	}
	
	
	public function fetchGalleryList(){
		$sqlconnect = new Connectdb;
    	$db = $sqlconnect->connectTo();
		$sql = "SELECT * FROM simpleGallery";
		$query = mysqli_query($db,$sql);
		while ($get_data = mysqli_fetch_assoc($query)){
			echo "<span style='padding:10px'><img src='".SITE_PATH."image/".$get_data['imageFile']."' width='100px' /></span>";
		}
		$db->close();
	}
	
	public function getImageTitle($id){
		$sqlconnect = new Connectdb;
    	$db = $sqlconnect->connectTo();
		$sql = "SELECT * FROM simpleGallery WHERE id='$id'";
		$query = mysqli_query($db,$sql);
		$get_data = mysqli_fetch_assoc($query);
		return $get_data['imageTitle'];
		$db->close();
	}

	
	public function isImageVisible($id){
		$sqlconnect = new Connectdb;
    	$db = $sqlconnect->connectTo();
		$sql = "SELECT * FROM simpleGallery WHERE id='$id'";
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
	
	public function createGallery($NumOfImages, $cssStyle){
		
		$sqlconnect = new Connectdb;
    	$db = $sqlconnect->connectTo();
		$sql = "SELECT * FROM simpleGallery";
		$query = mysqli_query($db,$sql);
		
		echo "<ul class='$cssStyle'>";
		
		while ($get_data = mysqli_fetch_assoc($query)){
			
			echo "<li><a href='image/".$get_data['imageFile']."' data-lightbox='gallery'><img src='image/".$get_data['imageFile']."'></a></li>";
			
		}
		
		echo "</ul>";
		
	}
	
	public function imageExist($FileName){
		$sqlconnect = new Connectdb;
    	$db = $sqlconnect->connectTo();
		$sql = "SELECT * FROM simpleGallery WHERE imageFile='$FileName'";
		$query = mysqli_query($db,$sql);
		$Exist = mysqli_fetch_assoc($query);
		
		if ($Exist != null){
			return true;
		}else{
			return false;
		}
		$db->close();
	}
    
    public function getGalleryPageId(){
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
		$sql = "SELECT * FROM pages";
		$query = mysqli_query($db,$sql);
        
        $id = null;
        
        while ($get_data = mysqli_fetch_assoc($query)){
            if ($get_data['additional3'] == 'SimpleGallery'){
                $id = $get_data['id'];
            }
        }
        
        return $id;
    }
	
	
}




?>