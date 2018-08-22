<?php
    require_once("connect.php");
	error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');
    //post message
    if(isset($_POST['message'])){
        $message = mysqli_real_escape_string($con, $_POST['message']);
        $conversation_id = mysqli_real_escape_string($con, $_POST['conversation_id']);
        $user_from = mysqli_real_escape_string($con, $_POST['user_from']);
        $user_to = mysqli_real_escape_string($con, $_POST['user_to']);
	$status = mysqli_real_escape_string($con, $_POST['status']);
 
       
        //insert into `messages`
        $q = mysqli_query($con, "INSERT INTO messages (conversation_id, user_from, user_to, message, status VALUES ('$conversation_id','$user_from','$user_to','$message', '$status')");
        if($q){
            echo "Posted";
        }else{
            echo "Error";
        }
    }
?>
