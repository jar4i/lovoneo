<?php
// Database configuration
$dbHost     = "localhost";
$dbUsername = "lovoneo";
$dbPassword = "ZMaLPF2-unV-ch";
$dbName     = "projekt";

// Create database connection
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
?>
