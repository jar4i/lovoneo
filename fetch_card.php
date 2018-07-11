<?php
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');

include("config.php");
$register_user_id=$_GET["register_user_id"];
$con= new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
$sthandler = $con->prepare("SELECT TIMESTAMPDIFF(YEAR, `birth_date`, CURDATE()) AS age , first_name, last_name, profile_foto FROM register_user WHERE register_user_id = '$register_user_id'");
$sthandler->execute();
?>
<?php while($row = $sthandler->fetch(PDO::FETCH_ASSOC)) : ?>

<div class="clearfix_card">
<img src="<?php echo $row ['profile_foto']?>"width="140" height="200"><br>
<?php echo $row ['first_name']?><br>
<?php echo $row ['last_name']?><br>
<?php endwhile;?>
</div>

<style>
.clearfix_card
{
display: inline-block;
margin: 50px;
border: inset 6px;
float: left;
width: 300px;
height: 300px;
}
</style>


