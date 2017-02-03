<?php

class UITemplate{

  public static $templateDir = 'templates/';
  private $_build_ready = false;
  private $_file;
  private $_json;

  public function __construct($file){
    $username = $_SESSION['username'];
    $user = new User($username);
    $user->checkUser();
    $get_extension = explode(".",$file);
    $count = count($get_extension);
    $contains_other_extension = false;
    if ($count > 1){
      $index = $count - 1;
      $extension = $get_extension[$index];
      if ($extension == "php"){
        //Has php in the extension
        //Leave it alone
      }else{
        $contains_other_extension = true;
        $file = $file.".php";
      }
    }else{
      $file = $file.".php";
    }
    if (file_exists(self::$templateDir.$file)){

      $this->_file = $file;
      $cleanFilename = str_replace(".php","",$file);
      $json = $cleanFilename.".json";
      if (file_exists(self::$templateDir.$json)){
        $this->_json = $json;
        $this->_build_ready = true;
      }else{
        die('No JSON file found to parent: '.$file);
      }

    }else{
      if($contains_other_extension == true){
        die('$STRING File contains extension other than ".php"');
      }else{
        die('$STRING File location not found!');
      }
    }
  }

  public function build($title, $contents){
    $file = $this->_file;
    $json = $this->_json;
    $dir = self::$templateDir;
    if (file_exists($dir.$file) == true && file_exists($dir.$json) == true){
      $ids = file_get_contents($dir.$json);
      $content_regions = json_decode($ids,true);
      $content = file_get_contents($dir.$file,TRUE);
      $html = str_get_html($content);

      if ($title != null){
        if (gettype($title) != 'string'){
          die('FUNCTION "title()" return is not a STRING');
        }
		// Put in title name if field is supplied
        if (@$html->find('div[id="title"]', 0)->innertext){
          $html->find('div[id="title"]', 0)->innertext = $title;
        }
      }

      if ($contents == null){
        die('FUNCTION "content()" contains no return of ARRAY');
      }
      if (is_array($contents) == false){
        die('FUNCTION "content()": return is not an ARRAY');
      }
      foreach ($content_regions as $region){
        foreach ($contents as $key => $value){
          if ($key == $region){
            $content = $value;
          }
        }
        if ($content){
          $html->find('div[id='.$region.']', 0)->innertext = $content;
        }
      }
    }else{
      die('$STRING File location not found!');
    }
    return $html;
  }

}

 ?>
