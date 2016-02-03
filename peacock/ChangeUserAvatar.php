<?php
/**
 * @license Copyright (c) 2014 - 2016, Peacock CMS by Clyde Smets <clyde@peacockcms.com>
 * Peacock CMS is under the GNU - General Public License V3.
 */

 session_start();
 include('initPeacock.php');

 class ChangeUserAvatar extends PeacockUI{

   public function title(){
     return 'Change User Avatar';
   }

   public function content(){
     $username  = $_GET['id'];

     $User = new User($username);
     $avatar = $User->fetchAvatar();

     $array['content-title'] = "<a href='editUserDetails.php?id=$username'><i class='fa fa-arrow-left'></i></a> | User Avatar";
     $array['content-body'] = "
     <form action='submission.php' method='post'>
     <div class='row'>
       <div class='col-md-4'>
         Avatar
       </div>
       <div class='col-md-8'>
        <div class='displayImage'></div>
       </div>
     </div>
     <div class='row voffset3'>
       <div class='col-md-4'>
         Folder
       </div>
       <div class='col-md-8'>
        <select class='imageFolders'></select>
       </div>
     </div>
     <div class='row voffset3'>
       <div class='col-md-4'>
         Image
       </div>
       <div class='col-md-8'>
        <select name='avatar' class='imageSelect'></select>
       </div>
     </div>
     <div class='row voffset3'>
       <div class='col-xs-12 text-right'>
         <input type='hidden' name='subType' value='changeAvatar'>
         <input type='hidden' name='id' value='$username'>
         <input class='submitBtn' type='submit' value='Update Avatar'>
       </div>
     </div>
     </form>
     <script src='js/peacock-image-list.js'></script>
     ";

     return $array;
   }

 }

$changeAvatar = new ChangeUserAvatar;
echo $changeAvatar->build();
