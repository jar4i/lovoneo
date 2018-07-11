<?php

$user_id=$_GET["user_id"];
include("config.php");
$con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
$sthandler = $con->prepare("SELECT TIMESTAMPDIFF(YEAR, `birth_date`, CURDATE()) AS age , first_name, last_name, profile_foto FROM register_user WHERE user_id = '$user_id'");
$sthandler->execute();
?>
<?php while($row = $sthandler->fetch(PDO::FETCH_ASSOC)) : ?>

<div class="clearfix_card">
<?php echo $row ['profile_foto']?><br>
<?php echo $row ['first_name']?><br>
<?php echo $row ['last_name']?><br>
<?php endwhile;?>
</div>

<div class="album">
<?php
include("fotos/view.php");
?>
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


