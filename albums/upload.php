<?php
if(!empty($_FILES)){
	session_start();
    // Include the database configuration file
    require 'dbConfig.php';
    // File path configuration
    $targetDir = "uploads/";
    $fileName = $_FILES['file']['name'];
	$user_id = $_SESSION['us_id'];
    $targetFilePath = $targetDir.$fileName;
    
    // Upload file to server
    if(move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)){
        // Insert file information in the database
        $insert = $db->query("INSERT INTO files (file_name, uploaded_on, us_us_id) VALUES ('".$fileName."', NOW(), '$user_id')");
    }
}
?>
