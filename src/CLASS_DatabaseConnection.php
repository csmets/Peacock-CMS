<?php

  /**
   * Sets up a connection to the data and retrieve data through a query.
   */
  class DatabaseConnection
  {

    private $_results;
    public $last_id_used;

    public function query($string){
      $sqlconnect = new Connectdb;
      $db = $sqlconnect->connectTo();
      $data = mysqli_query($db,$string);
      if (!$data){
        die ('Invalid query: '.mysqli_error());
      }
      $this->_last_id_used = $db->insert_id;
      $db->close();
      return $data;
    }

    public function fetch($query, $limit = 0){
      $data = $this->query($query);
      $rows = mysqli_num_rows($data);
      $results = null;
      if($limit >= 1 && $rows > 1){
        $results = array();
        $count = 0;
        while($fetch = mysqli_fetch_assoc($data)){
          if ($count < $limit){
            $results[] = $fetch;
            $count++;
          }
        }
      }
      elseif ($rows > 1 || $limit == 0){
        $results = array();
        while($fetch = mysqli_fetch_assoc($data)){
          $results[] = $fetch;
        }
      }
      else{
        $results = mysqli_fetch_assoc($data);
      }
      $this->_results;
      return $results;
    }

    public function is_multidim_array() {
      $arr = $this->_results;
      if (!is_array($arr))
        return false;
      foreach ($arr as $elm) {
        if (!is_array($elm))
          return false;
      }
      return true;
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

  }
