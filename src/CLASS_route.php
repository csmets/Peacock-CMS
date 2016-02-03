<?php
/**
 * @license Copyright (c) 2014 - 2016, Peacock CMS by Clyde Smets <clyde@peacockcms.com>
 * Peacock CMS is under the GNU - General Public License V3.
 */


	class Route {

        public $configLoaded = false;

        public function __construct(){
            $this->loadConfig();
            if ($this->configLoaded == true){
                $this->load();
            }
        }

        public function loadConfig(){
						$configPath = "config/config.php";
						if ($this->checkConfig($configPath) == true){
							include($configPath);
							$this->configLoaded = true;
						}else{
							echo "Config File Not Found!";
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
                $url = "index";
            }

						//Split url to find Route
						$splitURL = explode("/",$url);

						//Load route
						$routePath = "routes/".$splitURL[0].".php";
						if (file_exists($routePath) == true){
							include($routePath);
							$routeTo = new RouteTo();
							$routeTo->destination($url);
						}else{
							header("location:404.php");
						}
        }

	}

?>
