<?php


class Projects{


	
	public function __Construct(){

	}
	
	
	public function fetchProjectList(){
		$sqlconnect = new Connectdb;
    	$db = $sqlconnect->connectTo();
		$peacock = new Peacock;
		$sql = "SELECT * FROM projects ORDER BY projectOrder";
		$query = mysqli_query($db,$sql);
		while ($get_data = mysqli_fetch_assoc($query)){

			if ($get_data['projectDraft'] == 'no'){
				echo "<p>".$get_data['projectTitle']."<a class='txtTag'>&nbsp;&nbsp;{".$this->convertProjectCategories($get_data['projectCategory'])."}</a><a class='pEditLinkButton' href='../EditProjectPost.php?id=" 
			. $get_data['id'] . "'>Edit</a><a href='plugins/ProjectPosts/ChangeProjectStatus.php?id=".$get_data['id']."&status=yes' class='pEnableLinkButton'>Hide</a>
			<a href='plugins/ProjectPosts/addToProjectCategory.php?page=".$get_data['projectTitle']."&id=".$get_data['id']."' class='pEditLinkButton'>Add To Category</a><a class='pDeleteLinkButton' href='plugins/ProjectPosts/deleteProjectPost.php?id=" . $get_data['id'] ."'>Delete</a>
			</p>";
			}else{
				echo "<p>".$get_data['projectTitle']."<a class='txtTag'>&nbsp;&nbsp;{".$this->convertProjectCategories($get_data['projectCategory'])."}</a><a class='pEditLinkButton' href='../EditProjectPost.php?id=" 
			. $get_data['id'] . "'>Edit</a><a href='plugins/ProjectPosts/ChangeProjectStatus.php?id=".$get_data['id']."&status=no' class='pDisableLinkButton'>Unhide</a>
			<a href='plugins/ProjectPosts/addToProjectCategory.php?page=".$get_data['projectTitle']."&id=".$get_data['id']."' class='pEditLinkButton'>Add To Category</a><a class='pDeleteLinkButton' href='plugins/ProjectPosts/deleteProjectPost.php?id=" . $get_data['id'] ."'>Delete</a>
			</p>";
			}
			
		}
	}
    
    private function convertProjectCategories($string){
        $peacock = new Peacock;
        $categories = explode(',',$string);
        $result = '';
        $count = 1;
        foreach ($categories as $category){
            if (count($categories) == 1){
                $result .= $peacock->getCategory($category);
            }
            elseif($count < count($categories)) {
                $result .= $peacock->getCategory($category).", ";
                $count++;
            }else{
                $result .= $peacock->getCategory($category);
            }
            
        }
        return $result;
    }
	
	public function getPostTitle($id){
		$sqlconnect = new Connectdb;
    	$db = $sqlconnect->connectTo();
		$sql = "SELECT * FROM projects WHERE id='$id'";
		$query = mysqli_query($db,$sql);
		$get_data = mysqli_fetch_assoc($query);
		return $get_data['projectTitle'];
	}
	
	public function getPostSubTitle($id){
		$sqlconnect = new Connectdb;
    	$db = $sqlconnect->connectTo();
		$sql = "SELECT * FROM projects WHERE id='$id'";
		$query = mysqli_query($db,$sql);
		$get_data = mysqli_fetch_assoc($query);
		return $get_data['projectSubTitle'];
	}
	
	public function getPostContent($id){
		$sqlconnect = new Connectdb;
    	$db = $sqlconnect->connectTo();
		$sql = "SELECT * FROM projects WHERE id='$id'";
		$query = mysqli_query($db,$sql);
		$get_data = mysqli_fetch_assoc($query);
		return $get_data['projectContent'];
	}
	
	public function getPostImage($id){
		$sqlconnect = new Connectdb;
    	$db = $sqlconnect->connectTo();
		$sql = "SELECT * FROM projects WHERE id='$id'";
		$query = mysqli_query($db,$sql);
		$get_data = mysqli_fetch_assoc($query);
		return $get_data['projectImage'];
	}
	
	public function changeStatus($id, $status){
		$sqlconnect = new Connectdb;
	    $db = $sqlconnect->connectTo();
	    $SentToDatabase = "UPDATE projects SET projectDraft='$status' WHERE id='$id'";
	    $sql = mysqli_query($db, $SentToDatabase);
		$db->close();
	}
	
	
	
	 public function projectCategoryLinks ($cssStyle, $PageLink){
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $data = mysqli_query($db,"SELECT * FROM categories");

        while ($get_data = mysqli_fetch_assoc($data)){
        	 if ($this->numOfCategoryPosts($get_data['id']) != 0){
            echo "<li class='$cssStyle'><a href='$PageLink?id="
            . $get_data['id'] . "'>".$get_data['category']."</a></li>";
			 }
        }
        $db->close();
    }


    
    public function numOfCategoryPosts($Category){
        $peacock = new Peacock;
        $count = 0;
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        
        $data = mysqli_query($db,"SELECT * FROM projects");
        while ($get_data = mysqli_fetch_assoc($data)){
            if ($get_data['projectDraft'] == 'no'){
                $categories = explode(",",$get_data['projectCategory']);
                foreach ($categories as $value){
                    if ($value == $Category){
                        $count = $count + 1;   
                    }
                }
            }
        }
        $db->close();
        return $count;
    }
    
    public function fetchProjectsListOfCategories($id){
        $peacock = new Peacock;
        $query = "SELECT * FROM projects WHERE id='$id'";
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $data = mysqli_query($db,$query);
        $get_data = mysqli_fetch_assoc($data);
        $projectCategories = $get_data['projectCategory'];
        $categories = explode(',',$projectCategories);
        foreach ($categories as $category){
            echo $peacock->getCategory($category);
            echo "&nbsp;&nbsp;<a href='removeCategoryFromProject.php?id=".$id."&category=".$category."' class='pDeleteLinkButton'>Remove</a>";
            echo "<br><br>";
        }
        $db->close();
    }
    
    public function getProjectCategory($id){
        $query = "SELECT * FROM projects WHERE id='$id'";
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        $data = mysqli_query($db,$query);
        $get_data = mysqli_fetch_assoc($data);
        $projectCategories = $get_data['projectCategory'];
        $db->close();
        return $projectCategories;
    }

}




?>