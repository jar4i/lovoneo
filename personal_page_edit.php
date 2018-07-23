
<head>
<link rel="stylesheet" href="style.css">
</head>

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


<?php

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
echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
$insert_query="UPDATE register_user SET profile_foto = '$upload_image' WHERE user_activation_code = '$user_activation_code'";
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
echo "The changes in your profile are saved.";
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
<div class ="main">
                <div class="welcom" > <?php
session_start(); 
   if (isset($_SESSION['user_name'])) {
   echo 'Welcome, '.$_SESSION['user_name'];
}
echo'<br>';
echo'<a href="logout.php">LOGOUT</a>';
?>
</div>
<?php while($row = $sthandler->fetch(PDO::FETCH_ASSOC)) : ?>
<div class="clearfix_card"><img src = "<?php echo $row ['profile_foto']?>" width="140" height="200"><br>
<?php echo $row ['first_name']?><br>
<?php echo $row ['last_name']?><br>
</div>
<form class ="button_foto" action="" method="post" enctype="multipart/form-data">
Change your profile foto:
<input type="file" name="fileToUpload" id="fileToUpload">
<input type="submit" value="Upload Image" name="submit">
</form>
  <script src="croppie.js"></script>
  <link rel="stylesheet" href="croppie.css" />
   </head>
<div class="demo"></div>
	
	<script>
var el = document.getElementById('fileToUpload');
var vanilla = new Croppie(el, {
    viewport: {
        width: 150,
        height: 200
    },
    boundary: { width: 300, height: 300 },
    showZoomer: false,
    enableOrientation: true
});

vanilla.bind({
    url: document.getElementById('fileToUpload'), 
    points: [77,469,280,739]
});
vanilla.result('blob').then(function(blob) {
    // do something with cropped blob
});
</script>


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
<style>
.welcom
{
float: right;
border: solid 2px;
}
ul
{
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
}

li �
{
    float: left;
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover
{
    background-color: #111;
}

.main
{
border: solid 2px;
width: 1300px;
height: 1000px;
}
.button_foto{

margin: 10px;
border: inset 6px;

display: inline-block;
}
.clearfix_card
{
margin: 10px;
display: inline-block;
border: inset 6px;
float: left;
width: 300px;
height: 300px;
}

textarea
{
margin: 10px;
width: 640px;
height: 250px;
}
</style>








