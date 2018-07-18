<?php
session_start();
if (isset($_POST['search'])) { 
$_SESSION['age1'] = $_POST['amount'];
            $_SESSION['age2'] = $_POST['amount-2'];
            $_SESSION['gender'] = $_POST['Radios2'];
} 
?>
<head>
<title>LOVONEO | FIND YOUR LOVE</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<link rel="stylesheet" type="text/css" href="slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
<script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.3.js"></script>
</head>
<body>
   <!-- <div class="bg"></div>-->
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
<div class="wrap">
    <section class="section-control inline-block  rel">
        <div class="logo"></div>
        <div class="container">
            <div class="row">
                <div class="form-signin col-md-12"  method="POST">
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
                <div class=" form-log col-md-12">
    		    <div class="panel panel-2 panel-default">
    			        <div class="panel-body">
                            <form class="search rel" action="search_form.php" method="post">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12 rel">
                                            <h4 class="center search-text">I'm</h4>
                                            <div class="labeles-div">
                                                <label class="labeles">
                                                    <input class="radio radio1" type="radio" name="Radios1" id="r1-m" value="male" <?php if (isset($_POST[ 'Radios1']) && $_POST[ 'Radios1']=='male' ){echo ' checked="checked"';}?>>
                                                    <span class="radio-custom"></span>
                                                    <div class="label">Man</div>
                                                </label>
                                                <label class="labeles">
                                                    <input class="radio radio1" type="radio" name="Radios1" id="r1-f" value="female" <?php if (isset($_POST[ 'Radios1']) && $_POST[ 'Radios1']=='female' ){echo ' checked="checked"';}?>>
                                                    <span class="radio-custom"></span>
                                                    <div class="label">Woman</div>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-12 rel">
                                            <h4 class="center  search-text">I'm looking for</h4>
                                            <div class="labeles-div">
                                                <label class="labeles">
                                                    <input class="radio radio2" type="radio" name="Radios2" id="r2-m" value="male" <?php if (isset($_POST[ 'Radios2']) && $_POST[ 'Radios2']=='male' ){echo ' checked="checked"';}?>>
                                                    <span class="radio-custom"></span>
                                                    <div class="label">Man</div>
                                                </label>
                                                <label class="labeles">
                                                    <input class="radio radio2" type="radio" name="Radios2" id="r2-f" value="female" <?php if (isset($_POST[ 'Radios2']) && $_POST[ 'Radios2']=='female' ){echo ' checked="checked"';}?>>
                                                    <span class="radio-custom"></span>
                                                    <div class="label">Woman</div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="slider">
                                    <p class="center slider-age">Choose age</p>
                                    <div class="rel">
                                      <input type="text" class="inputs-age" name ="amount" id="amount" value="<?php echo isset($_POST['amount']) ? $_POST['amount'] : '' ?>" readonly>
                                      <input type="text" class="inputs-age" name ="amount-2" id="amount-2" value="<?php echo isset($_POST['amount-2']) ? $_POST['amount-2'] : '' ?>" readonly>
                                    </div>
                                    <div id="slider-range"></div>
                                </div>
                                <div class="form-group search-btn-block">
                                    <input class="search-btn btn btn-lg btn-danger" id="search" onclick="location.href = 'search_form.php';" type="submit" name="search" value="Search">
                                </div>
                            </form>
    			        </div>
    		        </div>
    	        </div>
            </div>
        </div>
    </section>
    <div class="inline-block right-side">
        <section class="section-slide">
            <div id="_slick-icons">
            </div>
        </section>

        <section class="section-pages rel">
            <div id="target-content" class="clearfix"></div>
            <?php
                include('connection.php');
                $countSql = "SELECT COUNT(register_user_id) FROM register_user";
                $tot_result = mysqli_query($conn, $countSql);
                $row = mysqli_fetch_row($tot_result);
                $total_records = $row[0];
                $total_pages = ceil($total_records / $limit);
            ?>
            <div class="pagination_main rel">
                <ul class='pagination' id="pagination">
                    <?php if(!empty($total_pages)):for($i=1; $i<=$total_pages; $i++):  
                    if($i == 1):?>
                    <li class='page-item active'  id="<?php echo $i;?>"><a href='user_icon.php?page=<?php echo $i;?>' class="page-link"><?php echo $i;?></a></li> 
                    <?php else:?>
                    <li id="<?php echo $i;?>" class="page-item"><a href='user_icon.php?page=<?php echo $i;?>' class="page-link"><?php echo $i;?></a></li>
                    <?php endif;?>
                    <?php endfor;endif;?>
                </ul>
            </div>
        </section>
    </div>
</div>


<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="slick/slick.min.js"></script>
<script>$('#slider-range').draggable();</script>
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
        jQuery("#target-content").load("user_icon.php?page=1");
        jQuery("#_slick-icons").load("user_icon_1.php");
})
</script>

<script>
jQuery("#pagination li").on('click',function(e){
 e.preventDefault();
 jQuery("#target-content").html('loading...');
 jQuery("#pagination li").removeClass('active');
 jQuery(this).addClass('active');
        var pageNum = this.id;
        jQuery("#target-content").load("user_icon.php?page=" + pageNum);
});

</script>

</body>
