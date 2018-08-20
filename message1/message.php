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
?><!DOCTYPE html>
<html>
<head>
    
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
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
                            <a class="active" href="../index.php">Home |</a><!--2-->
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
                            else echo "<a href='../login_page.php'>Login</a>";/*5*/
                            ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="section_mes">
    <div class="wrap">
        <div class="mess-box ">
            <?php
                $q = mysqli_query($con, "SELECT * FROM `register_user` WHERE user_id!='$user_id'");//show all the users expect me
                while($row = mysqli_fetch_assoc($q)){ //display all the results ?>
                <a href="dialog.php?user_id= <?php echo $row['user_id']?>">
                    <div class="box_us row">
                        <div class="col-xs-4">
                            <div class="img_us_box ">
                                <img class="img_us " src="../<?php echo $row['profile_foto']?>"> 
                            </div>
                        </div>
                        <div class="col-xs-8 ">
                            <div class="name_us rel">
                                <div class="inline-block"><?php echo $row['user_name']?></div>
                                <div class="inline-block pencil"><i class="fas fa-pencil-alt"></i></div>
                            </div>
                        </div>
                    </div>   
                </a>
            <?php }?>
        </div>
    </div>
</div>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>
