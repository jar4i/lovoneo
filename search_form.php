<?php
session_start();
$array = $_SESSION['array'];
$user_id=$_GET["user_id"];
include("config.php");
$con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
$sthandler = $con->prepare("SELECT TIMESTAMPDIFF(YEAR, `birth_date`, CURDATE()) AS age , first_name, last_name, country, city, details, height, weight, profile_foto FROM register_user WHERE user_id = '$user_id'");
$sthandler->execute();
?>
<head>

<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="menu.css">
    <link rel="stylesheet" href="style-search.css">
<title>LOVONEO | FIND YOUR LOVE</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
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
<div class="container">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <br>
                <br>
                <div class="logo"></div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12">
                <section class="section-slide">
                    <div id="_slick-icons">
                    </div>
                </section>
                <br>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12  col-xs-12  section-control ">
                        <div class=" form-log ">
                        <?php
                                if (isset($_POST['search'])){
                                $_SESSION['age1'] = $_POST['amount'];
                                $_SESSION['age2'] = $_POST['amount-2'];
                                $_SESSION['gender'] = $_POST['Radios2'];
                                }
                            ?>
                        <?php
                            include("filter.php");
                            ?>         
                         </div>
            </div>
        <div class=" col-lg-12 col-md-12 col-sm-12  col-xs-12  ">
            <div class="section-cards">
                <div id="target-content" class="clearfix"></div>
                <div class="pagination_main rel">
                    <?php
                    error_reporting(E_ALL | E_STRICT);
                    ini_set('display_errors', 'On');

                    include('connection.php');
                    //for total count data
                    $countSql = "SELECT COUNT(register_user_id) FROM register_user WHERE gender LIKE '%".$_SESSION['gender']."%' AND TIMESTAMPDIFF(YEAR, `birth_date`, CURDATE()) BETWEEN ".$_SESSION['age1']." AND ".$_SESSION['age2']."";  
            
                    
                    $tot_result = mysqli_query($conn, $countSql);  
                    $row = mysqli_fetch_row($tot_result);  
                    $total_records = $row[0];  
                    $total_pages = ceil($total_records / $limit);
                    ?>
                    <ul class='pagination' id="pagination">
                        <?php if(!empty($total_pages)):for($i=1; $i<=$total_pages; $i++):  
                        if($i == 1):?>
                        <li class='page-item active'  id="<?php echo $i;?>"><a href='search_form_response.php?page=<?php echo $i;?>' class="page-link"><?php echo $i;?></a></li> 
                        <?php else:?>
                        <li id="<?php echo $i;?>" class="page-item"><a href='search_form_response.php?page=<?php echo $i;?>' class="page-link"><?php echo $i;?></a></li>
                        <?php endif;?>
                        <?php endfor;endif;?>
                    </ul>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="slick/slick.min.js"></script>
<script>$('.ui-slider-handle').draggable();</script>
<script>
     $(function(){
        var gender = "";
        $('.radio1').change(function(){
             if($(this).val() == "female"){
                $( "#r2-m" ).prop( "checked", true );
                gender = "male";
             }
            else {
                $( "#r2-f" ).prop( "checked", true );
                gender = "female";}
        });
        $('.radio2').change(function(){
            gender = $(this).val();
            if($(this).val() == "female")
                $( "#r1-m" ).prop( "checked", true );
            else $( "#r1-f" ).prop( "checked", true );
        });
    });
</script>
<script>
var php_amount = <?php echo json_encode($_SESSION['age1']); ?>;
var php_amount_2 = <?php echo json_encode($_SESSION['age2']); ?>;
document.getElementById("amount").value = php_amount; 
document.getElementById("amount-2").value = php_amount_2;
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

<script type="text/javascript" src="slick/slick.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
    	jQuery("#target-content").load("search_form_response.php?page=1");
        jQuery("#_slick-icons").load("user-icon-1-search.php");
    })
    </script>

    <script>
    jQuery("#pagination li").on('click',function(e){
     e.preventDefault();
     jQuery("#target-content").html('loading...');
     jQuery("#pagination li").removeClass('active');
     jQuery(this).addClass('active');
            var pageNum = this.id;
            jQuery("#target-content").load("search_form_response.php?page=" + pageNum);
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
