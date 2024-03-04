<?php
/* Database credentials */
define('DB_SERVER', 'localhost'); // Change this to your database server address
define('DB_USERNAME', 'root'); // Change this to your database username
define('DB_PASSWORD', ''); // Change this to your database password
define('DB_NAME', 'task-manager'); // Change this to your database name

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
