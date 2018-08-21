<?php
//logout.php
    session_start();
    unset($_SESSION['us_id']);
    unset($_SESSION['user_id']);
    unset($_SESSION['profile_foto']);
    unset($_SESSION['first_name']);
    unset($_SESSION['user_name']);
    unset($_SESSION['user_activation_code']); 	
   


header("location:login_page.php");

?>
