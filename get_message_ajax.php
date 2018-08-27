<?php
session_start();
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
                $user = mysqli_query($con, "SELECT user_name,profile_foto FROM `register_user` WHERE user_id='$user_from'");
                $user_fetch = mysqli_fetch_assoc($user);
                $user_from_username = $user_fetch['user_name'];
                $user_from_img = $user_fetch['profile_foto'];
 
                //display the message
                // echo "
                //    <div class='message'>
                //        <div class='img-con'>
                //            <img src='../{$user_from_img}'>
                //        </div>
                //        <div class='text-con'>
                //            <a href='#'>{$user_from_username}</a>
                //            <p>{$message}</p>
                //        </div>
                //    </div>
                //    <hr>";
                    if($user_from == $_SESSION['us_id']){
                        echo "
                        <div class='cont_r'>
                                <div class='message_right rel'>
                                    <div class='text-con'>
                                       {$message}
                                    </div>
                                    <div class='sk_r'></div>
                                </div>
                                </div>
                        ";
                    }
                else{
                    echo "
                        <div class='cont_l'>
                        <div class='message_left rel'>
                                <div class='text-con'>
                                    {$message}
                                </div>
                                <div class='sk_l'></div>

                            </div>
                            </div>

                    ";
                }
              echo "</div>";
 
            }
        }else{
            echo "No Messages";
        }
    }
 
?>
