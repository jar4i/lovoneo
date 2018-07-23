<?php
    //connect to the database
    require_once("connect.php");

    session_start();
    //shop not login  users from entering
    if(isset($_SESSION['us_id'])){
        $user_id = $_SESSION['us_id'];
    }else{
        header("Location: login.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <center>
        <br>
        <strong>Welcome <?php echo $_SESSION['user_name']; ?>  <a href="../logout.php">logout</a></strong>
    </center>
    <div class="message-body">
        <div class="message-left">
            <ul>
                <?php
                    //show all the users expect me
			
                    $q = mysqli_query($con, "SELECT * FROM `register_user` WHERE user_id!='$user_id'");
                    //display all the results
                    while($row = mysqli_fetch_assoc($q)){
                        echo "<a href='message.php?user_id={$row['user_id']}'><li><img src='../{$row['profile_foto']}'> {$row['user_name']}</li></a>";
                    }

                ?>
            </ul>
        </div>
        <div class="message-right">
            <!-- display message -->
            <div class="display-message">
            <?php
                //check $_GET&#91;'id'&#93; is set
                if(isset($_GET['user_id'])){
                    $user_two = trim(mysqli_real_escape_string($con, $_GET['user_id']));
                    //check $user_two is valid
                    $q = mysqli_query($con, "SELECT `user_id` FROM `register_user` WHERE user_id='$user_two' AND user_id!='$user_id'");
                    //valid $user_two
                    if(mysqli_num_rows($q) == 1){
                        //check $user_id and $user_two has conversation or not if no start one
                        $conver = mysqli_query($con, "SELECT * FROM `conversation` WHERE (user_one='$user_id' AND user_two='$user_two') OR (user_one='$user_two' AND user_two='$user_id')");
                        //they have a conversation
                        if(mysqli_num_rows($conver) == 1){
                            //fetch the converstaion id
                            $fetch = mysqli_fetch_assoc($conver);
                            $conversation_id = $fetch['id'];
                        }else{ //they do not have a conversation
                            //start a new converstaion and fetch its id
                            $q = mysqli_query($con, "INSERT INTO conversation (user_one, user_two) VALUES ('$user_id', '$user_two')");
                            $conversation_id = mysqli_insert_id($con);
                        }
                    }else{
                        die("Invalid $_GET ID.");
                    }
                }else {
                    die("Click On the Person to start Chating.");
                }
            ?>
            </div>
            <!-- /display message -->
            <!-- send message -->
            <div class="send-message">
                <!-- store conversation_id, user_from, user_to so that we can send send this values to post_message_ajax.php -->
                <input type="hidden" id="conversation_id" value="<?php echo $conversation_id; ?>">
                <input type="hidden" id="user_from" value="<?php echo $user_id; ?>">
                <input type="hidden" id="user_to" value="<?php echo $user_two; ?>">
                <div class="form-group">
                    <textarea class="form-control" id="message" placeholder="Enter Your Message"></textarea>
                </div>
                <button class="btn btn-primary" id="reply">Reply</button>
                <span id="error"></span>
            </div>
            <!-- / send message -->
        </div>
    </div>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="Script.js"></script>
</body>
</html>
