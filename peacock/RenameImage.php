<?php
/**
 * @license Copyright (c) 2014 - 2016, Peacock CMS by Clyde Smets <clyde@peacockcms.com>
 * Peacock CMS is under the GNU - General Public License V3.
 */

    session_start();
    include('initPeacock.php');

class RenameImage extends PeacockUI{

  public function title(){
    return "Rename image";
  }

  public function content(){
    @$ImageFile = $_GET['file'];
    @$ImageID = $_GET['id'];
	  @$ImageFolder = $_GET['folder'];

    $peacock = new Peacock;

    $array['content-title'] = "<a href='dashboard.php'><i class='fa fa-arrow-left'></i></a> | Rename Image";
    $array['content-body'] = "
      <form action='submission.php' method='post'>
      <div class='row'>
        <div class='col-md-3'>
          <img src='../view/image/$ImageFile' width='100%' />
        </div>
        <div class='col-md-9'>
          <div class='row'>
            <div class='col-md-2'>
              Rename:
            </div>
            <div class='col-md-10'>
              <input size='60' type='text' name='ImageName' value='".$peacock->getImageName($ImageID)."'>
            </div>
            <div class='col-xs-12 voffset3'>
              <input type='hidden' name='id' value='$ImageID'>
              <input type='hidden' name='subType' value='renameImage'>
              <input type='hidden' name='folder' value='$ImageFolder'>
              <input class='submitBtn' type='submit' value='Rename'>
            </div>
          </div>
        </div>
        </form>
      </div>
    ";
    return $array;
  }

}

$RenameImage = new RenameImage;
echo $RenameImage->build();


 ?>
