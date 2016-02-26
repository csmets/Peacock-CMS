<?php
/**
 * @license Copyright (c) 2014 - 2016, Peacock CMS by Clyde Smets <clyde@peacockcms.com>
 * Peacock CMS is under the GNU - General Public License V3.
 */
    $email = $_POST['email'];

    require("../config/config.php");
    require("../src/CLASS_Connectdb.php");

    $sqlconnect = new Connectdb;
    $db = $sqlconnect->connectTo();

    $sql = mysqli_query($db,"SELECT * FROM users");

    while($get_data = mysqli_fetch_assoc($sql)){
        if ($get_data['email'] == $email){

            $firstname = $get_data['firstname'];
            $lastname = $get_data['lastname'];
            $username = $get_data['username'];

            $encrypt = $lastname.$username.substr($firstname,0,1);
            $genCode = hash('ripemd256',$encrypt);

            $to = $email;
            $from = "no-reply@$_SERVER[HTTP_HOST]";
            $subject = "Your Website Login Password Reset";

            // Begin Email Message Body
            $message = "
Hi $firstname,

Your username is: $username

To reset your password please click on the link below.
http://$_SERVER[HTTP_HOST]/peacock/resetPassword.php?id=$genCode

Thank you!
PeacockCMS
                ";

                // Set headers configurations
                $headers .= "From: $from\r\n";
                // Mail it now using PHP's mail function
                mail($to, $subject, $message, $headers);
                $formMessage = "Thanks, your message has been sent.";
                header("location:../plogin.php?message=$formMessage");

        }else{
            //No Email Exists
        }
    }
?>
