<?php
/**
 * @license Copyright (c) 2014 - 2016, Peacock CMS by Clyde Smets <clyde@peacockcms.com>
 * Peacock CMS is under the GNU - General Public License V3.
 */

  session_start();
  include('initPeacock.php');
	include_once("plugins/SimpleGallery/SimpleGalleryFunctions.php");

  class ManageSimpleGallery extends PeacockUI{

    public function title(){
      return 'Manage Simple Gallery';
    }

    public function content(){
      $Gallery = new SimpleGallery;
      $Peacock = new Peacock;
      $images = $Peacock->fetchImagesArray();
      $displayList = "";
      foreach ($images as $image){
        $checkbox = "";
        if ($Gallery->imageExist($image['image']) == true){
          $checkbox = "<input type='checkbox' name='imagelist[]' value='".$image['image']."' checked>";
        }else{
          $checkbox = "<input type='checkbox' name='imagelist[]' value='".$image['image']."'>";
        }
        $displayList .= '
        <div class="row voffset3">
          <div class="col-md-2">
            '.$checkbox.'
          </div>
          <div class="col-md-10">
            <img src="../view/image/'.$image['image'].'" style="height:80px;width:auto">
          </div>
        </div>
        ';
      }
      $array['content-title'] = "<a href='dashboard.php'><i class='fa fa-arrow-left'></i></a> | Manage Simple Gallery";
      $array['content-body'] = '
        <div class="row">
          <div class="col-md-12">
            Tick Images you wish to have or not have in your gallery.
          </div>
        </div>

        <form action="plugins/SimpleGallery/ManageGallerySubmit.php" method="post">

        '.$displayList.'

        <input type="submit" class="submitBtn voffset3" value="Select Images"/>
        </form>
      ';
      return $array;
    }

  }

  $ManageSimpleGallery = new ManageSimpleGallery;
  echo $ManageSimpleGallery->build();
