<?php
    //connect to the database
    require_once("connect.php");

    session_start();
    //shop not login  users from entering
    if(isset($_SESSION['us_id'])){
        $user_id = $_SESSION['us_id'];
    }else{
        header("Location: ../login_page.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style_dialog.css">
</head>
<body>
<header class="head fixed">
    <div class="wrap rel">

    <?php
    if(isset($_GET['user_id'])){
        $user_two1 = trim(mysqli_real_escape_string($con, $_GET['user_id']));
    $q2 = mysqli_query($con, "SELECT * FROM `register_user` WHERE user_id ='$user_two1'");
                while($row1 = mysqli_fetch_assoc($q2)){ echo "
                        <div class='box_b'>
                            <a href='message.php?user_id=$user_id' class='arrow'><i class='fas fa-angle-left'></i></a>
                            <a href='../personal_page.php?user_id={$row1['user_id']}'>
                                <div class='img_box '>
                                    <img src='../{$row1['profile_foto']}'>
                                </div></a>
                                <a href='../personal_page.php?user_id={$row1['user_id']}'><div class='text_box_1 '>
                                {$row1['first_name']} {$row1['last_name']}
                                </div>
                            </a>
                        </div>

                        ";}}
    ?>
    </div>
</header>
<div class="section_dial">
    <div class="wrap">
        <div class="display-message rel">
                <?php
                if(isset($_GET['user_id'])){//check $_GET&#91;'id'&#93; is set
                    $user_two = trim(mysqli_real_escape_string($con, $_GET['user_id'])); //check $user_two is valid
                    $q = mysqli_query($con, "SELECT `user_id` FROM `register_user` WHERE user_id='$user_two' AND user_id!='$user_id'"); //valid $user_two
                    if(mysqli_num_rows($q) == 1){
                        $conver = mysqli_query($con, "SELECT * FROM `conversation` WHERE (user_one='$user_id' AND user_two='$user_two') OR (user_one='$user_two' AND user_two='$user_id')");//check $user_id and $user_two has conversation or not if no start one
                        if(mysqli_num_rows($conver) == 1){ //they have a conversation
                            $fetch = mysqli_fetch_assoc($conver);//fetch the converstaion id
                            $conversation_id = $fetch['id'];
                        }else{ //they do not have a conversation
                            $q = mysqli_query($con, "INSERT INTO conversation (user_one, user_two) VALUES ('$user_id', '$user_two')"); //start a new converstaion and fetch its id
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
    </div>
</div>


<footer class="foot fixed">
    <div class="wrap">
    <div class="send-message">
                    <input type="hidden" id="conversation_id" value="<?php echo $conversation_id; ?>">
                    <input type="hidden" id="user_from" value="<?php echo $user_id; ?>">
                    <input type="hidden" id="user_to" value="<?php echo $user_two; ?>">
                        <textarea class="form-control" id="message" placeholder="Enter Your Message"></textarea>
                    <div class="btn_violet inline-block" id="reply"><i class="fas fa-arrow-alt-circle-right"></i></div>
                    <!-- <span id="error"></span> -->
                </div>
    </div>
</footer>



    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="Script.js"></script>

</body>
</html>
