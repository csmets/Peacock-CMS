<?php
/**
 * @license Copyright (c) 2014 - 2016, Peacock CMS by Clyde Smets <clyde@peacockcms.com>
 * Peacock CMS is under the GNU - General Public License V3.
 */
    session_start();
    include("initPeacock.php");

    class SetGroupPageLink extends PeacockUI{

      public function title(){
        return "Set Group Page Link";
      }

      public function content(){
        $grpID = $_GET['grp'];
        $Peacock = new Peacock;
        $existingLink = $Peacock->getPageData($grpID,'additional');
        $textfield = "";
        if ($existingLink == null){
          $textfield = '<input type="text" name="url" placeholder="insert URL here"/>';
        }else{
          $textfield = '<input type="text" name="url" value="'.$existingLink.'"/>';
        }
        $array['content-title'] = "<a href='dashboard.php'><i class='fa fa-arrow-left'></i></a> | Set Group Page Link";
        $array['content-body'] = "
          <p>Insert the link below you wish to point the group page to.</p>
          <form action='submission.php' method='post' >

          <div class='row'>
            <div class='col-xs-5'>
              $textfield
            </div>
            <div class='col-xs-7'>
              <input type='hidden' name='subType' value='groupLink' />
              <input type='hidden' name='grpID' value='$grpID' />

              <input class='submitBtn' type='submit' value='Make Link' />
            </div>
          </div>
          </form>
        ";
        return $array;
      }

    }

    $SetGroupPageLink = new SetGroupPageLink;
    echo $SetGroupPageLink->build();
