<?php
/**
 * @license Copyright (c) 2014 - 2016, Peacock CMS by Clyde Smets <clyde@peacockcms.com>
 * Peacock CMS is under the GNU - General Public License V3.
 */

    session_start();
    include('initPeacock.php');

    class DeletePageConfirmation extends PeacockUI{

      public function title(){
        return 'Delete Page Confirmation';
      }

      public function content(){
        $pageid = $_GET['id'];
        $pagename = $_GET['page'];
        $array = array();
        $array['content-title'] = "<a href='dashboard.php'><i class='fa fa-arrow-left'></i></a> | Delete Page";
        $array['content-body'] = "<p class='pbodyTxt'>Are you sure you want to delete <b>"
        . $pagename . "?</b></p><br><a class='submitBtn' href='deletePageSubmission.php?id=$pageid'
        class='pLinkTxt'>DELETE</a>";
        return $array;
      }

    }
    $UI = new DeletePageConfirmation();
    echo $UI->build();
?>
