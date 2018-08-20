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
        <div class="container">
            <div class=" ">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <div class="hamburger pull-left _hamburger">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                    </div>
                    <nav class=" hero-nav pull_left _nav">
                        <ul class="list-unstyled ">
                            <a class="active" href="../index.php">home |</a><!--2-->
                            <a class="active" href="../view_profile.php"> <?php 
                            if (isset($_SESSION['user_name'])) {
                                echo "Profile";
                                echo '  |';} 
                            ?>
                            </a>
                            <a class="active" href="message.php"> <?php 
                            if (isset($_SESSION['user_name'])) {
                                echo "message";
                                echo '  |';
                            }
                            ?>
                            </a>
                

                            <a class="active" href="../personal_page_edit.php?user_activation_code=<?php echo $_SESSION['user_activation_code'];?>&&user_id=<?php echo $_SESSION['user_id'];?>">
                            <?php
                            if (isset($_SESSION['user_name'])) {
                                echo "edit profile";
                                echo '  |';
                            }
                            ?>
                            </a>
                    
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <div class="right_side_menu rel">
                        <form method="post" class="active2 language_box ">
                            <input class="active2 language" name="en" value="en"  type="submit">
                            /
                            <input class="active2 language" name="de" value="de"  type="submit">
                        </form>
                         <?php 
                            if (isset($_SESSION['user_name'])) {
                                echo "<a class='active2 rel' href='../view_profile.php'><div class='inlne-block profile_photo_menu_box'><img class='profile_photo_menu' src='".$_SESSION['profile_foto']."'> </div></a>";
                                echo "<a class='active2' href='view_profile.php'>";
                                echo ''.$_SESSION['first_name'];
                                echo "</a>";
                            }
                            ?>
                        
                        <a class="active2" >
                            <?php 
                            if (isset($_SESSION['user_name'])) {
                                echo"<a href='../logout.php'>Log out</a>";/*4*/
                            }
                            else echo "<a href='../login_page.php'>Log in</a>";/*5*/
                            ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
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
