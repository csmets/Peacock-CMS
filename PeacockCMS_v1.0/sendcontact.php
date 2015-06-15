<?php
/**
 * @license Copyright (c) 2015, Peacock CMS - Clyde Smets. All rights reserved.
 * For licensing, see EULA.rtf
 */
    include("view/config/config.php");
    include("src/CLASS_Connectdb.php");
    $sqlconnect = new Connectdb;
    $db = $sqlconnect->connectTo();
    $getPage = "SELECT * FROM pages WHERE id='3'";
    $data = mysqli_query($db,$getPage);
    $Retrieve = mysqli_fetch_array($data);

        // Gather the posted form variables into local PHP variables
        $senderName = $_POST['username'];
        $senderEmail = $_POST['email'];
        $senderMessage = $_POST['msg'];
        $senderIsHuman = $_POST['human'];
        // Make sure certain vars are present or else we do not send email yet
        if ($senderIsHuman == true){
            if (!$senderName || !$senderEmail || !$senderMessage) {

                $formMessage = "The form is incomplete, please fill in all fields.";
                $db->close();
                header("location:contact.php?message=".$formMessage."#contact");

            } else { // Here is the section in which the email actually gets sent

                // Run any filtering here
                $senderName = strip_tags($senderName);
                $senderName = stripslashes($senderName);
                $senderEmail = strip_tags($senderEmail);
                $senderEmail = stripslashes($senderEmail);
                $senderMessage = strip_tags($senderMessage);
                $senderMessage = stripslashes($senderMessage);
                // End Filtering
                $to = $Retrieve['additional'];         
                $from = $senderEmail;
                $subject = "You have a message from your website";
                // Begin Email Message Body
                $message = "
$senderMessage

$senderName
$senderEmail
                ";
                // Set headers configurations
                $headers .= "From: $from\r\n";
                // Mail it now using PHP's mail function
                mail($to, $subject, $message, $headers);
                $formMessage = "Thanks, your message has been sent.";
                $db->close();
                header("location:contact.php?message=".$formMessage."#contact");
            } // close the else condition
        }
        else{
            $db->close();
            $formMessage = "You are not a Human?";
            header("location:contact.php?message=".$formMessage."#contact");
        }

?>