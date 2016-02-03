<?php

/**
 * @license Copyright (c) 2014 - 2016, Peacock CMS by Clyde Smets <clyde@peacockcms.com>
 * Peacock CMS is under the GNU - General Public License V3.
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