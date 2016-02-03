<?php
/**
 * @license Copyright (c) 2014 - 2016, Peacock CMS by Clyde Smets <clyde@peacockcms.com>
 * Peacock CMS is under the GNU - General Public License V3.
 */

 session_start();
 include('initPeacock.php');

 class ChangePassword extends PeacockUI{

   public function title(){
     return 'Change Password';
   }

   public function content(){
     $userID = $_GET['id'];
     $array['content-title'] = "<a href='editUserDetails.php?id=$userID'><i class='fa fa-arrow-left'></i></a> | Change Password";
     $array['content-body'] = "
     <form action='submission.php' method='post'>
     <div class='row'>
       <div class='col-md-4'>
         New Password
       </div>
       <div class='col-md-8'>
         <input type='password' name='password'>
       </div>
     </div>
     <div class='row voffset3'>
       <div class='col-md-4'>
         Retype New Password
       </div>
       <div class='col-md-8'>
         <input type='password' name='retypepassword'>
       </div>
     </div>
     <div class='row voffset3'>
       <div class='col-xs-12'>
         <input type='hidden' name='subType' value='changePassword'>
         <input type='hidden' name='id' value='$userID'>
         <input class='submitBtn' type='submit' value='Change Password'>
       </div>
     </div>
     </form>
     ";

     return $array;
   }

 }

 $changePassword = new ChangePassword;
 echo $changePassword->build();
