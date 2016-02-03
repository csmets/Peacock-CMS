<?php
/**
 * @license Copyright (c) 2014 - 2016, Peacock CMS by Clyde Smets <clyde@peacockcms.com>
 * Peacock CMS is under the GNU - General Public License V3.
 */

	class Search
	{
		
		public $table = "blog";
		public $data_1 = "posttitle";
		public $data_2 = "postcontent";
		public $data_3 = "id";
		public $showDrafts = false;
		private $foundResults = array();
        public $searchMaxChar = 2;
        
        /*
        public $searchPageLimit = 10;
        private $resultCount = 0;
        public $pageURL = "Search.php";
        private $peacock = new Peacock;
        private $searchStartID = $peacock->getLastPostID();
		*/
		function __construct(){
			
		}
		
		public function searchForResult ($query, $id = null){
	
			if ($query != null){
                /*
                if ($id != null){
                    $this->searchStartID = $id;
                }
                */
				$query = strtolower($query);

				$result_titles = array();
                $result_tags = array();

				$result_titles = $this->searchThroughTitles($query);//Look for relevant titles to search first.
				$result_tags = $this->searchHashTags($query); // Then look for hash tag results.
                
                $result = array_merge($result_titles, $result_tags);
				
				return $result;
			}
			else{
				//Direct to search page with no results.
			}
	
		}

		private function searchThroughTitles($query){
            $searchlen = strlen($query); 
            if($searchlen > $this->searchMaxChar){
            
                $sqlconnect = new Connectdb;
                $db = $sqlconnect->connectTo();
                $sql = "SELECT * FROM ".$this->table." WHERE posttitle LIKE '%".$query."%'";
                $data = mysqli_query($db,$sql);

                $result = array();

                $peacock = new Peacock;

                while ($get_data = mysqli_fetch_assoc($data)){

                    if ($showDrafts == false){

                        if($get_data['draft'] == 'no'){

                            $result[$get_data['id']] = $get_data['id'];

                            $this->foundResults[$get_data[$this->data_3]] = 'found';

                        }

                    }
                    elseif ($showDrafts == true){
                        
                        $result[$get_data['id']] = $get_data['id'];

                        $this->foundResults[$get_data[$this->data_3]] = 'found';
                    }
                    else{
                        echo "Bool value not given to variable showDrafts";
                        break;
                    }
                }
			}
			
			return $result;
		}

		private function searchHashTags ($query){

			$keywords = explode(" ",$query);

			$peacock = new Peacock;

			$sqlconnect = new Connectdb;
	    	$db = $sqlconnect->connectTo();
	    	$sql = "SELECT * FROM ".$this->table;
	    	$data = mysqli_query($db,$sql);

	    	$GatherTags = array();

	    	$result = array();

	    	while ($get_data = mysqli_fetch_assoc($data)){

				preg_match_all("/(#\w+)/", $get_data[$this->data_2], $matches);
				foreach ($matches[0] as $tag){
					//store tags with post id in array
					$tag = substr($tag,1);
					$tag = strtolower($tag);
					$GatherTags[$tag][] = $get_data[$this->data_3];
				}

			}

			foreach ($keywords as $keyword){

				foreach ($GatherTags as $tag => $key){

					for ($i = 0; $i < sizeof($key); $i++){

						$tagResults = $key[$i];

						if ($keyword == $tag){

							if (@$this->foundResults[$tagResults] != 'found' || @$this->foundResults[$tagResults] != null){

								$ID = $tagResults;

								$result[$get_data['id']] = $ID;

								$this->foundResults[$ID] = 'found';
							}

						}
					}

				}
			}

			return $result;

		}
		
		
		public function searchForResultCount ($query){
		
			if ($query != null){
				
				$sqlconnect = new Connectdb;
		    	$db = $sqlconnect->connectTo();
				$sql = "SELECT * FROM blog WHERE posttitle LIKE '%".$query."%'";
				$data = mysqli_query($db,$sql);
				
				$count = 0;
	
				while ($get_data = mysqli_fetch_assoc($data)){
						
					if ($get_data['posttitle'] != null){
						$count++;
					}
					
				}
				
				return $count;

			}
			else{
				//Direct to search page with no results.
			}
	
		}
	}

?>