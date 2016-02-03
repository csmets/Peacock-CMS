<?php

  abstract class PeacockUI implements GUI{

    private $_file;

    public function __construct($file = null){
      if ($file == null){
        $this->_file = 'default';
      }else{
        $this->_file = $file;
      }
    }

    public function build(){
      $UITemplate = new UITemplate($this->_file);
      $html = $UITemplate->build($this->title(),$this->content());
      $Navigation = new NavBar;
      $navBar = $Navigation->display();
      $Footer = new Footer;
      $footer = $Footer->display();
      $title = $this->title();
      if ($title != null){
        $html = str_replace("<title>","<title>".$title,$html);
      }
      $html = str_replace("<body>","<body>".$navBar,$html);
      $html = str_replace("</body>",$footer."</body>",$html);
      return $html;
    }

    // Requires a STRING to be return with the title name of the page which will also be assigned to
    // the id labeled 'title' in the template.
    public abstract function title();

    // Requires a return of an ARRAY with the contents of what you want displayed in the template
    // according to the id set in the template at in the array key.
    public abstract function content();
  }
