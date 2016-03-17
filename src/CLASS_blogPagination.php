<?php

class BlogPagination {

    public $limit = 10;
    public $page = 1;

    public function __construct($pageNum, $postLimit){
        $this->limit = $postLimit;
        $this->page = $pageNum;
    }

    public function getPosts ($displayDraft = false){

        $posts = array();

        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();

        $totalPages = $this->getTotalPages();

        if ($this->page == 1){
            $row = 0;
        }else{
           $row = ($this->page * $this->limit) - ($this->limit);
        }
        $postQuery = "SELECT * FROM blog ORDER BY id DESC";
        $sql = mysqli_query($db,$postQuery);

        $counter = 0;
        $countLimit = 0;
        while($get_data = mysqli_fetch_assoc($sql)){
          if ($get_data['draft'] == 'no' && $get_data['status'] != 'hidden'){
            if ($counter >= $row){
              if ($countLimit < $this->limit){
                $posts[] = $get_data['id'];
                $countLimit++;
              }
            }
            $counter++;
          }
        }

        return $posts;
    }

    public function getTotalPages ($displayDraft = false){
        $sqlconnect = new Connectdb;
        $db = $sqlconnect->connectTo();

        $query = mysqli_query($db,"SELECT * FROM blog");
        if ($displayDraft == false){
          $totalEntries = 0;
          while ($entries = mysqli_fetch_assoc($query)){
            if ($entries['draft'] == 'no' && $entries['status'] != 'hidden'){
              $totalEntries++;
            }
          }
        }else{
          $totalEntries = mysqli_num_rows($query);
        }

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
