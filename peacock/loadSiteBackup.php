<?php
/**
 * @license Copyright (c) 2014 - 2016, Peacock CMS by Clyde Smets <clyde@peacockcms.com>
 * Peacock CMS is under the GNU - General Public License V3.
 */

 	session_start();
    include("initPeacock.php");

    $username = $_SESSION['username'];
    $peacock = new Peacock;
    $peacock->checkUser($username);

    $SQLfilename = $_POST['backupfile'];

    $readBackup = new SQLRW;

    $readBackup->readSQL("backups/".$SQLfilename);

    echo "Backup imported successfully";

    header("location:dashboard.php");

?>
