<?php
session_start();
if(empty($_SESSION['us_id'])){
header('location:login.php');
}
$user_id = $_SESSION['us_id'];
include("config.php");
$con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
$sthandler = $con->prepare("SELECT TIMESTAMPDIFF(YEAR, `birth_date`, CURDATE()) AS age , first_name, last_name, country, city, details, height, weight, profile_foto FROM register_user WHERE user_id = '$user_id'");
$sthandler->execute();
?>

<head>
<title>LOVONEO | FIND YOUR LOVE</title><!--1-->
<link rel="stylesheet" href="style_personal_page.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<link rel="stylesheet" type="text/css" href="slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
<script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.3.js"></script>
</head>
<body>

<header class="head fixed">
    <div class="wrap rel">
    <div class="hamburger pull-left _hamburger">
                        <i class="fa fa-bars" aria-hidden="true"></i>
</div>
        <nav class=" hero-nav pull_left _nav">
        
            <ul class="list-unstyled ">
            <a class="active" href="index.php">Home |</a><!--2-->
            <a class="active" href="view_profile.php"> <?php 
            if (isset($_SESSION['user_name'])) {
                echo "Profile";
                echo '  |';} 
            ?>
            </a>
            <a class="active" href="message1/message.php"> <?php 
            if (isset($_SESSION['user_name'])) {
                echo "Message";/*14*/
                echo '  |';
            }
            ?>
            </a>
   

            <a class="active" href="personal_page_edit.php?user_activation_code=<?php echo $_SESSION['user_activation_code'];?>&&user_id=<?php echo $_SESSION['user_id'];?>">
            <?php
            if (isset($_SESSION['user_name'])) {
                echo "Edit profile";/*14*/
                echo '  |';
            }
            ?>
            </a>
            
            </ul>
        </nav>
        <div class="right_side_menu">
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


    <div class="wrap">
    <section class="section-control inline-block  rel">
        <div class="logo"></div>
            <div class="form-signin"  method="POST">
                    <?php
                    if(!isset($_SESSION['user_name']))
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


<div class="likes_amount">
<?php
$like_to = $_SESSION['us_id'];
$pdo = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD);
$nLikes = $pdo->query("select count(*) FROM likes WHERE like_to = '$like_to'")->fetchColumn(); 
echo "$nLikes people like your profile."; 
?>
</div>
            <div class="album">
                <?php
                include("fotos/view.php");
                ?>
            </div>
        </section>
    </div>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="slick/slick.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
   
    <script src="jquery.ui.touch-punch.min.js"></script>
<script>$('.ui-slider-handle').draggable();</script>
<script>
    $(function(){
        $('.radio1').change(function(){
             if($(this).val() == "female")
                $( "#r2-m" ).prop( "checked", true );
            else $( "#r2-f" ).prop( "checked", true );
        });
        $('.radio2').change(function(){
            if($(this).val() == "female")
                $( "#r1-m" ).prop( "checked", true );
            else $( "#r1-f" ).prop( "checked", true );
        });
    });
</script>
<script>
document.getElementById("amount").defaultValue = 18; 
document.getElementById("amount-2").defaultValue = 45;
</script>
<script>
$( function() {
    $( "#slider-range" ).slider({
      range: true,
      min: 18,
      max: 70,
      values: [ $("#amount").val(), $("#amount-2").val() ],
      slide: function( event, ui ) {
        $( "#amount" ).val(ui.values[ 0 ]  );
        $( "#amount-2" ).val(ui.values[ 1 ] );
        $( "#amount" ).value = ui.values[ 0 ];
        $( "#amount-2" ).value = ui.values[ 1 ];
      }
    });
    $( "#amount" ).val($( "#slider-range" ).slider( "values", 0 ) );
	$( "#amount-2" ).val($( "#slider-range" ).slider( "values", 1 ) );
  } );
$(document).ready(function(){
    	$("#amount").change(function(){
           $( "#amount" ).value = ui.values[ 0 ];
        });
   
        $("#amount-2").change(function(){
           $( "#amount-2" ).value = ui.values[ 1 ];
        });
    });
  </script>

<script type="text/javascript">
$(document).ready(function(){
        jQuery("#_slick-icons").load("user_icon_1.php");
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
