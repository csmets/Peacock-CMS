<?php
/**
 * @license Copyright (c) 2014 - 2016, Peacock CMS by Clyde Smets <clyde@peacockcms.com>
 * Peacock CMS is under the GNU - General Public License V3.
 */


	class PageAnalytics
	{
		function __construct(){
			
		}
		
		function addCount($table, $id){
			$sqlconnect = new Connectdb;
        	$db = $sqlconnect->connectTo();
			
			$getPage = "SELECT * FROM $table WHERE id='$id'";
        	$data = mysqli_query($db,$getPage);
        	$Retrieve = mysqli_fetch_array($data);
			
			$viewcount = $Retrieve['views'] + 1;
			
			$updatePageViews = "UPDATE $table SET views=$viewcount WHERE id='$id'";
			mysqli_query($db,$updatePageViews);
			$db->close();
		}
		
		function getViews ($table, $id){
			$sqlconnect = new Connectdb;
        	$db = $sqlconnect->connectTo();
			
			$getPage = "SELECT * FROM $table WHERE id='$id'";
        	$data = mysqli_query($db,$getPage);
        	$retrieve = mysqli_fetch_array($data);
			
			$viewcount = $retrieve['views'];
			
			return $viewcount;
		}
	}

?>