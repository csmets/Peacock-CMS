<?php
/**
 * @license Copyright (c) 2014 - 2016, Peacock CMS by Clyde Smets <clyde@peacockcms.com>
 * Peacock CMS is under the GNU - General Public License V3.
 */

session_start();
include("initPeacock.php");

class DefaultEditPage extends PeacockUI{

  public function title(){
    return "Edit Page";
  }

  public function content(){
    $pageID = $_GET['id'];
    $Peacock = new Peacock;
    $pageName = $Peacock->getPageName($pageID);
    $pageContent = $Peacock->getPageContent($pageID);
    $array = array();
    $array['content-title'] = "<a href='dashboard.php'><i class='fa fa-arrow-left'></i></a> | Edit Page";
    $array['content-body'] = "

      <form id='pageForm' action='submission.php' method='post'>
        <div class='row'>
          <div class='col-md-12'>Edit the fields below to make changes to the page.</div>
        </div>
        <div class='row voffset3'>
          <div class='col-md-3'>Page name</div>
          <div class='col-md-9'><input type='text' name='pagename' value='$pageName'/></div>
        </div>
        <div class='row voffset3'>
          <div class='col-xs-12'>Page Content</div>
          <div class='col-xs-12'>
            <div class='inlineEditorField'><div class='Editable' id='SaveContent'>$pageContent</div></div>
          </div>
        </div>
        <div class='row voffset3'>
          <div class='col-xs-12'>
            <input type='hidden' name='pagecontent' id='pagecontent'>
            <input type='hidden' name='id' value='$pageID'>
            <input type='hidden' name='subType' value='defaultEditPage'>
            <input type='hidden' name='draft' value='no'>
            <input type='button' id='submitPage' class='submitBtn' value='Submit'>
          </div>
        </div>
      </form>

      <script src='js/peacock-inline-editor.js'></script>
      <script>
          $(document).ready(function(){
              var inlineEditor = new init_Peacock_InlineEditor();
              inlineEditor.run();
          });

          $('#submitPage').click(function(){
            var removeEditor = new init_Peacock_InlineEditor();
            removeEditor.removeEditors();
            $('#pagecontent').val($('#SaveContent').html());
            $('#pageForm').submit();
          });
      </script>
    ";

    return $array;
  }

}

$DefaultEditPage = new DefaultEditPage;
echo $DefaultEditPage->build();

?>
