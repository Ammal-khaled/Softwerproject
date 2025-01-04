<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'webuser');
define('DB_PASSWORD', 'n6Y5HC8Di228mo@5fz~MCyt:8en-f3Mz');
define('DB_NAME', 'softwareproject');
 
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>