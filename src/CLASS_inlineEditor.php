<?php

class InlineEditor extends Peacock{

  public $editorBar_classname = "Editable";
  public $editorBar_usesImage = false;
  public $editorBar_titleID = "SaveTitleContent";
  public $editorBar_contentID = "SaveContent";
  public $editorBar_template = false;
  public $editorBar_templateID = 0;
  private $editorBar_title = NULL;


  public function run($nameBox, $ID){
      $type = @$_GET['type'];
      $template = @$_GET['template'];
      @$editTemplate = $_GET['e'];

      if ($template == 'blankPage'){
          $this->editorBar($nameBox, 0, $type);
      }
      elseif ($template == 'NewTemplate'){
          $this->editorBar_classname = "Template-Editable";
          $this->editorBar_template = true;
          $this->editorBar($nameBox, 0, $type);
      }
      else{
          if ($editTemplate == 'yes'){
              $this->editorBar_classname = "Template-Editable";
              $this->editorBar_template = true;
              $this->editorBar_title = $this->getTemplateName($template);
          }
          $this->editorBar_templateID = $template;
          $this->editorBar($nameBox, $ID, $type);
      }
  }

  private function editorBar($nameBox = true, $pageID = 0, $pageType = 'normal'){

    //Declarations
    $pageName = '';
    $edit = false;
    $titlePasser = '';
    $contentPasser = '';
    $imagePasser = '';
	$javascript = '';

    if ($pageID == 0){
      $pageName = 'Insert Page Name';
    }else{
      $pageName = $this->getPageName($pageID);
      $edit = true;
    }

    if ($pageType == 'blogPost'){
      $titlePasser = 'postname';
      $contentPasser = 'postcontent';
    }else{
      $titlePasser = 'pagename';
      $contentPasser = 'pagecontent';
    }

    if ($this->editorBar_usesImage == true && $pageType == 'blogPost'){
      $imagePasser = 'postimage';
    }else{
      $imagePasser = 'image';
    }



        //Gather Styles and functions for javascript peacock inline editor
        $peacock_inline_editor_load = "
            <link href='/peacock/css/peacock-inline-editor-style.css' rel='stylesheet' type='text/css' />
            <script src='/peacock/js/peacock-inline-editor.js' type='text/javascript'></script>";
        //==================================================================


        //Show and Hide Editorbar
        $showHideEditor = '
        <div style="margin-left:100%;z-index:9999;position:fixed">
        <div id="toggleEditor" style="cursor:pointer;margin-left:-50px;display:block;float:right;margin-top:26px;padding-top:4px;padding-bottom:4px;padding-right:10px;padding-left:20px;background-color:#f1c40f;z-index:9999;color:white;border-top-left-radius:4px;border-bottom-left-radius:4px">
        -
        </div>
        </div>
        <script>
          $(document).ready(function(){
            var topbar_toggleEditor = false;
            $("#toggleEditor").on("click",function(){
                if (topbar_toggleEditor == false){
                    $(this).text("+");
                    $("#pEditorTopBar").slideUp("slow");
                    topbar_toggleEditor = true;
                }else{
                    $(this).text("-");
                    $("#pEditorTopBar").slideDown("slow");
                    topbar_toggleEditor = false;
                }
            });
          });
        </script>
        ';
        //======================================================================



        //Dialog box for when user wishes to revert to a previous backup.
        $messageBox = "
            <div id='dialog-overlay'></div>
            <div id='confirmRevert' class='pDialogBox' style='position:fixed;width:400px; height:140px;'>
                <div class='pDialogBoxHeader'>
                    Revert to Previous Backup
                </div>

                <div class='pDialogBoxContent'>
                <center>
                    Are you sure you want to revert to a previous backup?<br><br>
                    <a href='#' name='applyRevert' class='pDialogBoxButton'>yes</a>
                    <a href='#' name='closeRevert' class='pDialogBoxButton'>no</a>
                </center>
                </div>
            </div>
        ";
        //======================================================================




        //Editor top bar which allows you to save as draft/final and revert to previous backup
    $topbar = "
        <div id='pEditorTopBar' style='position:fixed;width:100%;z-index:999'>
        <table width='95%' border='0px'>
        <tr>
            <td width='60px'><img src='/view/image/Icons/PeacockCMS_Logo_Icon.png' width='40px' height='40px'></td>
            <td width='260px' class='phLarge'>PEACOCK EDITOR</td>";

        if ($nameBox == true){
                if ($this->editorBar_title != NULL){
                    $topbar .= "<td><input type='text' class='pPageNameField' id='".$titlePasser."' value='".$this->editorBar_title."' size='35' /></td>";
                }else{
          $topbar .= "<td><input type='text' class='pPageNameField' id='".$titlePasser."' value='".$pageName."' size='35' /></td>";}
        }

    $topbar .=  "<td style='color:white'>
              <form id='imageUploadForm' action='/peacock/multiUploaderInEditor.php' method='post'>
                <span class='pWhiteBasicTxt'>Upload Images (max 6mb)</span><input type='file' class='pWhiteBasicTxt' id='ImageBrowse' name='files[]' multiple='multiple' min='1' max='9999' />
              </form>
            </td>


            <form name='form' id='pageForm' action='/peacock/submission.php' method='post'>
            <td width='100px' class='pWhiteBasicTxt'><input type='radio' name='draft' value='yes'>Draft<br><input type='radio' name='draft' value='no' checked>Final";

        if ($pageID != 0){
            $showRevertBtn = false;
            if ($pageType == 'blogPost'){
                if (file_exists('/peacock/backups/posts/postBackup-'.$pageID.'.json')){
                    $showRevertBtn = true;
                }
            }else{
                if (file_exists('/peacock/backups/pages/pageBackup-'.$pageID.'.json')){
                    $showRevertBtn = true;
                }
            }
            if ($showRevertBtn == true){
                $topbar .= "<br><div id='revertToBackup' style='display:inlineblock;cursor:pointer;color:#3498db'>Revert To Previous</div>";
            }
        }
                $topbar .= "</td>
            <td valign='middle' width='150px' align='left'><div class='pSubmitBtnShape' onclick='Save()'>submit</div></td>
            <td valign='middle' width='150px' align='left'><a href='/peacock/dashboard.php' class='pCancelBtnShape'>cancel</a></td>
          </tr>
        </table>
        </div>";

    $form .= "
        <input type='hidden' name='$titlePasser' id='pagenamePasser' />
        <input type='hidden' name='$contentPasser' id='contentPasser' />";

        if ($this->editorBar_usesImage == true){
          $form .= "<input type='hidden' name='$imagePasser' id='imagePasser' />";
        }

        if ($edit == true && $this->editorBar_template == false){

          $form .= "<input type='hidden' name='id' value='$pageID'/>";

          if ($pageType == 'blogPost'){
            $form .= "<input type='hidden' name='subType' value='editPost'/>";
          }else
          {
            $form .= "<input type='hidden' name='subType' value='editPage'/>";
          }
        }
        elseif ($edit == false && $this->editorBar_template == false){

                    @$templateID = $_GET['template'];

                    if ($template != null){
                        $form .= "<input type='hidden' name='templateID' value='".$templateID."'/>";
                    }

          if ($pageType == 'blogPost'){
            $form .= "<input type='hidden' name='subType' value='blogSubmit'/>";
          }else{
            $form .= "<input type='hidden' name='subType' value='submitPage'/>";
          }

          if ($pageType == 'normal'){
            //Normal Page AKA Page
            $form .= "<input type='hidden' name='pageType' id='pageType' value='normal' />";
          }
          elseif($pageType == 'subpage'){
            //SubPage
            $form .= "<input type='hidden' name='pageType' id='pageType' value='subpage' />";
          }
          else{

          }
        }
        elseif ($this->editorBar_template == true){
                    if ($this->editorBar_templateID > 0){
                        $form .= "<input type='hidden' name='subType' value='editTemplate'/>";
                        $form .= "<input type='hidden' name='templateID' value='".$this->editorBar_templateID."'/>";
                    }else{
                        $form .= "<input type='hidden' name='subType' value='createTemplate'/>";
                    }
        }


        $form .= "</form>";

        //Load up Peacock Inline Editor ============================
        $peacock_inline_editor = '<script>
        $(window).bind("load",function(){
            var inlineeditor = new init_Peacock_InlineEditor();
            inlineeditor.classname = "'.$this->editorBar_classname.'";
            inlineeditor.run();
        });</script>';
        //============================================================

    $javascript .= "

        <script type='text/javascript'>
          $(document).ready(function (e) {
            $('#imageUploadForm').on('submit',(function(e) {
                e.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                    type:'POST',
                    url: $(this).attr('action'),
                    data:formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success:function(data){
                        alert('Uploaded Successfully');
                    },
                    error: function(data){
                        alter('error: check console');
                        console.log(data);
                    }
                });
            }));

            $('#ImageBrowse').on('change', function() {
                $('#imageUploadForm').submit();
            });


                    $('#dialog-overlay, #confirmRevert').hide();

                });";




        /*
            =====================================================
            Revert to previous backup of page.
        */

          if ($pageID != 0){
            $javascript .= "

                $('#revertToBackup').click(function(){
                    $('#dialog-overlay, #confirmRevert').fadeIn('slow');
                });

                $('a[name=applyRevert]').click(function(){";
                if ($pageType == 'blogPost'){
                    $javascript .= "
                    $.getJSON('/peacock/backups/posts/postBackup-".$pageID.".json', function(result){";
                }
              else{
                    $javascript .= "
                    $.getJSON('/peacock/backups/pages/pageBackup-".$pageID.".json', function(result){";
                }

            $javascript .= "
                        var newEditor = new init_Peacock_InlineEditor();
                        newEditor.removeEditors();
                        $('#".$this->editorBar_contentID."').html(result.body);
                        ";
                        if ($nameBox == true){
                            $javascript .= "$('#$titlePasser').val(result.title);";
                        }else{
                            $javascript .= "$('#".$this->editorBar_titleID."').html(result.title);";
                        }
                        $javascript .= "$('#dialog-overlay, #confirmRevert').hide();
                        newEditor.run();
                    });

            });";

            $javascript .= "$('a[name=closeRevert]').click(function(){
                        $('#dialog-overlay, #confirmRevert').hide();
                    });";
        }

        //=======================================================




        $javascript .= "function Save(){
                        var removeEditor = new init_Peacock_InlineEditor();
                        removeEditor.removeEditors();";

        if ($this->editorBar_usesImage == true){
          $javascript .= "
                        var imageData = $('#pageImage').val();
                        $('#imagePasser').val(imageData);";
        }

                if ($nameBox == false){
                    $javascript .= "
                        var PageNameData = $('#$this->editorBar_titleID').html();
                        $('#pagenamePasser').val(PageNameData);
                    ";
                }else{
                    $javascript .= "
                        var PageNameData = $('#".$titlePasser."').val();
                        $('#pagenamePasser').val(PageNameData);
                    ";
                }

    $javascript .=	"
                    var bodycontent = $('#$this->editorBar_contentID').html();
                    $('#contentPasser').val(bodycontent);
            $('#pageForm').submit();
        }

        </script>

        ";

        print $messageBox.$topbar.$showHideEditor.$form.$javascript.$peacock_inline_editor_load.$peacock_inline_editor;
  }

}

?>
