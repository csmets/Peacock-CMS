<?php
/**
 * @license Copyright (c) 2015, Peacock CMS - Clyde Smets. All rights reserved.
 * For licensing, see EULA.rtf
 */


	class Route {
        
        public $configLoaded = false;
        public $protect = array();
        private $protectedFiles = array(
            "CreatePage.php",
            "CreatePost.php",
            "EditPage.php",
            "EditPost.php"
        );
        
        public function __construct(){
            $this->loadConfig();
            if ($this->configLoaded == true){
                $this->load();
            }
        }

        public function loadConfig(){
            preg_match("/\/\w+\//",$_SERVER['REQUEST_URI'],$matches);
            if ($matches[0] == null){
                $configPath = "view/config/config.php";
                if ($this->checkConfig($configPath) == true){
                    include($configPath);
                    $this->configLoaded = true;
                }else{
                    echo "Config File Not Found!";   
                }
            }else{
                $configPath = "view/".$matches[0]."/config/config.php";
                if ($this->checkConfig($configPath) == true){
                    include($configPath);
                    $this->configLoaded = true;
                }else{
                    echo "Config File Not Found!";   
                }
            }
        }
        
        private function checkConfig($path){
            if (file_exists($path)){
                return true;
            }else{
                return false;
            }
        }
        
        private function load(){
            $peacock = new Peacock;
            //URL
            $url = $_GET['url'];
            if ($url == null){
                $url = "index.php";   
            }
            //Get Folder
            preg_match("/.+\//",$url,$matches);
            //Get Filename
            $filename = str_replace($matches[0],"",$url);
            //Get Variables
            $variables = $_SERVER['REQUEST_URI'];
            $variables = str_replace($matches[0],"",$variables);
            $variables =  substr($variables,1);
            if ($matches[0] == null){
                $Theme = $peacock->getSiteTheme();
                $sitePath = "view/themes/".$Theme."/".$filename;
                if (file_exists($sitePath)){
                    if ($this->isProtected($filename) == true){
                        $username = $_SESSION['username'];
                        $peacock->checkUser($username);
                        include($sitePath);
                    }else{
                        include($sitePath);
                    }
                }else{
                    header("location:404.php");
                }
            }else{
                $Theme = $peacock->getSiteTheme();
                $sitePath = "view/".$matches[0]."themes/".$Theme."/".$filename;
                if (file_exists($sitePath)){
                    if ($this->isProtected($filename) == true){
                        $username = $_SESSION['username'];
                        $peacock->checkUser($username);
                        include($sitePath);
                    }else{
                        include($sitePath);
                    }
                }else{
                    header("location:404.php");
                }
            }
        }
        
        private function isProtected($filename){
            $protected = array_merge($this->protectedFiles, $this->protect);
            $result;
            foreach ($protected as $file){
                if ($file == $filename){
                    $result = true;
                    break;
                }else{
                    $result = false; 
                }
            }
            return $result;
        }
        
	}

?>