<?php
/**
 * @license Copyright (c) 2014 - 2016, Peacock CMS by Clyde Smets <clyde@peacockcms.com>
 * Peacock CMS is under the GNU - General Public License V3.
 */

session_start();
require("initPeacock.php");
require("plugins/Gallery/GalleryFunctions.php");

class GalleryAddImages extends PeacockUI{
  public function title(){
    return "Gallery Add Images";
  }
  public function content(){
    $folder = $_GET['folder'];
    $Peacock = new Peacock;
    $images = $Peacock->fetchImagesArray();
    $Gallery = new Gallery;
    $list = "";
    foreach ($images as $image){
      if ($Gallery->imageExist($image['image']) == false){
        $list .= "
          <div class='row voffset3'>
            <div class='col-md-2'><input type='checkbox' name='imagelist[]' value='".$image['image']."'></div>
            <div class='col-md-4'><img src='../view/image/".$image['image']."' width='80px'/></div>
            <div class='col-md-6'>".$image['image']."</div>
          </div>
        ";
      }
    }

    $array['content-title'] = "<a href='GalleryFolder.php?folder=$folder'><i class='fa fa-arrow-left'></i></a> | Add Images";
    $array['content-body'] = "
      <p>Tick the images you wish to have or not have in your gallery.</p>
      <form action='GalleryImagesContent.php' method='post'>
      <div class='row'>
        <div class='col-md-2'><h4>Select</h4></div>
        <div class='col-md-4'><h4>Thumbnail</h4></div>
        <div class='col-md-6'><h4>Image name</h4></div>
      </div>
      $list
      <input type='hidden' name='foldername' value='$folder'>
      <input class='submitBtn voffset3' type='submit' value='Submit'>
      </form>
    ";
    return $array;
  }
}

$GalleryAddImages = new GalleryAddImages;
echo $GalleryAddImages->build();
?>
