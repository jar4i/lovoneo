<?php
session_start();
if (isset($_POST['search'])) { 
$_SESSION['age1'] = $_POST['age1'];
$_SESSION['age2'] = $_POST['age2'];
$_SESSION['gender'] = $_POST['gender'];
$_SESSION['state'] = $_POST['state'];
} 
?>
<head>
<title>LOVONEO | FIND YOUR LOVE</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
<link rel="stylesheet" href="style.css">

<link rel="stylesheet" type="text/css" href="slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
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
<section class="section-slide">
    <div class="wrap">
        <div class="responsive" id="_slick-icons">
            <div> <img src="uploads/1.png" class="card-photo"> </div>
            <div> <img src="uploads/19.jpg" class="card-photo"> </div>
            <div> <img src="uploads/21.jpg" class="card-photo"> </div>
            <div> <img src="uploads/20.jpg" class="card-photo"> </div>
            <div> <img src="uploads/17.jpg" class="card-photo"> </div>
            <div> <img src="uploads/21.jpg" class="card-photo"> </div>
            <div> <img src="uploads/18.jpg" class="card-photo"> </div>
        </div>
    </div>
</section>
<section class="section-control rel">
    <div class="wrap">
        <div class="container">
            <div class="row">
                <div class="form-signin col-md-5"  method="POST">
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
                <div class="col-md-7">
                    <div class="filter-name">Filter</div>
                    <form class="search rel" action="search_form.php" method="post">
                        <div class="form-group inline-block">
                            <input class="form-control age-from" list="age" autocomplete="off" id="age1" type="text" name="age1" value="<?php echo isset($_POST['age1']) ? $_POST['age1'] : '' ?>" placeholder="Age from, years">
                        </div>
                        <div class="form-group inline-block">
                            <input class="form-control age-to" list="age" autocomplete="off" id="age2" type="text" name="age2" value="<?php echo isset($_POST['age2']) ? $_POST['age2'] : '' ?>" placeholder="Age to, years">
                        </div>
                        <div class="form-group">
                            <input class="form-control gender" id="gender" type="text" name="gender"  value="<?php echo isset($_POST['gender']) ? $_POST['gender'] : '' ?>" placeholder="Gender">
                        </div>
                        <div class="form-group">
                            <input class="form-control state" list="state1" autocomplete="off" id="state" type="text" name="state"value="<?php echo isset($_POST['state']) ? $_POST['state'] : '' ?>" placeholder="State">
                        </div>
                        <div class="form-group">
                            <input class="search-btn btn btn-lg btn-dark" id="search" onclick="location.href = 'search_form.php';" type="submit" name="search" value="Search">
                        </div>
                        <datalist id="age">
                            <?php
                            for($i = 18; $i <= 100; $i += 1){
                                 echo("<option value='{$i}'>");}
                            ?>
                        </datalist>
                        <datalist id="state1">
                        <option value="USA">
                        <option value="Germany">
                        <option value="Ukraine">
                        <option value="Russia">
                        </datalist>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section-pages rel">
    <div class="wrap">
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
    </div>
</section>


<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="slick/slick.min.js"></script>
<script type="text/javascript">
   
$(document).ready(function(){
    $('.responsive').slick({
  infinite: false,
  autoplay: true,
  speed: 300,
  slidesToShow: 6,
  slidesToScroll: 4,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});
});
</script>
<script type="text/javascript">
$(document).ready(function(){
        jQuery("#target-content").load("user_icon.php?page=1");
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