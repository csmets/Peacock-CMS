<?php
/**
 * @license Copyright (c) 2014 - 2016, Peacock CMS by Clyde Smets <clyde@peacockcms.com>
 * Peacock CMS is under the GNU - General Public License V3.
 */

 session_start();
 include("initPeacock.php");

 class EditPageSource extends PeacockUI{

   public function title(){
     return 'Edit Template Source';
   }

   public function content(){
     $id = $_GET['id'];
     $Peacock = new Peacock;
     $content = $Peacock->getTemplateContent($id);
     $name = $Peacock->getTemplateName($id);
     $array['content-title'] = "<a href='dashboard.php'><i class='fa fa-arrow-left'></i></a> | Edit Template Source";
     $array['content-body'] = "
      <script src='js/tidyCode.js'></script>
      <div class='row'>
        <div class='col-xs-4'>
          Change template name:
        </div>
        <div class='col-xs-8'>
          <input type='text' id='templateName' value='$name'/>
        </div>
      </div>

      <div class='row'>
        <div class='col-xs-12'>
          Edit the field below to change the page's code.
        </div>
      </div>

      <div class='row voffset3'>
        <div class='col-xs-12'>
          <div id='code' contenteditable='true' onpaste='OnPaste_StripFormatting(this, event);'></div>
        </div>
      </div>

      <div class='row voffset3'>
        <div class='col-xs-12'>
          <input type='hidden' id='subType' name='subType' value='editTemplate'>
          <input type='hidden' id='id' name='id' value='$id'>
          <a class='submitBtn' id='submit'>Save</a>
        </div>
      </div>

      <div id='dirtyCode' style='display:none'>$content</div>


      <script>
          $(document).ready(function(){

              var runOnce = false;

              if (runOnce == false){
                  tidyCode($('#dirtyCode').html());
                  runOnce = true;
              }

              $('#submit').click(function(){

                  var code = $('#code').text();
                  var subType = $('#subType').val();
                  var id = $('#id').val();
                  var name = $('#templateName').val();
                  $.post('submission.php',{'pagecontent' : code,'subType' : subType,'templateID' : id,'pagename':name,'draft':'no'}, function(data){

                  });
              });
          });

          var _onPaste_StripFormatting_IEPaste = false;

          function OnPaste_StripFormatting(elem, e) {

              if (e.originalEvent && e.originalEvent.clipboardData && e.originalEvent.clipboardData.getData) {
                  e.preventDefault();
                  var text = e.originalEvent.originalEvent.clipboardData.getData('text/plain');
                  window.document.execCommand('insertText', false, text);
              }
              else if (e.clipboardData && e.clipboardData.getData) {
                  e.preventDefault();
                  var text = e.clipboardData.getData('text/plain');
                  window.document.execCommand('insertText', false, text);
              }
              else if (window.clipboardData && window.clipboardData.getData) {
                  // Stop stack overflow
                  if (!_onPaste_StripFormatting_IEPaste) {
                      _onPaste_StripFormatting_IEPaste = true;
                      e.preventDefault();
                      window.document.execCommand('ms-pasteTextOnly', false);
                  }
                  _onPaste_StripFormatting_IEPaste = false;
              }

          }

      </script>
     ";
     return $array;
   }

 }

$EditPageSource = new EditPageSource;
echo $EditPageSource->build();
