<?php

/**
 * @license Copyright (c) 2015, Peacock CMS - Clyde Smets. All rights reserved.
 * For licensing, see EULA.rtf
 */


/* Class to connect to Database on server. This is used to
   gather information from the server. */
class  Connectdb {
    function connectTo (){
        
       $db = new mysqli(MYSQL_HOST, MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_DATABASE);
        return $db;
    }
}

?>