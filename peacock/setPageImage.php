<?php
/**
 * @license Copyright (c) 2014 - 2016, Peacock CMS by Clyde Smets <clyde@peacockcms.com>
 * Peacock CMS is under the GNU - General Public License V3.
 */

    session_start();
    include('initPeacock.php');

class SetPageImage extends PeacockUI{

  public function title(){
    return "Set Page Image";
  }

  public function content(){

    $Peacock = new Peacock;

    $PageID = $_GET['id'];
    $pageImage = $Peacock->getPageImage($PageID);

    if (!$pageImage){
      $pageImage = "none.";
    }else{
      $pageImage = "<img src='../view/image/$pageImage' />";
    }

    $array['content-title'] = "<a href='dashboard.php'><i class='fa fa-arrow-left'></i></a> | Set Page Image";
    $array['content-body'] = "
    <form action='submission.php' method='post'>
    <div class='row'>
      <div class='col-md-4'>
        Current Image
      </div>
      <div class='col-md-8'>
        <div class='displayImage'>
        $pageImage
        </div>
      </div>
    </div>


    <div class='row voffset3'>
      <div class='col-md-4'>
        Choose Image
      </div>
      <div class='col-md-8'>
        Folder: <select class='imageFolders'></select> Image: <select name='pageimage' class='imageSelect'></select>
      </div>
    </div>

    <div class='row voffset3'>
      <div class='col-xs-12 text-right'>
        <input type='hidden' name='id' value='$PageID'>
        <input type='hidden' name='subType' value='setPageImage'>
        <input class='submitBtn' type='submit' value='Set Page Image'>
      </div>
    </div>
    </form>
    <script src='js/peacock-image-list.js'></script>
    ";

    return $array;
  }

}


$SetPageImage = new SetPageImage;
echo $SetPageImage->build();
