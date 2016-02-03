<?php
    /**
     * @license Copyright (c) 2014 - 2016, Peacock CMS by Clyde Smets <clyde@peacockcms.com>
     * Peacock CMS is under the GNU - General Public License V3.
     */
    require("../config/config.php");

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $retypePassword = $_POST['retypePassword'];
    $createDatabase = $_POST['createDatabase'];
    $connection = null;


    if ($username != null){

        if ($email != null){

            if ($password != null && $retypePassword != null){

                if ($password == $retypePassword){

                    if ($createDatabase == true){
                        // Connect to MySQL server
                        $connection = @mysqli_connect(MYSQL_HOST, MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_DATABASE);

                        if (!$connection){
                            $sql = "CREATE DATABASE ".MYSQL_DATABASE;
                            $connection = new mysqli(MYSQL_HOST, MYSQL_USERNAME, MYSQL_PASSWORD);
                            if (mysqli_query($connection,$sql) === TRUE){
                                echo "Database Created";

                                //Reistablish connection using new database.
                                $connection = new mysqli(MYSQL_HOST, MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_DATABASE)
                                    or die('Error connecting to MySQL server: ' . mysqli_error($connection));

                            }else{
                                echo "Error creating database: " . mysqli_error($connection);
                            }
                        }
                    }else{
                        $connection = new mysqli(MYSQL_HOST, MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_DATABASE);
                    }
                    // Temporary variable, used to store current query
                    $templine = '';
                    // Name of the file
                    $filename = 'SQL/peacockcms.sql';
                    // Read in entire file
                    $lines = file($filename);
                    // Loop through each line
                    foreach ($lines as $line)
                    {
                        // Skip it if it's a comment
                        if (substr($line, 0, 2) == '--' || $line == '')
                            continue;

                        // Add this line to the current segment
                        $templine .= $line;
                        // If it has a semicolon at the end, it's the end of the query
                        if (substr(trim($line), -1, 1) == ';')
                        {
                            // Perform the query
                            mysqli_query($connection, $templine) or print('Error performing query \'<strong>'
                                . $templine . '\': ' . mysqli_error($connection) . '<br /><br />');
                            // Reset temp variable to empty
                            $templine = '';
                        }
                    }

                    $password = hash('ripemd256',$password);

                    $sql = "INSERT INTO users (username, password, firstname, lastname, email, editortype, acctype)
                    VALUES ('$username', '$password','admin','administrator','$email','advance','administrator')";

                    mysqli_query($connection,$sql);

                    echo '
                        <script type="text/javascript">
                        var count = 6;
                        var redirect = "../plogin";

                        function countDown(){
                            var timer = document.getElementById("timer");
                            if(count > 0){
                                count--;
                                timer.innerHTML = "This page will redirect in "+count+" seconds.";
                                setTimeout("countDown()", 1000);
                            }else{
                                window.location.href = redirect;
                            }
                        }
                        </script>

                        Peacock CMS Successfully Installed
                        <br>

                        <span id="timer">
                        <script type="text/javascript">countDown();</script>
                        </span>';

                }else{
                    //Passwords are not correct
                    $error = "Passwords are not correct";
                    header("location:../setup.php?err=$error");
                }
            }else{
                //Password not entered
                $error = "Password not entered";
                header("location:../setup.php?err=$error");
            }
        }else{
            //Email not entered
            $error = "Email not entered";
            header("location:../setup.php?err=$error");
        }
    }else{
        //username is not entered
        $error = "Username is not entered";
        header("location:../setup.php?err=$error");
    }
?>
