<?php
/**
 * @license Copyright (c) 2015, Peacock CMS - Clyde Smets. All rights reserved.
 * For licensing, see EULA.rtf
 */

	class Search
	{
		
		public $table = "blog";
		public $data_1 = "posttitle";
		public $data_2 = "postcontent";
		public $data_3 = "id";
		public $useBtn = false;
		public $linkTo = "blogPost.php?id=";
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

				$result = $this->searchThroughTitles($query);//Look for relevant titles to search first.
				$result .= $this->searchHashTags($query); // Then look for hash tag results.
				
				if ($result != null){
					return $result;
				}else{
					return "No Search Results Found";
				}

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

                $result = "";

                $peacock = new Peacock;

                while ($get_data = mysqli_fetch_assoc($data)){

                    if ($showDrafts == false){

                        if($get_data['draft'] == 'no'){

                            $StripTags = strip_tags($get_data[$this->data_2 ]);	
                            $LimitBody = $peacock->removeHashTags(substr($StripTags, 0, 300));

                            $StripTitle = strip_tags($get_data[$this->data_1]);

                            if ($this->useBtn == false){
                                if ($this->linkTo != null){
                                    $result .= "<a href='$this->linkTo".$get_data[$this->data_3]."'>
                                        <ul><li><h1>".$StripTitle."</h1></li>
                                            <li>".$LimitBody."...</li></ul>
                                        </a>";
                                }else{
                                    $result .= "<ul><li><h1>".$StripTitle."</h1>/li><li>".$LimitBody."...</li></ul>";
                                }
                            }
                            else{
                                if ($this->linkTo != null){
                                    $result .= "<ul><li><h1>".$StripTitle."</h1></li><li>".$LimitBody."...</li></ul>";
                                }else{
                                    $result .= "<ul><li><h1>".$StripTitle."</h1></li><li>".$LimitBody."...</li></ul>";
                                }
                            }

                            $this->foundResults[$get_data[$this->data_3]] = 'found';

                        }

                    }
                    elseif ($showDrafts == true){
                        $StripTags = strip_tags($get_data[$this->data_2 ]);	
                        $LimitBody = $peacock->removeHashTags(substr($StripTags, 0, 300));

                        $StripTitle = strip_tags($get_data[$this->data_1]);

                        if ($this->useBtn == false){
                            if ($this->linkTo != null){
                                $result .= "<a href='$this->linkTo".$get_data[$this->data_3]."'>
                                    <ul><li><h1>".$StripTitle."</h1></li>
                                        <li>".$LimitBody."...</li></ul>
                                    </a>";
                            }else{
                                $result .= "<ul><li><h1>".$StripTitle."</h1>/li><li>".$LimitBody."...</li></ul>";
                            }
                        }
                        else{
                            if ($this->linkTo != null){
                                $result .= "<ul><li><h1>".$StripTitle."</h1></li><li>".$LimitBody."...</li></ul>";
                            }else{
                                $result .= "<ul><li><h1>".$StripTitle."</h1></li><li>".$LimitBody."...</li></ul>";
                            }
                        }

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

	    	$result = "";

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

								$StripTags = strip_tags($peacock->getPostContent($ID, false));	
								$LimitBody = $peacock->removeHashTags(substr($StripTags, 0, 300));

								$title = $peacock->getPostName($ID, true);
								
								if ($this->useBtn == false){
									if ($this->linkTo != null){
										$result .= "<a href='$this->linkTo".$ID."'>
											<ul><li><h1>".$title."</h1></li>
												<li>".$LimitBody."...</li></ul>
											</a>";
									}else{
										$result .= "<ul><li><h1>".$title."</h1>/li><li>".$LimitBody."...</li></ul>";
									}
								}
								else{
									if ($this->linkTo != null){
										$result .= "<ul><li><h1>".$title."</h1></li><li>".$LimitBody."...</li></ul>";
									}else{
										$result .= "<ul><li><h1>".$title."</h1></li><li>".$LimitBody."...</li></ul>";
									}
								}

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