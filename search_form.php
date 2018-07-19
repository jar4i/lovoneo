
<head>
<title>LOVONEO | FIND YOUR LOVE</title>
<link rel="stylesheet" href="style-search.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<link rel="stylesheet" type="text/css" href="slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
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

<section class="section-slide">
    <div class="wrap">
        <div id="_slick-icons">
        </div>
    </div>
</section>
<section class="section-control">
    <div class="wrap">
        <?php
        session_start();
            if (isset($_POST['search'])){
            $_SESSION['age1'] = $_POST['amount'];
            $_SESSION['age2'] = $_POST['amount-2'];
            $_SESSION['gender'] = $_POST['Radios2'];
            }
        ?>
        <div class="search-container">
            <form class="search rel" action="search_form.php" method="post">
                <div class="inline-block conter rel">
                    <div class="inline-block search-text">I'm</div>
                    <div class="inline-block labeles-container">
                        <label class="labeles block">
                            <input class="radio radio1" type="radio" name="Radios1" id="r1-m" value="male" <?php if (isset($_POST[ 'Radios1']) && $_POST[ 'Radios1']=='male' ){echo ' checked="checked"';}?>>
                            <span class="inline-block radio-custom"></span>
                            <div class="inline-block label-r">Man</div>
                        </label>
                        <label class="labeles block">
                            <input class="radio radio1" type="radio" name="Radios1" id="r1-f" value="female" <?php if (isset($_POST[ 'Radios1']) && $_POST[ 'Radios1']=='female' ){echo ' checked="checked"';}?>>
                            <span class="inline-block radio-custom"></span>
                            <div class="inline-block label-r">Woman</div>
                        </label>
                    </div>
                </div>
                <div class="inline-block conter conter-2 rel">
                    <div class="inline-block search-text" >I'm looking for</div>
                    <div class="inline-block labeles-container" id="labeles-container">
                        <label class="labeles block">
                            <input class="radio radio2" type="radio" name="Radios2" id="r2-m" value="male" <?php if (isset($_POST[ 'Radios2']) && $_POST[ 'Radios2']=='male' ){echo ' checked="checked"';}?>>
                            <span class="inline-block radio-custom"></span>
                            <div class="inline-block label-r">Man</div>
                        </label>
                        <label class="labeles block">
                            <input class="radio radio2" type="radio" name="Radios2" id="r2-f" value="female" <?php if (isset($_POST[ 'Radios2']) && $_POST[ 'Radios2']=='female' ){echo ' checked="checked"';}?>>
                            <span class="inline-block radio-custom"></span>
                            <div class="inline-block label-r">Woman</div>
                        </label>
                    </div> 
                </div>
                
                <div class="inline-block rel conter conter-3">
                    <div class="inline-block search-text">Age</div>
                    <div class="inline-block slider">
                        <input type="text" class="inputs-age" name ="amount" id="amount" value="<?php echo isset($_POST['amount']) ? $_POST['amount'] : '' ?>" readonly>
                        <input type="text" class="inputs-age" name ="amount-2" id="amount-2" value="<?php echo isset($_POST['amount-2']) ? $_POST['amount-2'] : '' ?>" readonly>
                        <div id="slider-range"></div>
                    </div>
                </div>
                <div class="inline-block conter rel">
                    <div class="inline-block search-btn-container">
                        <input class="btn btn-lg btn-danger" id="search" type="submit" name="search" value="Search">
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<section class="section-pages rel">
    <div class="wrap">
        <div id="target-content" class="clearfix"></div>
        <div class="pagination_main rel">
            <?php
             error_reporting(E_ALL | E_STRICT);
             ini_set('display_errors', 'On');

             include('connection.php');
             //for total count data
             $countSql = "SELECT COUNT(u_id) FROM pers_data";  
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
</section>

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

<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
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

</body>
