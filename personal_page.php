<?php

$user_id=$_GET["user_id"];
include("config.php");
$con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
$sthandler = $con->prepare("SELECT TIMESTAMPDIFF(YEAR, `birth_date`, CURDATE()) AS age , first_name, last_name, profile_foto FROM register_user WHERE user_id = '$user_id'");
$sthandler->execute();
?>
<head>
    <title>LOVONEO | FIND YOUR LOVE</title>
    <link rel="stylesheet" href="style-personal-page.css">
    <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
    <script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.3.js"></script>
</head>
<body>
    <header class="head fixed">
        <div class="wrap">
            <nav class="pull_left">
                <ul class="list-unstyled ">
                <a class="active" href="#home"><li class="li-item inline-block">Home</li></a>
                <a href="#news"><li class="li-item inline-block">News</li></a>
                <a href="#contact"><li class="li-item inline-block">Contact</li></a>
                <a href="#about"><li class="li-item inline-block">About</li></a>
                </ul>
            </nav>
            <div class="pull-right">
                <a class="welcom" > <?php 
                    if (isset($_SESSION['user_name'])) {
                    echo 'Welcome, '.$_SESSION['user_name'];
                    }
                    ?>
                </a>
                <a href="#" class="log-in-out">
                <?php 
                    if (isset($_SESSION['user_name'])) {
                    echo 'Log out';
                    }
                    else echo 'Log in';
                    ?>
                </a>
            </div>
        </div>
    </header>
    <section class="section-photo">
        <div class="wrap">
            <?php while($row = $sthandler->fetch(PDO::FETCH_ASSOC)) : ?>
            <div class="photo-box inline-block">
                <img src="<?php echo $row ['profile_foto']?>" class="photo">
            </div>
            <div class="info inline-block">
                <?php echo $row ['first_name'] ?>
                <?php echo $row ['last_name'] ?>
                <?php endwhile;?>
            </div>
            <div class="album">
                <?php
                include("fotos/view.php");
                ?>
            </div>
        </div>
    </section>
</body>





