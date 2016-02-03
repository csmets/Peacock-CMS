<?php
/**
 * @license Copyright (c) 2014 - 2016, Peacock CMS by Clyde Smets <clyde@peacockcms.com>
 * Peacock CMS is under the GNU - General Public License V3.
 */

 session_start();
 include("initPeacock.php");

 class EditContactPage extends PeacockUI{

   public function title(){
     return 'Edit Contact Page';
   }

   public function content(){
     $contactID = $_GET['id'];
     $Peacock = new Peacock;
     $pageTitle = $Peacock->getPageName($contactID);
     $pageImage = $Peacock->getPageImage($contactID);
     $pageContent = $Peacock->getPageContent($contactID);
     $pageEmail = $Peacock->getPageAdditional($contactID);

     if (!$pageImage || $pageImage == 'none'){
       $pageImage = "none.";
     }else{
       $pageImage = "<img src='../view/image/$pageImage' />";
     }

     $array['content-title'] = "<a href='dashboard.php'><i class='fa fa-arrow-left'></i></a> | Edit Contact Page";
     $array['content-body'] = "
     <link href='css/peacock-inline-editor-style.css' rel='stylesheet' type='text/css' />
     <form action='submission.php' method='post' id='pageForm'>
     <div class='row'>
       <div class='col-md-4'>
         Contact Page Name
       </div>
       <div class='col-md-8'>
         <input type='text' name='title' value='$pageTitle'>
       </div>
     </div>

     <div class='row voffset3'>
       <div class='col-md-4'>
         Contact Page Image
       </div>
       <div class='col-md-2'>
        <div class='displayImage'>
         $pageImage
        </div>
       </div>
       <div class='col-md-6'>
         Folder: <select class='imageFolders'></select> Image: <select name='image' class='imageSelect'></select>
       </div>
     </div>

     <div class='row voffset3'>
       <div class='col-md-4'>
         Reciever's Email Address
       </div>
       <div class='col-md-8'>
         <input type='text' name='email' value='$pageEmail'>
       </div>
     </div>

     <div class='row voffset3'>
       <div class='col-md-4'>
         Contact Page Description
       </div>
       <div class='col-md-8'>
         <div class='inlineEditorField'><div class='Editable' id='SaveContent'>$pageContent</div></div>
       </div>
     </div>

     <div class='row voffset3'>
       <div class='col-xs-12 text-right'>
         <input type='hidden' name='contactbody' id='contactContent'>
         <input type='hidden' name='id' value='$contactID'>
         <input type='hidden' name='subType' value='editContactPage'>
         <input type='button'  class='submitBtn' value='Update' onclick='Save()'>
       </div>
     </div>

     </form>
     <script src='js/peacock-image-list.js'></script>
     <script src='js/peacock-inline-editor.js'></script>
     <script>
         $(document).ready(function(){
             var inlineEditor = new init_Peacock_InlineEditor();
             inlineEditor.run();
         });

         function Save(){
             var removeEditor = new init_Peacock_InlineEditor();
             removeEditor.removeEditors();
             $('#contactContent').val($('#SaveContent').html());
             $('#pageForm').submit();
         }
     </script>
     ";

     return $array;
   }

 }

 $EditContactPage = new EditContactPage;
 echo $EditContactPage->build();
