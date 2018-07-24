<?php
session_start();
$user_id=$_GET["user_id"];
include("config.php");
$con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
$sthandler = $con->prepare("SELECT TIMESTAMPDIFF(YEAR, `birth_date`, CURDATE()) AS age , first_name, last_name, country, city, details, height, weight, profile_foto FROM register_user WHERE user_id = '$user_id'");
$sthandler->execute();
?>

<head>
<title>LOVONEO | FIND YOUR LOVE</title>
<link rel="stylesheet" href="style_personal_page.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<link rel="stylesheet" type="text/css" href="slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
<script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.3.js"></script>
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
                else echo '<a href="login.php">Log in</a>';
                ?>
            </div>
        </div>
    </header>
    <div class="wrap">
    <section class="section-control inline-block  rel">
        <div class="logo"></div>
            <div class="form-signin"  method="POST">
                    <?php
                    if(isset($_SESSION['user_name']))
                    {
                    include("user_on.php");
                    }
                    else 
                    {
                    include("login.php");
                    }
                    ?>
            </div>
            <div class=" form-log ">
                    <?php
                        include("filter.php");
                        ?>         
               </div>
    </section>
    <div class="inline-block right-side">
        <section class="section-photo">
            <?php while($row = $sthandler->fetch(PDO::FETCH_ASSOC)) : ?>
            <div class="photo-box inline-block">
                <img src="<?php echo $row ['profile_foto']?>" class="photo-person">
            </div>
            <div class="inline-block rel">
                <div class="info">
                    <div class="info-info"><span class="key">First name: </span><?php echo $row ['first_name'] ?></div>
                    <div class="info-info"><span class="key">Last name: </span><?php echo $row ['last_name'] ?></div>
                    <div class="info-info"><span class="key">Age: </span><?php echo $row ['age'] ?> y.o</div>
                    <div class="info-info"><span class="key">City: </span><?php echo $row ['city'] ?></div>
                    <div class="info-info"><span class="key">Country: </span><?php echo $row ['country'] ?></div>
                    <div class="info-info"><span class="key">Height: </span><?php echo $row ['height'] ?></div>
                    <div class="info-info"><span class="key">Weight: </span><?php echo $row ['weight'] ?></div>
                    <div class="info-info"><span class="key">About me: </span><?php echo $row ['details'] ?></div>
                </div>
            <?php endwhile;?>
            </div>
            <form method="post" value="like">
                <?php
                    if(isset($_POST['like'])){
                    $like_to= $_GET['user_id'];
                    $like_from = $_SESSION['us_id'];
                    $pdo = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD);
                    $nRows = $pdo->query("select count(*) FROM likes WHERE like_to = '$like_to'")->fetchColumn(); 
                    if($nRows == 0){
                    $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
                    $ins = $con->prepare("INSERT INTO likes (like_from, like_to) VALUES ('$like_from', '$like_to')");
                    $ins->execute();
                    }
                    }
                ?>
                <div class="likes_amount inline-block">
                    <?php
                    $like_to= $_GET['user_id'];
                    $pdo = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD);
                    $nLikes = $pdo->query("select count(*) FROM likes WHERE like_to = '$like_to'")->fetchColumn(); 
                    echo $nLikes; 
                    ?>
                </div>
                <input class="like_none"  type="submit"  id="likek" name="like">
                <label for="likek" name="like" id="like" class="like inline-block"><i class="fas fa-heart"></i></label>
            </form>
           
            <div class="album">
                <?php
                include("fotos/view.php");
                ?>
            </div>
        </section>
        <h3 class="center">See also</h3>

        <section class="section-slide">
            <div id="_slick-icons">
            </div>
        </section>
    </div>
<script type="text/javascript" src="slick/slick.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
   
    <script src="jquery.ui.touch-punch.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
        jQuery("#_slick-icons").load("user_icon_1.php");
})
</script>




</body>
