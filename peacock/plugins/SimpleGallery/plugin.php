<?php

require("plugins/SimpleGallery/SimpleGalleryFunctions.php");

class SimpleGalleryInit extends Plugin{

	public function query(){
		$sql = "
			CREATE TABLE simpleGallery(

				id INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY(id),
				imageFile VARCHAR(200),
				imageTitle VARCHAR(300),
				hidden VARCHAR(50) DEFAULT 'no',
				imageCategory VARCHAR(100) DEFAULT '1'

			)

		";
		return $sql;
	}

	public function title(){
		return '<i class="fa fa-picture-o"></i> Simple Gallery';
	}

	public function content(){
		$simpleGallery = new SimpleGallery;
		$array = array();
		$array['content-body'] =
			'<div class="pages">'.$simpleGallery->fetchGalleryList().
			'
			</div>
			<div class="linkbar">
				<ul>
					<li><a class="pContentbtn" href="ManageSimpleGallery.php">
					<i class="fa fa-tasks"></i> Manage Gallery
					</a></li>
				</ul>
			</div>
			';
		return $array;
	}

}

$SimpleGalleryPlugin = new SimpleGalleryInit('simpleGallery');
echo $SimpleGalleryPlugin->build();
