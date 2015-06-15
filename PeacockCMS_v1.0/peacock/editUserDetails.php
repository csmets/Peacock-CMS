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

    @$errorMessage = $_GET['msg'];
    @$userID = $_GET['id'];
    
    $GetUser = "SELECT * FROM users WHERE id='$userID'";
    $sqlconnect = new Connectdb;
    $db = $sqlconnect->connectTo();
    $data = mysqli_query($db,$GetUser);

    $Retrieve = mysqli_fetch_array($data);
?>

<html>

<head>
    <title>Peacock>Dashboard | Edit User Details</title>
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
                <td width='60%' align='left'><br><a href='controlpanel.php' class='plinkTxt'>Return to Control Panel</a></td>
                <td align='left'></td>
            </tr>
        </table>
        </center>
        
        <!-- Pages Box -->
        <div class="pContentBox">
            <div class="pContentBoxHeader">
                &nbsp;&nbsp;<span class="oi" data-glyph="people"></span>&nbsp;
                <a class="ph1">EDIT USER</a>
            </div>
            <div class="pContentBoxContent">
                <form action='submission.php' method='post'>
                    <p class="ph2">User Details</p>
                    <p class="pbodyTxt"><?php echo $errorMessage ?></p>
                    <table width='400px'>
                    
                        <tr>
                        
                            <td>Avatar:<?php
                            	
                            	$Avatar = $Retrieve['profileimg'];
                            	if ($Avatar != null){
                            		echo "<br><img width='100px' src='".SITE_PATH."image/$Avatar'>";
                            	}
                            	
                            	
                            	?></td>
                            <td><a class="pEditLinkButton" href="ChangeUserAvatar.php?id=<?php echo $userID; ?>">Change Avatar</a></td>
                            
                        </tr>
                        
                        <tr>
                        
                            <td>Username: </td>
                            <td class="pbodyTxt"><?php echo $Retrieve['username'] ?></td>
                            
                        </tr>
                        
                        <tr>
                        
                            <td>First Name: </td>
                            <td><input class="ptextbox" type='text' name='firstname' value="<?php echo $Retrieve['firstname'] ?>"></td>
                            
                        </tr>
                        
                        <tr>
                        
                            <td>Last Name: </td>
                            <td><input class="ptextbox" type='text' name='lastname' value="<?php echo $Retrieve['lastname'] ?>"></td>
                            
                        </tr>
                        
                        <tr>
                        
                            <td>email address: </td>
                            <td><input class="ptextbox" type='text' name='email' value="<?php echo $Retrieve['email'] ?>"></td>
                            
                        </tr>
                        
                        <tr>
                        
                            <td>Password:</td>
                            <td><br><a class="pDeleteLinkButton" href="ChangePassword.php?id=<?php echo $userID; ?>">Change Password</a><br><br></td>
                            
                        </tr>
                        
                        
                        <tr>
                        
                            <td>Account Type: </td>
                            <td>
                                
                                <?php
                                
                                if ($Retrieve['acctype'] != 'administrator' && $userID != 1){
                                    echo "<p class='pbodyTxt'><b>".$Retrieve['acctype']."</b></p><input type='hidden' name='accounttype' value='administrator'";
                                }
                                elseif($userID == 1){
                                    echo "<p class='pbodyTxt'><b>".$Retrieve['acctype']."</b></p><input type='hidden' name='accounttype' value='administrator'";
                                }
                                else{
                                    echo "<select name='accounttype'>";
                                    echo "<option value='administrator' selected>Administrator</option>";
                                    echo "<option value='developer'>Developer</option>";
                                    echo "</select></td>";
                                }
                                    
                                ?>
                        </tr>
                        
                        <tr>
                        
                            <td>
                            	<input type='hidden' name='subType' value='editUser'>
                            	<input type='hidden' name='id' value='<?php echo $userID; ?>'>
                        	</td>
                            <td><input class="pSubmitButton" type='submit' value='Update User'></td>
                            
                        </tr>
                    
                    </table>
                     <br><br>
                    

                </form>
            </div>
        </div>
        
    </div>
    
</body>

<?php $db->close(); ?>

</html>