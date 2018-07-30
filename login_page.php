<?php
session_start();
?>
<head>
<title>LOVONEO | FIND YOUR LOVE</title>
<link rel="stylesheet" href="login_page.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">

</head>
<body>
    <header class="head fixed">
        <div class="wrap">
            <nav class="pull_left">
                <ul class="list-unstyled ">
                <a class="active" href="index.php"><li class="li-item inline-block">Home</li></a>
                  <a href="#news"><li class="li-item inline-block">News</li></a>
                  <a href="#contact"><li class="li-item inline-block">Contact</li></a>
                  <a href="#about"><li class="li-item inline-block">About</li></a>
                </ul>
            </nav>
            <div class="pull-right rel">
                <a class="welcom" href="view_profile.php"> <?php 
                    if (isset($_SESSION['user_name'])) {
                        echo "<div class='profile_photo_menu_box inline-block'><img class='profile_photo_menu' src='".$_SESSION['profile_foto']."'> </div>";
                       echo ''.$_SESSION['first_name'];
                       echo '  |';
                    
                    }
                    ?>
                </a>
                <?php 
                    if (isset($_SESSION['user_name'])) {
                        echo'<a href="logout.php">Log out</a>';
                    }
                    else echo '<a href="login_page.php">Log in</a>';
                    ?>
            </div>
        </div>
    </header>
    <section class="rel section_login">
        <div class="wrap">
            <div class="logo"></div>
            <div class="form-signin"  method="POST">
                <?php
                include("login.php");
                ?>
            </div>
        </div>
    </section>
</body>
