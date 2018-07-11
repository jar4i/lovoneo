<?php
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');

$servername = "localhost";
$username = "root";
$password = "Asal4Asal41";
$dbname = "projekt";
$limit = 6;
 
$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
} 
?> 
