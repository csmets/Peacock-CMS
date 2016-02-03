<?php
/**
 * @license Copyright (c) 2014 - 2016, Peacock CMS by Clyde Smets <clyde@peacockcms.com>
 * Peacock CMS is under the GNU - General Public License V3.
 */

    session_start();
    include('initPeacock.php');

    class EditCategory extends PeacockUI{
      public function title(){
        return "Edit Category";
      }
      public function content(){
        $Peacock = new Peacock;
        $categoryName = $_GET['category'];
        $categoryId = $_GET['id'];
        $categoryIcon = $Peacock->getCategoryIcon($categoryId);
        $array['content-title'] = "<a href='dashboard.php'><i class='fa fa-arrow-left'></i></a> | Edit Category: $categoryName";

        if ($categoryIcon == null){
          $image = "none.";
        }else{
          $image = "<img src='../view/image/$categoryIcon' width='100px'>";
        }

        $array['content-body'] = "
          <form action='submission.php' method='post'>
            <div class='row'>
              <div class='col-xs-4'><b>Edit Category Name</b></div>
              <div class='col-xs-8'><input type='text' value='".$categoryName."' name='categoryName'></div>
            </div>

            <div class='row voffset3'>
              <div class='col-md-12'>
              <b>Category Icon</b><br>
                <div class='displayImage'>$image</div>

              </div>
              <div class='col-md-12'>
                <div class='row'>
                  <div class='col-md-2'>
                    Folder
                  </div>
                  <div class='col-md-4'>
                    <select class='imageFolders'></select>
                  </div>
                  <div class='col-md-2'>
                    Images
                  </div>
                  <div class='col-md-4'>
                    <select name='icon' class='imageSelect'></select>
                  </div>
                </div>
              </div>
            </div>

            <input type='hidden' name='id' value='$categoryId'>
            <input type='hidden' name='subType' value='editCategory'>
            <input class='submitBtn voffset3' type='submit' value='Update'>
          </form>
          <script src='js/peacock-image-list.js'></script>
        ";
        return $array;
      }
    }

    $EditCategory = new EditCategory;
    echo $EditCategory->build();
?>
