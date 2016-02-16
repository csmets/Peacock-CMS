<?php
/**
 * @license Copyright (c) 2014 - 2016, Peacock CMS by Clyde Smets <clyde@peacockcms.com>
 * Peacock CMS is under the GNU - General Public License V3.
 */

session_start();
include('initPeacock.php');

class AddToCategory extends PeacockUI{
  public function title(){
    return "Add to category";
  }

  public function content(){

    $postID = $_GET['post'];

    $Peacock = new Peacock;
    $postName = $Peacock->getPostName($postID);

    $array['content-title'] = "<a href='dashboard.php'><i class='fa fa-arrow-left'></i></a> | Add '$postName' to category";

    $list = "";
    $listOfCategories = $Peacock->fetchCategories();

    foreach($listOfCategories as $category){
      $list .= "<option value='".$category['id']."'>".$category['name']."</option>";
    }

    $array['content-body'] = "
      <div class='row'>
        <div class='col-md-4'>Add to category:</div>
        <div class='col-md-8'>
          <form action='submission.php' method='POST'>
            <select name='category'>
              $list
            </select>
            <input type='hidden' name='subType' value='addToCategory'>
            <input type='hidden' name='id' value='".$postID."'>
            <input type='submit' class='submitBtn' value='ADD' />
          </form>
        </div>
      </div>
    ";

    return $array;
  }
}

$AddToCategory = new AddToCategory;
echo $AddToCategory->build();

?>
