<?php
/**
 * @license Copyright (c) 2015, Peacock CMS - Clyde Smets. All rights reserved.
 * For licensing, see EULA.rtf
 */
@$errorMessage = $_GET['err'];
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Forgot Password</title>
        <link href="css/CustomFormStyle.css" rel="stylesheet" type="text/css" />
        <link href="css/PeacockStyles.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <center>
        <form action="sendpasswordreset.php" method="post" class="basic-grey">
            <img src="Images/PeacockCMS_Logo.png" width="180" height="200"><br><br>
            <?php
                if ($errorMessage != null){
                    echo $errorMessage;
                    echo "<br>";
                    echo "<br>";
                }
              ?>
            <label>
                To reset your password please enter your email address that's attached to your login account details. Once reset is sent an email will be sent shortly with the details to create a new password.
                <br><br>
                <input id="email" type="text" name="email" placeholder="enter email here" />
            </label>

            <label>
                <input type="hidden" name="path" value="<?php echo FOLDER; ?>" />
                <input type="submit" class="button" value="Reset" />
            </label>
        </form>
        </center>
    </body>
</html>