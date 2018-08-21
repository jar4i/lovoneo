<?php
session_start();
$user_id=$_GET["user_id"];
include("config.php");
include("connection.php");
if(isset($_POST['en'])){$query = $conn->query("SELECT phrase FROM en");}
else{$query = $conn->query("SELECT phrase FROM de");}
$array = Array();
$_SESSION['array'] = $array;

while($result = $query->fetch_assoc()){
    $array[] = $result['phrase'];
}
$con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
$sthandler = $con->prepare("SELECT TIMESTAMPDIFF(YEAR, `birth_date`, CURDATE()) AS age , first_name, last_name, country, city, details, height, weight, profile_foto FROM register_user WHERE user_id = '$user_id'");
$sthandler->execute();
?>

<head>
<title>LOVONEO | FIND YOUR LOVE</title><!--1-->
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="menu.css">
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
    <div class="wrap rel">
        <div class="menu">
            <div class="menu_left">
                <div class="hamburger pull-left _hamburger">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                </div>
                <nav class=" hero-nav pull_left _nav">
                    <ul class="list-unstyled ">
                        <a class="active" href="index.php"><?php echo $array[1];?> |</a><!--2-->
                        <a class="active" href="view_profile.php"> <?php 
                        if (isset($_SESSION['user_name'])) {
                            echo "Profile";
                            echo '  |';} 
                        ?>
                        </a>
                        <a class="active" href="message1/message.php"> <?php 
                        if (isset($_SESSION['user_name'])) {
                            echo $array[13];
                            echo '  |';
                        }
                        ?>
                        </a>
                        <a class="active" href="personal_page_edit.php?user_activation_code=<?php echo $_SESSION['user_activation_code'];?>&&user_id=<?php echo $_SESSION['user_id'];?>">
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
                        echo "<a class='active2 rel' href='view_profile.php'>
                                <div class='inlne-block profile_photo_menu_box'>
                                    <img class='profile_photo_menu' src='".$_SESSION['profile_foto']."'> 
                                </div>
                            </a>";
                        echo "<a class='active2' href='view_profile.php'>";
                        echo ''.$_SESSION['first_name'];
                        echo "</a>";
                    }
                    ?> 
                <a class="active2" >
                    <?php 
                    if (isset($_SESSION['user_name'])) {
                        echo"<a href='logout.php'>$array[3]</a>";/*4*/
                    }
                    else echo "<a href='login_page.php'>$array[4]</a>";/*5*/
                    ?>
                </a>
            </div>
        </div>
    </div>
</header>
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-12">
            <div class="section-control rel">
                <div class="containeer">
                    <div class="row section-control rel">
                        
                        <div class="col-lg-12  col-md-12 ">
                             <div class="logo"></div>
                        </div>
                        <?php
                            if(!isset($_SESSION['user_name']))
                            {?>
                        <div class="col-lg-12  col-md-6 col-sm-6  col-xs-12">
                            <div class="form-signin"  method="POST">
                                <?php
                                include("login.php");
                                ?>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="col-lg-12 <?php if(isset($_SESSION['user_name'])){ echo "col-md-12 col-sm-12";} else { echo "col-md-6 col-sm-6 ";} ?>   col-xs-12">
                            <div class=" form-log ">
                            <?php
                                include("filter.php");
                                ?>         
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-12">
            <?php while($row = $sthandler->fetch(PDO::FETCH_ASSOC)) : ?>
            <div class="section-photo">
                <div class="row">
                    <div class="col-lg-5 col-md-5  col-sm-5 col-xs-12">
                        <div class="photo-box ">
                            <img src="<?php echo $row ['profile_foto']?>" class="photo-person">
                        </div>
                        <form method="post" value="like" id="likes">
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
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
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
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="album">
                            <?php  
                            include("fotos/view.php");
                            ?>
                        </div> 
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h3 class="center">See also</h3><!--21-->
                        <div class="section-slide" id="section-slide">
                            <div id="_slick-icons">
                            </div>
                        </div> 
                        <br>
                        <br>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="slick/slick.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
   
    <script src="jquery.ui.touch-punch.min.js"></script>

<script type="text/javascript">

$(document).ready(function(){
        jQuery("#_slick-icons").load("user_icon_2.php");
})
</script>

<script type="text/javascript">
$(document).ready(function(){
    $('._hamburger').click(function () {
        $('._nav').slideToggle();
    });
});
</script>



</body>
