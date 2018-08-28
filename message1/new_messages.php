<?php
session_start();
require_once("connect.php");
$user_id = $_SESSION['us_id'];
$query = mysqli_query($con, "SELECT * FROM `messages` WHERE user_to='$user_id' AND message_status=1");
if(mysqli_num_rows($query) > 0){
while($new_mess = mysqli_fetch_assoc($query)){
$mess = $new_mess['message'];
echo"<script> alert('$mess');</script>";
$update_query = mysqli_query($con, "UPDATE messages SET message_status=0 WHERE message_status=1");
}
}
?>

