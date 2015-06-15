<?php
/**
 * @license Copyright (c) 2015, Peacock CMS - Clyde Smets. All rights reserved.
 * For licensing, see EULA.rtf
 */

 	session_start();
    include("initPeacock.php");

    $username = $_SESSION['username'];
    $peacock = new Peacock;
    $peacock->checkUser($username);

    $SQLfilename = $_POST['backupfile'];

    $readBackup = new SQLRW;

    $readBackup->readSQL("../view/backups/".$SQLfilename);

    echo "Backup imported successfully";

    header("location:controlpanel.php");

?>