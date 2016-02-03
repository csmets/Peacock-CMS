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

    $backup = new SQLRW;

    $filename = $username."-db-backup-".date("Y-m-d",time());

    $backup->writeSQL('*','backups/',$filename);

    $backupFileList = "backups/backupList.txt";
    $FileContents = file_get_contents($backupFileList);
    $FileContents .= $filename.".sql"."\n";
    file_put_contents($backupFileList, $FileContents);

	header("location:dashboard.php");

?>
