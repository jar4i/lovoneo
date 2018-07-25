
<head>
    <link rel="stylesheet" href="personal_page_edit.css">
    <link rel="stylesheet" href="croppie.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
    <script src="croppie.js"></script>
</head>
<?php
session_start();
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');
if(empty($_GET["user_activation_code"])){
header('location:logout.php');
}
include("config.php");
$user_activation_code= $_GET["user_activation_code"];
$folder = "uploads/";
$upload_image = $folder . basename($_FILES["fileToUpload"]["name"]);
if(isset($_POST["submit"])) {
if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $upload_image)) {
$insert_query="UPDATE register_user SET profile_foto = '$upload_image' WHERE user_activation_code = '$user_activation_code'";
$_SESSION['profile_foto'] = $upload_image;
$con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
$con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
$stmt = $con->prepare($insert_query);
$stmt->execute();
}
}
?>
<?php
$user_activation_code= $_GET["user_activation_code"];
if(isset($_POST["save"])) {
$_POST['details'];
$_POST['first_name'];
$_POST['last_name'];
$_POST['country'];
$_POST['city']; 
$details = $_POST['details'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$country = $_POST['country'];
$city = $_POST['city'];
$insert_query="UPDATE register_user SET details = '$details', first_name = '$first_name', last_name = '$last_name', country = '$country', city ='$city'  WHERE user_activation_code = '$user_activation_code' ";
$con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
$con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
$stmt = $con->prepare($insert_query);
$stmt->execute();
}
?>
<?php 
$user_activation_code=$_GET["user_activation_code"];
$con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
$con= new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
$sthandler = $con->prepare("SELECT TIMESTAMPDIFF(YEAR, `birth_date`, CURDATE()) AS age, city, country,  details, first_name, last_name, profile_foto FROM register_user  WHERE user_activation_code = '$user_activation_code'");
$sthandler->execute();
?>
<body>
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
                    ?>
            </div>
        </div>
    </header>
    <section class="section_profile_photo mt-8">
        <div class="wrap">
            <?php while($row = $sthandler->fetch(PDO::FETCH_ASSOC)) : ?>
            <div class="clearfix_card rel">
                <div class="prof_photo_box">
                    <img src = "<?php echo $row ['profile_foto']?>" class="prof_photo">
                </div>
                <div class="btn-add-photo"><i class="fas fa-plus"></i></div>
            </div>
            <form class ="button_foto" action="" method="post" enctype="multipart/form-data">
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="submit" value="Upload Image" name="submit">
            </form>
        </div>
    </section>

<script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>


</body>


	
<!-- 
<div class="demo"></div>

<form action="" method="post" enctype="multipart/form-data">
<textarea name="details"><?php echo $row ['details']?></textarea>
<div class="input_block"><label for="first_name">First name: </label><input type="text" name="first_name" id="first_name"  value="<?php echo $row ['first_name']?>"><br>
<label for="last_name">Last name: </label><input type="text" name="last_name" id="last_name"  value="<?php echo $row ['last_name']?>"><br>
<label for="country">State: </label><input type="text" name="country" id="country"  value="<?php echo $row ['country']?>"><br>
<label for="city">City: </label><input type="text" name="city" id="city"  value="<?php echo $row ['city']?>"><br>
</div>
<input type="submit" value="save info" name="save" id="save">
</form>
</div>
<?php endwhile;?>

<div class = "album">
<?php include('fotos/index.php');
	include('fotos/upload.php');?>
</div>
<div class = "view">

<?php
$user_id=$_GET["user_id"];
include('fotos/view.php');?>
</div>
-->







