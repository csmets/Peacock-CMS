<?php
/**
 * @license Copyright (c) 2014, Peacock CMS - Clyde Smets. All rights reserved.
 * For licensing, see EULA.rtf
 */
@$errorMessage = $_GET['err'];
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Website Login</title>
        <link href="peacock/css/CustomFormStyle.css" rel="stylesheet" type="text/css" />
        <link href="peacock/css/PeacockStyles.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <center>
        <form action="peacock/loginCheck.php" method="post" class="basic-grey">
            <img src="peacock/Images/PeacockCMS_Logo.png" width="180" height="200"><br><br>
            <?php
                if ($errorMessage != null){
                    echo $errorMessage;
                    echo "<br>";
                    echo "<br>";
                }
              ?>
            <label>
                <span>Username :</span>
                <input id="username" type="text" name="username" placeholder="enter username here" />
            </label>

            <label>
                <span>Password :</span>
                <input id="password" type="password" name="password" placeholder="enter password here" />
            </label>  
            <label>
                <input type="hidden" name="path" value="<?php echo FOLDER; ?>" />
                <input type="submit" class="button" value="Login" />
            </label>
            <label>
                <br>
                <a class='plinkTxt' href='peacock/forgotpassword.php'>Forgot Password?</a>
            </label>
        </form>
        <a href="index.php" class="plinkTxt"><-- Return back to <?php echo $peacock->getSiteName(); ?></a>
        </center>
    </body>
</html>