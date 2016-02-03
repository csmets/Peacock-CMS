<?php
/**
 * @license Copyright (c) 2014 - 2016, Peacock CMS by Clyde Smets <clyde@peacockcms.com>
 * Peacock CMS is under the GNU - General Public License V3.
 */
    require("config/config.php");

    $connection = @mysqli_connect(MYSQL_HOST, MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_DATABASE);

    if ($connection != null){

        $sql = "SELECT * FROM users";

        $query = mysqli_query($connection,$sql);

        $result = 'false';

        while(@$get_data = mysqli_fetch_assoc($query)){
          if ($get_data['username']){
            $result = 'true';
          }
        }

        if ($result == 'true'){
            header("location:plogin");
        }
    }

    @$errorMessage = $_GET['err'];

?>

<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Peacock Installer</title>
<link href="peacock/css/PeacockStyles.css" rel="stylesheet" type="text/css" />
<link href="peacock/css/CustomFormStyle.css" rel="stylesheet" type="text/css" />
</head>

<body>

<center>
  <form action="peacock/pInstallerScript.php" method="post" class="basic-grey" style="background-color:#FFFFFF; border:0;">
      <img src="view/image/PeacockCMS_Logo.png" width="180" height="200">
      <p class="pbodyTxt">Before installing Peacock please ensure you have entered in the correct details in the peacock_config.php file.</p>
      <p>Please fill out the form below to create an administrator level account. This is the main account holder for the administrator, the administrator is then able to create sub accounts to grant certain privledges to other users.</p>
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
          <span>Email :</span>
          <input id="email" type="text" name="email" placeholder="insert email address" />
      </label>
      <label>
          <span>Password :</span>
          <input id="password" type="password" name="password" placeholder="enter password here" />
      </label>
      <label>
          <span>Retype Password :</span>
          <input id="retypePassword" type="password" name="retypePassword" placeholder="retype password here" />
      </label>
      <label>
          <span></span>
          <input type="checkbox" name="createDatabase" /> Create New Database using name in config (unticked will look for existing database).
      </label>
       <label>
          <span>&nbsp;</span>
          <input type="submit" class="button" value="Install" />
      </label>
  </form>
</center>

</body>

</html>
