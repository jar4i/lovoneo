<?php
session_start();
$array = $_SESSION['array'];
if(empty($_SESSION['us_id'])){
header('location:login_page.php');
}
$user_id = $_SESSION['us_id'];

include("config.php");
$con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
$sthandler = $con->prepare("SELECT TIMESTAMPDIFF(YEAR, `birth_date`, CURDATE()) AS age , first_name, last_name, country, city, details, height, weight, profile_foto FROM register_user WHERE user_id = '$user_id'");
$sthandler->execute();
?>

<head>
 <title>LOVONEO | FIND YOUR LOVE</title> <!--1 -->
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="menu.css">

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
        <div class="menu">
            <div class="menu_left">
                <div class="hamburger pull-left _hamburger">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                </div>
                <nav class=" hero-nav pull_left _nav">
                    <ul class="list-unstyled ">
                        <a class="active" href="index.php"><?php echo $array[1];?> |</a><!--2-->
                        <a class="active" href="search_form.php"><?php echo $array[19];?> |</a><!--2-->
                        <a class="active" href="view_profile.php"> <?php 
                        if (isset($_SESSION['user_name'])) {
                            echo $array[60];
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
                <input class="language1  language" name="en" value=""  type="submit">
                    <input class="language2  language" name="de" value=""  type="submit">
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
<br><br>
<section class="section_general wrap">
    <div class="sect_left">
        <div class="logo_box"><div class="logo"></div></div>
        <div class=" form-log ">
            <?php
            include("filter.php");
            ?>         
        </div>
    </div>
    <div class="sect_right">
        <div class="section-slide" >
            <div id="_slick-icons">
            </div>
            <br>
        </div> 
        <?php while($row = $sthandler->fetch(PDO::FETCH_ASSOC)) : ?>
        <div class="section-photo">
            <div class="myflex">
                <div class="big_box">
                    <div class="photo-box ">
                        <img src="<?php echo $row ['profile_foto']?>" class="photo-person">
                    </div>
                </div>
                <div class="info">
                    <p class="txt_name"><?php echo $row ['first_name'] ?> <?php echo $row ['last_name'] ?>, <?php echo $row ['age'] ?> y.o </p>
                    <?php if($row ['city'] != '' || $row ['country'] != ''){  ?>
                        <p class="txt_city"><?php echo $row ['city'] ?> <?php echo $row ['country'] ?> <i class="fas fa-map-marker-alt"></i> </p>
                    <?php } ?>
                    <div class="likes">
                            <a href="message1/message.php" class="btn btn-danger btn_send"><?php echo $array[13]; ?></a>
                            <div><?php echo $array[67]; ?></div>
                            <a href="personal_page_edit.php?user_activation_code=<?php echo $_SESSION['user_activation_code'];?>&&user_id=<?php echo $_SESSION['user_id'];?>" class="btn btn-danger btn_send"><?php echo $array[2]; ?></a>
                    </div> 
                    <!-- <div class="info-info"><span class="key"><?php echo $array[56]; ?>: </span><?php echo $row ['height'] ?></div>
                    <div class="info-info"><span class="key"><?php echo $array[57]; ?>: </span><?php echo $row ['weight'] ?></div>
                    <div class="info-info"><span class="key"><?php echo $array[38]; ?>: </span><?php echo $row ['details'] ?></div> -->
                    <?php if($row ['details'] != ''){  ?>
                        <div class="keframe_div">
                            <p class="txt_status"><?php echo $array[68]; ?>:</p>
                            <?php echo $row ['details'] ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <?php endwhile;?>
            <div class="album">
                <?php  
                include("fotos/view.php");
                ?>
            </div> 
        </div>
    </div>
</div>
<script type="text/javascript" src="slick/slick.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
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

<script type="text/javascript">

$(document).ready(function(){
        jQuery("#_slick-icons").load("user_icon_2.php");
})
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
    $('._hamburger').click(function () {
        $('._nav').slideToggle();
    });
});
</script>
</body>
