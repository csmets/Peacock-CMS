<?php
/**
 * @license Copyright (c) 2014 - 2016, Peacock CMS by Clyde Smets <clyde@peacockcms.com>
 * Peacock CMS is under the GNU - General Public License V3.
 */
    session_start();
    include('initPeacock.php');

class DeletePostConfirm extends PeacockUI{

  public function title(){
    return 'Delete Post Confirmation';
  }

  public function content(){
    $postid = $_GET['id'];
    $postname = $_GET['post'];

    $array = array();
    $array['content-title'] = "<a href='dashboard.php'><i class='fa fa-arrow-left'></i></a> | Delete Page";
    $array['content-body'] = "<p class='pbodyTxt'>Are you sure you want to delete <b>"
    . $postname . "?</b></p><br><a class='submitBtn' href='deletePostSubmission.php?id=$postid'
    class='pLinkTxt'>DELETE</a>";

    return $array;
  }

}

$DeletePost = new DeletePostConfirm;
echo $DeletePost->build();
