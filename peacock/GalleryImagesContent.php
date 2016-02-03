<?php
/**
 * @license Copyright (c) 2014 - 2016, Peacock CMS by Clyde Smets <clyde@peacockcms.com>
 * Peacock CMS is under the GNU - General Public License V3.
 */
  session_start();
  require("initPeacock.php");
  require("plugins/Gallery/GalleryFunctions.php");

	if (!empty($_POST['imagelist']) && !empty($_POST['foldername'])){

		$sqlconnect = new Connectdb;
		$db = $sqlconnect->connectTo();

		$folder = $_POST['foldername'];

		foreach($_POST['imagelist'] as $image){
			mysqli_query($db,"INSERT INTO gallery (imageFile, imageFolder) VALUES ('$image', '$folder')");
		}

		$db->close();

	}else{
		header("location:dashboard.php");
	}

  class GalleryImagesContent extends PeacockUI{

    public function title(){
      return "Gallery Images Content";
    }

    public function content(){
      $Gallery = new Gallery;
      $images = $_POST['imagelist'];
      $list = "";
      foreach ($images as $image){
        $id = $Gallery->getIDFromFileName($image);
        $list .= "
          <div class='row'>
            <div class='col-xs-3'>
              <div class='col-xs-12'>
                Thumbnail
              </div>
              <div clas='col-xs-12'>
                <img src='../view/image/".$image."' height='80'/>
              </div>
            </div>
            <div class='col-xs-9'>
              <div class='row'>
                <div class='col-xs-2'>Title</div>
                <div class='col-xs-10'><input type='text' name='title-".$id."'></div>
              </div>
              <div class='row'>
                <div class='col-xs-12'>
                  Description
                </div>
                <div class='col-xs-12'>
                  <textarea name='desc-".$id."' rows='5'></textarea>
                </div>
              </div>
            </div>
          </div>
          <input type='hidden' name='finalID' value='".$id."'>
        ";
      }

      $array['content-title'] = "";

      $array['content-body'] = "
        <p>Choose if you wish to add a title and description to your image. Otherwise skip.</p>
        <form action='plugins/Gallery/GalleryImagesContentSubmit.php' method='post'>
          $list
          <div class='row voffset3'>
            <div class='col-xs-12'>
              <input class='submitBtn' type='submit' value='Submit'/>  <a href='dashboard.php' class='submitBtn'>Skip</a>
            </div>
          </div>
        </form>
      ";

      return $array;
    }
  }

  $GalleryImagesContent = new GalleryImagesContent;
  echo $GalleryImagesContent->build();

?>
