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
                <div class="form-signin "  method="POST">
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


<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="slick/slick.min.js"></script>

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
