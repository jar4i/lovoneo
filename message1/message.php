<?php
    //connect to the database
    require_once("connect.php");
    include("../connection.php");
    if(isset($_POST['en'])){$query = $conn->query("SELECT phrase FROM en");}
    else{$query = $conn->query("SELECT phrase FROM de");}
    $array = Array();
    $_SESSION['array'] = $array;
    
    while($result = $query->fetch_assoc()){
        $array[] = $result['phrase'];
    }
    session_start();
    //shop not login  users from entering
    if(isset($_SESSION['us_id'])){
        $user_id = $_SESSION['us_id'];
    }else{
        header("Location: ../login_page.php");
    }
?><!DOCTYPE html>
<html>
<head>
    
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="../menu.css">
</head>
<body>
<header class="head fixed">
    <div class="wrap rel">
        <div class="menu">
            <div class="menu_left">
                <div class="hamburger pull-left _hamburger">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                </div>
                <nav class=" hero-nav pull_left _nav">
                    <ul class="list-unstyled ">
                        <a class="active" href="../index.php"><?php echo $array[1];?> |</a><!--2-->
                        <a class="active" href="../view_profile.php"> <?php 
                        if (isset($_SESSION['user_name'])) {
                            echo "Profile";
                            echo '  |';} 
                        ?>
                        </a>
                        <a class="active" href="message.php"> <?php 
                        if (isset($_SESSION['user_name'])) {
                            echo $array[13];
                            echo '  |';
                        }
                        ?>
                        </a>
                        <a class="active" href="../personal_page_edit.php?user_activation_code=<?php echo $_SESSION['user_activation_code'];?>&&user_id=<?php echo $_SESSION['user_id'];?>">
                        <?php
                        if (isset($_SESSION['user_name'])) {
                            echo $array[2];
                            echo '  |';
                        }
                        ?>
                        </a>
                
                    </ul>
                </nav>
            </div>
            <div class="right_side_menu rel">
                <form method="post" class="active2 language_box ">
                    <input class="active2 language" name="en" value="en"  type="submit">
                    /
                    <input class="active2 language" name="de" value="de"  type="submit">
                </form>
                   <?php 
                    if (isset($_SESSION['user_name'])) {
                        echo "<a class='active2 rel' href='../view_profile.php'>
                                <div class='inlne-block profile_photo_menu_box'>
                                    <img class='profile_photo_menu' src='../".$_SESSION['profile_foto']."'> 
                                </div>
                            </a>";
                        echo "<a class='active2' href='../view_profile.php'>";
                        echo ''.$_SESSION['first_name'];
                        echo "</a>";
                    }
                    ?> 
                <a class="active2" >
                    <?php 
                    if (isset($_SESSION['user_name'])) {
                        echo"<a href='../logout.php'>$array[3]</a>";/*4*/
                    }
                    else echo "<a href='../login_page.php'>$array[4]</a>";/*5*/
                    ?>
                </a>
            </div>
        </div>
    </div>
</header>
<div class="section_dial">
    <div class="wrap">
        <div class="message-body">
            <div class="message-left">
                <ul>
                    <?php
                        //show all the users expect me
                
                        $q = mysqli_query($con, "SELECT * FROM `register_user` WHERE user_id!='$user_id'");
                        //display all the results
                        while($row = mysqli_fetch_assoc($q)){
                            echo "
                            <a href='message.php?user_id={$row['user_id']}'>
                                <li class='li'>
                                    <div class='img_box '>
                                        <img src='../{$row['profile_foto']}'>
                                    </div>
                                    <div class='text_box '>
                                       {$row['first_name']} {$row['last_name']}
                                    </div>
                                    <div><i class='fas fa-pencil-alt'></i></div>
                                </li>
                            </a>
                            ";
                        }
                        ?>
                        </ul>
                    </div>
                    <div class="message-right">
                        <!-- display message -->
                        <?php
                        if(isset($_GET['user_id'])){
                            $user_two1 = trim(mysqli_real_escape_string($con, $_GET['user_id']));
                        $q2 = mysqli_query($con, "SELECT * FROM `register_user` WHERE user_id ='$user_two1'");
                                    while($row1 = mysqli_fetch_assoc($q2)){ echo "
                                        <div class='send-message'>
                                            <div class='box_b'>
                                                <a href='../personal_page.php?user_id={$row1['user_id']}'>
                                                    <div class='img_box '>
                                                        <img src='../{$row1['profile_foto']}'>
                                                    </div></a>
                                                    <a href='../personal_page.php?user_id={$row1['user_id']}'><div class='text_box_1 '>
                                                    {$row1['first_name']} {$row1['last_name']}
                                                    </div>
                                                </a>
                                            </div>
                                        </div>

                                            ";}}
                        ?>
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
                                <div class=" btn_violet" id="reply"><i class="fas fa-arrow-alt-circle-right"></i></div>
                            </div>
                </div>
                <!-- / send message -->
            </div>
        </div>
    </div>
</div>
    
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="Script.js"></script>
</body>
</html>