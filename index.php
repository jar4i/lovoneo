

<?php
$useragent=$_SERVER['HTTP_USER_AGENT'];

if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i|/ipad/i',substr($useragent,0,4)))

header('Location: https://m.lovoneo.com/');

?>
<?php

session_start();
include("connection.php");
if(isset($_POST['de'])){$_SESSION['lang'] = 1;}
else if(isset($_POST['en'])){$_SESSION['lang'] = 2;}
if($_SESSION['lang'] == 1){$query = $conn->query("SELECT * FROM de");}
else if($_SESSION['lang'] == 2){$query = $conn->query("SELECT * FROM en");}
else{$query = $conn->query("SELECT * FROM de");} 
$array = Array();
echo $_SESSION['lang'];
while($result = $query->fetch_assoc()){
$array[] = $result['phrase'];
$_SESSION['array'] = $array;
}
?>

<?php


if (isset($_POST['search'])) { 
$_SESSION['age1'] = $_POST['amount'];
        $_SESSION['age2'] = $_POST['amount-2'];
        $_SESSION['gender'] = $_POST['Radios2'];
}

?>
<?php

?>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="menu.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<link rel="stylesheet" type="text/css" href="slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
<link rel="shortcut icon" href="ico.png">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
<script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.3.js"></script>
</head>
<body>
   <!-- <div class="bg"></div>-->
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
<br>
<br>
<section class="section_general wrap">
    <div class="sect_left">
        <div class="logo_box"><div class="logo"></div></div>
        <div class="section-control rel">
                <?php
                    if(!isset($_SESSION['user_name']))
                    {?>
                    <div class="form-signin"  method="POST">
                        <?php
                        include("login.php");
                        ?>
                    </div>
                <?php } ?>
                    <div class=" form-log ">
                    <?php
                        include("filter.php");
                        ?>         
                        </div>
        </div>
    </div>
    <div class="sect_right">
        <div class="logo_box2"><div class="logo"></div></div>
        <div class="section-slide">
            <div id="_slick-icons">
            </div>
        </div>
        <div class="section-control2 rel">
                <?php
                    if(!isset($_SESSION['user_name']))
                    {?>
                    <div class="form-signin"  method="POST">
                        <?php
                        include("login.php");
                        ?>
                    </div>
                <?php } ?>
        </div>
        <div class=" section-pages rel">
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
    </div>
</section>
           
          

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
