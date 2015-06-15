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

    $backup = new SQLRW;

    $filename = $username."-db-backup-".date("Y-m-d",time());

    $backup->writeSQL('*',SITE_PATH.'backups/',$filename);

    $backupFileList = SITE_PATH."backups/backupList.txt";
    $FileContents = file_get_contents($backupFileList);
    $FileContents .= $filename.".sql"."\n";
    file_put_contents($backupFileList, $FileContents);

	header("location:controlpanel.php");

?>