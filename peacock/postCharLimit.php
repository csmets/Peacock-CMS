<?php
/**
 * @license Copyright (c) 2014 - 2016, Peacock CMS by Clyde Smets <clyde@peacockcms.com>
 * Peacock CMS is under the GNU - General Public License V3.
 */

    session_start();
    include('initPeacock.php');

    class SetCharLimit extends PeacockUI{

      public function title(){
        return "Set Character Limit";
      }
      public function content(){

        $Peacock = new Peacock;
        $postID = $_GET['post'];
        $limit = $Peacock->getPostCharLimit($postID, "postCharLimit.json");

        $postName = $Peacock->getPostName($postID, true);
        $array['content-title'] = "<a href='dashboard.php'><i class='fa fa-arrow-left'></i></a> | Set Character Limit to post: $postName";

        $array['content-body'] = "
          <form action='submission.php' method='post'>
            <div class='row'>
              <div class='col-xs-4'><b>Set limit value</b></div>
              <div class='col-xs-8'><input type='number' value='".$limit."' name='charLimit'></div>
            </div>

            <input type='hidden' name='id' value='$postID'>
            <input type='hidden' name='file' value='postCharLimit.json'>
            <input type='hidden' name='subType' value='setCharLimit'>
            <input class='submitBtn voffset3' type='submit' value='Set'>
          </form>
        ";
        return $array;
      }
    }

    $SetCharLimit = new SetCharLimit;
    echo $SetCharLimit->build();
?>
