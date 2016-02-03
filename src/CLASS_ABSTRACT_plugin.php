<?php


abstract class Plugin implements GUI{

  public abstract function title();
  public abstract function content();
  public abstract function query();
  private $_pluginPanelTemplate;
  private $_pluginName;
  protected $DatabaseConnection;

  public function __construct ($name){
    $this->_pluginPanelTemplate = $file;
    if (gettype($name) == 'array'){
      foreach($name as $array_item){
        $this->_pluginName[] = $array_item;
      }
    }else{
      $this->_pluginName = $name;
    }
    $this->DatabaseConnection = new DatabaseConnection;
  }

  private function buildDatabase($name){
    if ($this->DatabaseConnection->tableExist($name) == false){
      $query = $this->query();
      if (gettype($query) == 'array'){
        $create = $this->DatabaseConnection->query($query[$name]);
      }else{
        $create = $this->DatabaseConnection->query($query);
      }
      if ($create !== true){
        die($name.': Is invalid query!');
      }
    }
  }

  public function build(){
    if (gettype($this->_pluginName) == 'array'){
      foreach($this->_pluginName as $array_item){
        $this->buildDatabase($array_item);
      }
    }else{
      $this->buildDatabase($this->_pluginName);
    }

    $Panel = new UITemplate('pluginPanel');
    $title = "<h1>".$this->title()."</h1>";
    $html = $Panel->build($title,$this->content());
    $html = str_replace("{{panel-name}}",$this->_pluginName,$html);
    $html = str_replace("{{panel-toggle-header}}",$this->_pluginName."Header",$html);
    $html = str_replace("{{panel-toggle-content}}",$this->_pluginName."Content",$html);
    return $html;
  }

}

 ?>
