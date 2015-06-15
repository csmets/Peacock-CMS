<?php
/**
 * @license Copyright (c) 2015, Peacock CMS - Clyde Smets. All rights reserved.
 * For licensing, see EULA.rtf
 */

	session_start();
	define("SITE_PATH", $_COOKIE['sitePath']);
    include(SITE_PATH."config/config.php");
    include('../peacockCMS.php');
?>