<?php
/**
 * @license Copyright (c) 2014 - 2016, Peacock CMS by Clyde Smets <clyde@peacockcms.com>
 * Peacock CMS is under the GNU - General Public License V3.
 */
    $urlCode = $_GET['id'];

    require("../view/config/config.php");
    require("../src/CLASS_Connectdb.php");
    
    $sqlconnect = new Connectdb;
    $db = $sqlconnect->connectTo();

    $sql = mysqli_query($db,"SELECT * FROM users");

    $match = false;
    $id = 0;
    $newPassword = '';

    while($get_data = mysqli_fetch_assoc($sql)){
        $firstname = $get_data['firstname'];
        $lastname = $get_data['lastname'];
        $username = $get_data['username'];

        $encrypt = $lastname.$username.substr($firstname,0,1);
        $genCode = hash('ripemd256',$encrypt);
        
        if ($urlCode == $genCode){
            $passwordString = rand().substr($firstname,0,3).rand().substr($lastname,0,3).rand();
            $genPassword = hash('ripemd256',$passwordString);
            $newPassword = substr($genPassword,0,8);
            $id = $get_data['id'];
            $match = true;
            break
        }
    }

    if ($match == true){
        $encryptPassword = hash('ripemd256',$newPassword);
        $sendToDatabase = "UPDATE users SET password='$encryptPassword' WHERE id='$id'";
        $sqlQuery = mysqli_query("UPDATE");
    }
    else{
        header("location:../plogin.php");   
    }

?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Reset Password</title>
        <link href="css/CustomFormStyle.css" rel="stylesheet" type="text/css" />
        <link href="css/PeacockStyles.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <center>
            <img src="peacock/Images/PeacockCMS_Logo.png" width="180" height="200"><br><br>
            <label>
                <span>New Password :</span>
                <?php echo $newPassword ?>
            </label>
        </center>
    </body>
</html>