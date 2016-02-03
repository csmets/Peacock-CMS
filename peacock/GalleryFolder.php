<?php
/**
 * @license Copyright (c) 2014 - 2016, Peacock CMS by Clyde Smets <clyde@peacockcms.com>
 * Peacock CMS is under the GNU - General Public License V3.
 */

session_start();
require('initPeacock.php');
require('plugins/Gallery/GalleryFunctions.php');

class GalleryFolder extends PeacockUI{

  public function title(){
    $folderName = $_GET['folder'];
    return "Gallery Folder | Manage ".$folderName;
  }

  public function content(){
    $folderName = $_GET['folder'];
    $gallery = new Gallery;
    $images = $gallery->fetchImageList($folderName);
    $imageList = "";
    foreach ($images as $image){
      $imageList .= "
        <a href='GalleryEditImage.php?id=".$image['id']."&folder=$folderName'><ul><li><img src='/view/image/".$image['imageFile']."'></li><li>".$image['imageFile']."</li></ul></a>
      ";
    }
    $array['content-title'] = "<a href='dashboard.php'><i class='fa fa-arrow-left'></i></a> | Manage ".$folderName;
    $array['content-body'] = "
      <div class='linkbar'>
        <ul>
          <a href='GalleryAddImages.php?folder=$folderName'><li><i class='fa fa-folder-open-o'></i> Add Images</li></a>
          <a href='GalleryRemoveImages.php?folder=$folderName'><li><i class='fa fa-trash-o'></i> Remove Images</li></a>
          <li id='arrangeimagesbtn'><i class='fa fa-random'></i> Arrange Images</li>
        </ul>
      </div>


      <div class='row'>
        <div class='col-xs-12'>
          List of images in the $folderName folder
        </div>
      </div>

      <div class='FolderList'>
        $imageList
      </div>
    ";
    return $array;
  }

}

$GalleryFolder = new GalleryFolder;
echo $GalleryFolder->build();

include_once("plugins/Gallery/GalleryArrangeImages.php");
 ?>
