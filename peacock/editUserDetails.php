<?php
/**
 * @license Copyright (c) 2014 - 2016, Peacock CMS by Clyde Smets <clyde@peacockcms.com>
 * Peacock CMS is under the GNU - General Public License V3.
 */

    session_start();
    include('initPeacock.php');

    class EditUserDetails extends PeacockUI{

      public function title(){
        return "Edit User Details";
      }

      public function content(){
        @$errorMessage = $_GET['msg'];
        @$username = $_GET['id'];
        $User = new User($username);
        $avatar = $User->fetchAvatar();
        if (!$avatar){
          $avatar = "none.";
        }else{
          $avatar = "<img src='../view/image/$avatar' width='100%' />";
        }
        $firstname = $User->fetchFirstName();
        $lastname = $User->fetchLastName();
        $email = $User->fetchEmail();
        $accType = $User->fetchAccType();
        $userID = $User->fetchId();
        $accountTypeString = "";
        if ($accType != 'administrator' && $userID != 1){
            $accountTypeString = "<b>$accType</b>";
        }
        elseif($userID == 1){
            $accountTypeString = "<b>$accType</b>";
        }
        else{
            $accountTypeString = "<select name='accounttype'>";
            $accountTypeString .= "<option value='administrator' selected>Administrator</option>";
            $accountTypeString .= "<option value='developer'>Developer</option>";
            $accountTypeString .= "</select>";
        }

        $array = array();
        $array['content-title'] = "<a href='dashboard.php'><i class='fa fa-arrow-left'></i></a> | User Settings";
        $array['content-body'] = "
          <form action='submission.php' method='post'>
          <div class='row'>
            <div class='col-md-4'>
              Avatar
            </div>
            <div class='col-md-2'>
              $avatar
            </div>
            <div class='col-md-6'>
              <a href='ChangeUserAvatar.php?id=$username'>Change Avatar</a>
            </div>
          </div>

          <div class='row voffset3'>
            <div class='col-md-4'>
              Username
            </div>
            <div class='col-md-8'>
              $username
            </div>
          </div>

          <div class='row voffset3'>
            <div class='col-md-4'>
              First Name
            </div>
            <div class='col-md-8'>
              <input class='ptextbox' type='text' name='firstname' value='$firstname'>
            </div>
          </div>

          <div class='row voffset3'>
            <div class='col-md-4'>
              Last Name
            </div>
            <div class='col-md-8'>
              <input class='ptextbox' type='text' name='lastname' value='$lastname'>
            </div>
          </div>

          <div class='row voffset3'>
            <div class='col-md-4'>
              Email
            </div>
            <div class='col-md-8'>
              <input class='ptextbox' type='text' name='email' value='$email'>
            </div>
          </div>

          <div class='row voffset3'>
            <div class='col-md-4'>
              Password
            </div>
            <div class='col-md-8'>
              <a href='ChangePassword.php?id=$username'>Change Password</a>
            </div>
          </div>

          <div class='row voffset3'>
            <div class='col-md-4'>
              Account Type
            </div>
            <div class='col-md-8'>
              $accountTypeString
            </div>
          </div>

          <div class='row voffset3'>
            <div class='col-xs-12 text-right'>
              <input type='hidden' name='subType' value='editUser'>
              <input type='hidden' name='id' value='$username'>
              <input class='submitBtn' type='submit' value='Update User'>
            </div>
          </div>

          </form>

        ";
        return $array;
      }

    }

    $EditUserDetails = new EditUserDetails();
    echo $EditUserDetails->build();
?>
