<?php

class BlogPagination {
    
    public $limit = 10;
    public $page = 1;
    
    public function __construct($pageNum, $postLimit){
        $this->limit = $postLimit;
        $this->page = $pageNum;
    }
    
    public function getPosts (){
        
        $posts = array();
        
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();

        $totalPages = $this->getTotalPages();
        
        if ($this->page == 1){
            $row = 0;   
        }else{
           $row = ($this->page * $this->limit) - ($this->limit); 
        }
        
        $postQuery = "SELECT * FROM blog ORDER BY id DESC LIMIT ".$row.",".$this->limit;
        $sql = mysqli_query($db,$postQuery);
        
        while($get_data = mysqli_fetch_assoc($sql)){
            $posts[] = $get_data['id'];   
        }
        
        return $posts;
    }
    
    public function getTotalPages (){
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        
        $query = mysqli_query($db,"SELECT * FROM blog");
        $totalEntries = mysqli_num_rows($query);
        $totalPages = ceil($totalEntries / $this->limit);
        return $totalPages;
    }
    
    public function getCategoryPosts ($category){
        $posts = array();
        
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();

        $totalPages = $this->getTotalCategoryPages($category);
        
        if ($this->page == 1){
            $row = 0;   
        }else{
           $row = ($this->page * $this->limit) - ($this->limit); 
        }
        
        $postQuery = "SELECT * FROM blog ORDER BY id DESC LIMIT ".$row.",".$this->limit;
        $sql = mysqli_query($db,$postQuery);
        
        while($get_data = mysqli_fetch_assoc($sql)){
            if ($category == $get_data['category']){
                $posts[] = $get_data['id'];   
            }
        }
        
        return $posts;
    }
    
    public function getTotalCategoryPages ($category){
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();
        
        $query = mysqli_query($db,"SELECT * FROM blog");
        $totalEntries = 0;
        while ($get_data = mysqli_fetch_assoc($query)){
            if ($get_data['category'] == $category){
                $totalEntries = $totalEntries + 1;
            }
        }       
        
        $totalPages = ceil($totalEntries / $this->limit);
        return $totalPages;
    }
    
}

?>