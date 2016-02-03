<?php
/**
 * @license Copyright (c) 2014 - 2016, Peacock CMS by Clyde Smets <clyde@peacockcms.com>
 * Peacock CMS is under the GNU - General Public License V3.
 */
  session_start();
  require("initPeacock.php");
	require("plugins/Gallery/GalleryFunctions.php");

class GalleryRemoveImages extends PeacockUI{
  public function title(){
    return "Gallery Remove Images";
  }

  public function content(){
    $folder = $_GET['folder'];
    $Gallery = new Gallery;
    $images = $Gallery->fetchImageList($folder);
    $list = "
      <div class='row'>
        <div class='col-xs-2'><h4>Select</h4></div>
        <div class='col-xs-10'><h4>Thumbnail</h4></div>
      </div>
    ";
    foreach ($images as $image){
      if ($image['imageFolder'] == $folder){
        $list .= "
          <div class='row voffset3'>
            <div class='col-xs-2'>
              <input type='checkbox' name='imagelist[]' value='".$image['id']."'>
            </div>
            <div class='col-xs-10'>
              <img src='../view/image/".$image['imageFile']."' height='80'>
            </div>
          </div>
        ";
      }
    }
    $array['content-title'] = "<a href='GalleryFolder.php?folder=$folder'><i class='fa fa-arrow-left'></i></a> | Remove Images";
    $array['content-body'] = "
      <p>Tick on the images you wish to remove from the folder.</p>
      <form action='plugins/Gallery/GalleryRemoveImagesSubmit.php' method='post'>
        $list
        <input type='hidden' name='foldername' value='$folder' />
        <input class='submitBtn voffset3' type='submit' value='Remove Selected'>
      </form>
    ";
    return $array;
  }
}

$GalleryRemoveImages = new GalleryRemoveImages;
echo $GalleryRemoveImages->build();
?>
