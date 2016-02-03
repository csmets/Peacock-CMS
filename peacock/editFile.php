<?php
/**
 * @license Copyright (c) 2014 - 2016, Peacock CMS by Clyde Smets <clyde@peacockcms.com>
 * Peacock CMS is under the GNU - General Public License V3.
 */

    session_start();
    include("initPeacock.php");

class EditFile extends PeacockUI{

  public function title(){
    return 'Edit File';
  }

  public function content(){
    $file = $_GET['file'];
    $codeType = $_GET['type'];
    $peacock = new Peacock;
    $content = $peacock->getFileContents($file);

    $array['content-title'] = "<a href='dashboard.php'><i class='fa fa-arrow-left'></i></a> | Edit File: ".$file;
    $array['content-body'] = "

    <div class='row'>
      <div class='col-xs-12'>
        Edit the field below to change the page's code.
      </div>
    </div>

    <div class='row voffset3'>
      <div class='col-xs-12'>
        <div id='code' contenteditable='true'><pre><code><xmp>$content</xmp></code></pre></div>
      </div>
    </div>

    <div class='row voffset3'>
      <div class='col-xs-12'>
        <input type='hidden' id='subType' name='subType' value='editFile'>
        <input type='hidden' id='file' name='file' value='$file'>
        <a class='submitBtn' id='submit'>Update</a>
      </div>
    </div>


    <script>
        $(document).ready(function(){
            $('#submit').click(function(){
                var code = $('#code').text();
                var subType = $('#subType').val();
                var file = $('#file').val();
                $.post('submission.php',{'code' : code,'subType' : subType,'file' : file}, function(data){

                });
            });
        });
    </script>

    ";

    return $array;
  }

}

$EditFile = new EditFile;
echo $EditFile->build();
