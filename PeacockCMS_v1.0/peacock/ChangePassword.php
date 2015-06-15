<?php
/**
 * @license Copyright (c) 2015, Peacock CMS - Clyde Smets. All rights reserved.
 * For licensing, see EULA.rtf
 */

    session_start();
    include('initPeacock.php');

    
    $username = $_SESSION['username'];
    $peacock = new Peacock;
    $peacock->checkUser($username);

    $errorMessage = $_GET['error'];
    $userID = $_GET['id'];
    
?>

<html>

<head>
    <title>Peacock>Dashboard | Change Password</title>
    <link href="css/PeacockStyles.css" rel="stylesheet" type="text/css" />   
    <link href="font/css/open-iconic.css" rel="stylesheet">
    <?php $peacock->removePageMargins(); ?>
    
</head>

<body class="backgroundColor">

    <?php include("includes/header.php"); ?>
    
    <div id="pContentWrapper">
        
        <center>
        <table width='100%'>
            
            <tr>
                <td width='60%' align='left'><p class='ph2'><?php $peacock->peacockVersion() ?></p></td>
                <td align='left'></td>
            </tr>
            <tr>
                <td width='60%' align='left'><br><a href='editUserDetails.php?id=<?php echo $userID; ?>' class='plinkTxt'>Return to Edit User</a></td>
                <td align='left'></td>
            </tr>
        </table>
        </center>
        
        <!-- Pages Box -->
        <div class="pContentBox">
            <div class="pContentBoxHeader">
                &nbsp;&nbsp;<span class="oi" data-glyph="key"></span>&nbsp;
                <a class="ph1">CHANGE PASSWORD</a>
            </div>
            <div class="pContentBoxContent">
                <form action='submission.php' method='post'>
                    <p class="ph2">Type in your new password</p>
                    <p class="pbodyTxt"><?php echo $errorMessage ?></p>
                    <table width='400px'>
                    
                        <tr>
                        
                            <td>New Password: </td>
                            <td><input class="ptextbox" type='password' name='password'></td>
                            
                        </tr>
                        
                        <tr>
                        
                            <td>Retype Password: </td>
                            <td><input class="ptextbox" type='password' name='retypepassword'></td>
                            
                        </tr>
                        
                        <tr>
                        
                            <td>
                            	<input type="hidden" name="id" value="<?php echo $userID; ?>">
                            	<input type="hidden" name="subType" value="changePassword">
                            </td>
                            <td><input class="pSubmitButton" type='submit' value='Change Password'></td>
                            
                        </tr>
                    
                    </table>
                     <br><br>
                    

                </form>
            </div>
        </div>
        
    </div>
    
</body>



</html>