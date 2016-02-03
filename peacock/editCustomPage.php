<?php
/**
 * @license Copyright (c) 2014 - 2016, Peacock CMS by Clyde Smets <clyde@peacockcms.com>
 * Peacock CMS is under the GNU - General Public License V3.
 */
 session_start();
 include('initPeacock.php');


 class EditCustomPage extends PeacockUI{

   public function title(){
     return 'Edit Custom Page';
   }

   public function content(){

     $PageName = $_GET['page'];
     $PageURL = $_GET['url'];
     $PageID = $_GET['id'];
 	   @$PageEdit = $_GET['edit'];

     $array['content-title'] = "<a href='dashboard.php'><i class='fa fa-arrow-left'></i></a> | Edit Custom Page";
     $array['content-body'] = "
     <form action='submission.php' method='post'>
     <div class='row'>
       <div class='col-md-4'>
         Custom Page Name
       </div>
       <div class='col-md-8'>
         <input type='text' name='PageName' value='$PageName'>
       </div>
     </div>

     <div class='row voffset3'>
       <div class='col-md-4'>
         Custom Page Link
       </div>
       <div class='col-md-8'>
         <input type='text' name='PageLink' value='$PageURL'>
       </div>
     </div>

     <div class='row voffset3'>
       <div class='col-md-4'>
         Edit Custom Page Link
       </div>
       <div class='col-md-8'>
         <input size='60' type='text' name='EditPageLink' value='$PageEdit' placeholder='Not Required Advanced Users Only'>
       </div>
     </div>

     <div class='row voffset3'>
       <div class='col-xs-12 text-right'>
         <input type='hidden' name='id' value='$PageID'>
         <input type='hidden' name='subType' value='editCustomPage'>
         <input class='submitBtn' type='submit' value='Update Link'>
       </div>
     </div>

     </form>
     ";

     return $array;
   }

 }

 $CustomPage = new EditCustomPage;
 echo $CustomPage->build();
