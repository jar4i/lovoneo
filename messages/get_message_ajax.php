<?php
    require_once("connect.php");
    if(isset($_GET['c_id'])){
        //get the conversation id and
        $conversation_id = $_GET['c_id'];
        //fetch all the messages of $user_id(loggedin user) and $user_two from their conversation
        $q = mysqli_query($con, "SELECT * FROM `messages` WHERE conversation_id='$conversation_id'");
        //check their are any messages
        if(mysqli_num_rows($q) > 0){
            while ($m = mysqli_fetch_assoc($q)) {
                //format the message and display it to the user
                $user_from = $m['user_from'];
                $user_to = $m['user_to'];
                $message = $m['message'];
 
                //get name and image of $user_form from `user` table
                $user = mysqli_query($con, "SELECT username,img FROM `user` WHERE id='$user_from'");
                $user_fetch = mysqli_fetch_assoc($user);
                $user_from_username = $user_fetch['username'];
                $user_from_img = $user_fetch['img'];
 
                //display the message
                echo "
                            <div class='message'>
                                <div class='img-con'>
                                    <img src='{$user_from_img}'>
                                </div>
                                <div class='text-con'>
                                    <a href='#'>{$user_from_username}</a>
                                    <p>{$message}</p>
                                </div>
                            </div>
                            <hr>";
 
            }
        }else{
            echo "No Messages";
        }
    }
 
?>
