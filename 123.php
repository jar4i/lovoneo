<?php
session_start();
if(isset($_SESSION['user_name']))
{
echo 'Welcome, '.$_SESSION['user_name'];
echo '<br>';
echo '<a href="logout.php">Logout</a>';
}
?>
