<?php
/**
 * @license Copyright (c) 2014 - 2016, Peacock CMS by Clyde Smets <clyde@peacockcms.com>
 * Peacock CMS is under the GNU - General Public License V3.
 */

session_start();
require("initPeacock.php");
require("plugins/Gallery/GalleryFunctions.php");

class GalleryEditImage extends PeacockUI
{

  public function title(){
    return "Gallery Edit Image";
  }

  public function content(){
    $folder = $_GET['folder'];
    $image = $_GET['id'];
    $array['content-title'] = "<a href='GalleryFolder.php?folder=$folder'><i class='fa fa-arrow-left'></i></a> | Edit Image";
    $gallery = new Gallery;
    $image = $gallery->fetchImage($image);
    $id = $image['id'];
    $name = $image['imageTitle'];
    $file = $image['imageFile'];
    $imageDesc = $image['imageDesc'];
    $array['content-body'] = "
      <p>Edit image content or Remove the image from the gallery.</p>
      <form action='plugins/Gallery/GalleryEditImageSubmit.php' method='post'>
        <img src='/view/image/$file' width='200px'>
        <br><br><p>Title:<br><input type='text' name='title' value='$name'></p>
        <p>Description:<br><textarea name='desc' class='ptextbox' rows='5'>$imageDesc</textarea></p>
        <input type='hidden' name='id' value='".$id."'>
        <input class='submitBtn' type='submit' value='Update'>
      </form>
    ";

    return $array;
  }

}

$GalleryEditImage = new GalleryEditImage;
echo $GalleryEditImage->build();

?>
