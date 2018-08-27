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
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="../menu.css">
</head>
<body>
<header class="head fixed">
    <div class="wrap rel">
        <div class="logo_box"><a href="../index.php"><div class="logo"></div></a></div> 
        <form method="post" class="  language_box ">
                <input class="language1  language" name="en" value=""  type="submit">
                <input class="language2  language" name="de" value=""  type="submit">
        </form>
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
                                <div class="inline-block"><?php echo $row['first_name']; echo " "; echo $row['last_name'];?></div>
                                <div class="inline-block pencil"><i class="fas fa-pencil-alt"></i></div>
                            </div>
                        </div>
                    </div>   
                </a>
            <?php }?>
        </div>
    </div>
</div>

<footer class="foot fixed">
    <div class="wrap">
        <?php 
        if (isset($_SESSION['user_name'])) {
            echo "<a class='linka inline-block linka2' href='message.php'><i class='far fa-comments'></i></a>";
        }
        else{
            echo "<a href='../login_page.php' class='linka inline-block'>Log in</a>";
        }
        ?>
        
        <a href="../search_form.php" class="linka inline-block">Search</a>
        <?php 
        if (isset($_SESSION['user_name'])) {
            echo "<a class='linka inline-block linka2' href='../view_profile.php'><i class='far fa-user'></i></a>";
        }
        else{
            echo "<a href='../register.php' class='linka inline-block'>Register</a>";
        }
        ?>
    </div>
</footer>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>
