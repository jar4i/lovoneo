
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="personal_page_edit.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css">
		<link rel="stylesheet" href="menu.css">
<link rel="shortcut icon" href="ico.png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
</head>
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
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');
$array = $_SESSION['array'];
if(empty($_GET["user_activation_code"])){
header('location:logout.php');
}
include("config.php");

if(isset($_POST["submit"])) {
$user_activation_code = $_GET["user_activation_code"];
$folder = "uploads/";
$upload_image = $folder . basename($_FILES["fileToUpload"]["name"]);
move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $upload_image);
$temp_img = imagecreatefromjpeg($upload_image);
$to_crop_array = array('x' =>$_COOKIE["x"], 'y' => $_COOKIE["y"], 'width' => $_COOKIE["width"], 'height'=> $_COOKIE["height"]);
$im2 = imagecrop($temp_img, $to_crop_array);
imagejpeg($im2, $folder . basename($_FILES["fileToUpload"]["name"]));
$update_img = ($folder . basename($_FILES["fileToUpload"]["name"]));
$con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
$insert_query="UPDATE register_user SET profile_foto = '$update_img' WHERE user_activation_code = '$user_activation_code'";
$stmt = $con->prepare($insert_query);
$stmt->execute();
$_SESSION['profile_foto'] = $update_img;
}

/*
$_SESSION['profile_foto'] = $upload_image;s
$folder = "123/";
$upload_image = $folder . basename($_FILES["fileToUpload"]["name"]);
move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $upload_image);
$temp_img = imagecreatefromjpeg($upload_image);
$to_crop_array = array('x' =>$_COOKIE["x"], 'y' => $_COOKIE["y"], 'width' => $_COOKIE["width"], 'height'=> $_COOKIE["height"]);
$im2 = imagecrop($temp_img, $to_crop_array);
imagejpeg($im2, '123/new1.jpeg');
*/

/*$to_crop_array = array('x' =>$_COOKIE["x"], 'y' => $_COOKIE["y"], 'width' => $_COOKIE["width"], 'height'=> $_COOKIE["height"]);
$im2 = imagecrop($upload_image, $to_crop_array);
imagejpeg($im2, '123/new.jpeg');
echo $update_img;
*/





?>
<?php
$user_activation_code= $_GET["user_activation_code"];
$u_id = $_SESSION['us_id'];
if(isset($_POST["save"])) {
$birth_date = $_POST['birth_date'];
$weight = $_POST['weight'];
$height = $_POST['height'];
$details = $_POST['details'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$country = $_POST['country'];
$city = $_POST['city'];
$insert_query="UPDATE register_user SET details = '$details', first_name = '$first_name', last_name = '$last_name', country = '$country', city ='$city', weight = '$weight', height = '$height', birth_date = '$birth_date' WHERE user_activation_code = '$user_activation_code' ";
$con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
$stmt = $con->prepare($insert_query);
$stmt->execute();
$_SESSION['first_name'] = $first_name;
}
?>
<?php 
$user_activation_code=$_GET["user_activation_code"];
$con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
$sthandler = $con->prepare("SELECT TIMESTAMPDIFF(YEAR, `birth_date`, CURDATE()) AS age, birth_date, city, weight, height, country, details, first_name, last_name, profile_foto FROM register_user  WHERE user_activation_code = '$user_activation_code'");
$sthandler->execute();
?>
<body><header class="head fixed">
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
    <section class="section_profile_photo mt-8">
        <div class="wrap">
    <?php while($row = $sthandler->fetch(PDO::FETCH_ASSOC)) : ?>
        <div class="container">
        <form class ="button_foto" action="" method="post" enctype="multipart/form-data">
                    <div class="clearfix_card rel">
                        <div class="prof_photo_box">
                            <img class="rounded prof_photo" id="avatar" src = "<?php echo $row ['profile_foto']?>" alt="avatar">
                        </div>
                        <a href="fucking_shit.php?user_activation_code=<?php echo $user_activation_code; ?>&&user_id=<?php echo $u_id;?>"  class="text_edit_box"> 
                            <div class="btn-add-photo"><i class="fas fa-camera"></i></div>
                            <div class="text_edit"> <?php echo $array[22];?></div>
                        </a>
                    </div>
                </form>
        </div>
        </div>
        </div>
    </section>
    <section class="section_question">
        <div class="wrap">
            <form action="" method="post" enctype="multipart/form-data" class="form_1">
                <div class="first_box" >
                    <div class="box_fack" onclick="Open('1')">
                        <div class="text"><?php echo $array[63];?> <i class="fas fa-pencil-alt"></i></div>
                        <div class="float-right ico_filter1" id="ic_11"><i class="fas fa-plus"></i></div>
                        <div class="float-right ico_filter2" id="ic_21"><i class="fas fa-minus"></i></div>
                    </div>
                    <div id="box_1" class="q_big_box">
                        <div class="form-group">
                            <label for="first_name"><?php echo $array[33];?>:</label>
                            <input class="input_info form-control" type="text" name="first_name" id="first_name"  value="<?php echo $row ['first_name']?>">
                        </div>
                        <div class="form-group">
                            <label for="last_name"><?php echo $array[34];?>:  </label>
                            <input type="text" class="input_info form-control" name="last_name" id="last_name"  value="<?php echo $row ['last_name']?>">
                        </div>
                        <div class="form-group">
                            <label for="country"><?php echo $array[35];?>:  </label>
                            <input type="text" class="input_info form-control" name="country" id="country"  value="<?php echo $row ['country']?>">
                        </div>
                        <div class="form-group">
                            <label for="city"><?php echo $array[36];?>: </label>
                            <input type="text" class="input_info form-control" name="city" id="city"  value="<?php echo $row ['city']?>">
                        </div>
                        <div class="form-group">
                            <label for="birth_date"><?php echo $array[30];?>: </label>
                            <input type="text" class="input_info form-control" name="birth_date" id="birth_date"  value="<?php echo $row ['birth_date']?>">
                        </div>
                    </div>
                </div>
                <div class="first_box">
                    <div class="box_fack" onclick="Open('2')">
                        <div class="text"  ><?php echo $array[64];?> <i class="fas fa-pencil-alt"></i></div>
                        <div class="float-right ico_filter1"   id="ic_12"><i class="fas fa-plus"></i></div>
                        <div class="float-right ico_filter2"   id="ic_22"><i class="fas fa-minus"></i></div>
                    </div>
                    <div id="box_2" class="q_big_box">
                        <div class="form-group">
                            <label for="weight"><?php echo $array[57];?>: </label>
                            <input type="text" class="input_info form-control" name="weight" id="weight"  value="<?php echo $row ['weight']?>">
                        </div>
                        <div class="form-group">
                        <label for="height"><?php echo $array[56];?>: </label>
                            <input type="text" class="input_info form-control" name="height" id="height"  value="<?php echo $row ['height']?>">
                        </div>
                    </div>
                </div>
                <div class="first_box" >
                    <div class="box_fack"  onclick="Open('3')">
                        <div class="text"><?php echo $array[65];?> <i class="fas fa-pencil-alt"></i></div>
                        <div class="float-right ico_filter1"  id="ic_13"><i class="fas fa-plus"></i></div>
                        <div class="float-right ico_filter2"  id="ic_23"><i class="fas fa-minus"></i></div>
                    </div>
                    <div id="box_3" class="q_big_box">
                        <div class="form-group">
                        <label for="details"><?php echo $array[68];?>: </label>
                            <textarea placeholder="<?php echo $array[42];?>..." class="form-control input_info" name="details" id="details" ><?php echo $row ['details']?></textarea>
                        </div>
                    </div>
                </div>
                <div class="btn_save_inf">
                        <input type="submit" value="<?php echo $array[41];?>" class="btn btn_violet " name="save" id="save">
                </div>
                    <?php endwhile;?>
            </form>
        </div>
    </section>
    <section class="section_drop_me">
        <div class="wrap">
            <div class="form_1">
                <div class="first_box" >
                    <div class="box_fack"  onclick="Open('4')">
                        <div class="text"><?php echo $array[39];?> <i class="fas fa-file-upload"></i></div>
                        <div class="float-right ico_filter1"  id="ic_14"><i class="fas fa-plus"></i></div>
                        <div class="float-right ico_filter2"  id="ic_24"><i class="fas fa-minus"></i></div>
                    </div>
                    <div id="box_4" class="q_big_box">
                        <?php include('albums/index.php');?>
                        <div class="btn_save_inf">
                            <input type="submit" value="<?php echo $array[41];?>" class="btn btn_violet" onClick="history.go(0)"  name="save" id="save">
                        </div>
                    </div>
                </div>
                
                <div class="first_box" >
                    <div class="box_fack"  onclick="Open('5')">
                        <div class="text"><?php echo $array[40];?> <i class="fas fa-trash-alt"></i></div>
                        <div class="float-right ico_filter1"  id="ic_15"><i class="fas fa-plus"></i></div>
                        <div class="float-right ico_filter2"  id="ic_25"><i class="fas fa-minus"></i></div>
                    </div>
                    <div id="box_5" class="q_big_box">
                        <div class = "view">
                            <?php
                            $user_id=$_SESSION["us_id"];
                            include('fotos/view1.php');?>
                        </div>
                        <div class="btn_save_inf">
                            <input type="submit" value="<?php echo $array[41];?>" class="btn btn_violet" name="save"  onClick="history.go(0)"  id="save">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.bundle.min.js"></script>
  
<script type="text/javascript">
$(document).ready(function(){
    $('._hamburger').click(function () {
        $('._nav').slideToggle();
    });
});
</script>
<script>
    function OpCl(numb){

        if($("#ic_1" + numb).css("display") == "none"){
            $("#ic_1" + numb).css("display", "block");
            $("#ic_2" + numb).css("display", "none");
         }
         else{
            $("#ic_2" + numb).css("display", "block");
            $("#ic_1" + numb).css("display", "none");
         };
    }
     function Open(numb){
         $("#box_" + numb).slideToggle();
         OpCl(numb);
};
</script>
</body>












