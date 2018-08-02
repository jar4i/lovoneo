
<?php
session_start();
if (isset($_POST['search'])) { 
$_SESSION['age1'] = $_POST['amount'];
        $_SESSION['age2'] = $_POST['amount-2'];
        $_SESSION['gender'] = $_POST['Radios2'];
}

?>
<?php
include("connection.php");
if(isset($_POST['en'])){$query = $conn->query("SELECT phrase FROM en");}
else{$query = $conn->query("SELECT phrase FROM de");}
$array = Array();

while($result = $query->fetch_assoc()){
    $array[] = $result['phrase'];
}

$_SESSION['array'] = $array;

?>
<head>

<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?php echo $array[0];?></title><!--1-->
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<link rel="stylesheet" type="text/css" href="slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
<script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.3.js"></script>
</head>
<body>
   <!-- <div class="bg"></div>-->
<header class="head fixed">
    <div class="wrap rel">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
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
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="right_side_menu">
                        <form method="post" class="active2">
                            <input class="active" name="en" value="en"  type="submit">
                            <input class="active" name="de" value="de"  type="submit">
                        </form>
                         <?php 
                            if (isset($_SESSION['user_name'])) {
                                echo "<a class='active2' href='view_profile.php'><div class='inlne-block profile_photo_menu_box'><img class='profile_photo_menu' src='".$_SESSION['profile_foto']."'> </div></a>";
                                echo "<a class='active2' href='view_profile.php'>";
                                echo ''.$_SESSION['first_name'];
                                echo '  |';
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
        </div>
    </div>
</header>
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="col-lg-3 col-md-12 col-sm-12">
                <div class="logo"></div>
            </div>
            <div class="col-lg-9 col-md-12 col-sm-12">
                <section class="section-slide">
                    <div id="_slick-icons">
                    </div>
                </section>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="col-lg-3  col-md-12 col-sm-12">
                <section class="section-control rel">
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
                    <div class="col-lg-12 <?php if(isset($_SESSION['user_name'])){ echo "col-md-12";} else { echo "col-md-6";} ?>  col-sm-6  col-xs-12">
                        <div class=" form-log ">
                        <?php
                            include("filter.php");
                            ?>         
                         </div>
                    </div>
                </section>
            </div>
            <div class="col-lg-9  col-md-12 col-sm-12">
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
    </div>
</div>


<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="slick/slick.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
        jQuery("#target-content").load("user_icon.php?page=1");
        jQuery("#_slick-icons").load("user_icon_1.php");
    $('._hamburger').click(function () {
        $('._nav').slideToggle();
    console.log('ham');
    });
});
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
