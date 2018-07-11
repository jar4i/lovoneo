
<head>

</head>

<ul>
  <li><a class="active" href="https://lovoneo.com">Home</a></li>
  <li><a href="#news">News</a></li>
  <li><a href="#contact">Contact</a></li>
  <li><a href="#about">About</a></li>
</ul>



<?php

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');

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

li Ð
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








