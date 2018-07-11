<?php

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');
session_start();
include('connection.php');

if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
$start_from = ($page-1) * $limit;  
  
$sql = "SELECT TIMESTAMPDIFF(YEAR, `birth_date`, CURDATE()) AS age , gender,  user_id, first_name, last_name, details, profile_foto FROM register_user WHERE gender LIKE '%".$_SESSION['gender']."%'ORDER BY user_id ASC LIMIT $start_from, $limit";  
$rs_result = mysqli_query($conn, $sql); 
?>
<form class= "main_form">
<?php  

while ($row = mysqli_fetch_assoc($rs_result)) :
?>  

<div class="clearfix_card">
	<img src = "<?php echo $row['profile_foto']; ?>"><br>
	
	  <?php echo $row['first_name']?><br>
	  <?php echo $row['last_name']?><br>
	  <a href="personal_page.php?user_id=<?php echo $row['user_id']?>" class="btn btn-primary">More Info!</a>
	</div>
<?php
endwhile;
?>
</form> 
<style>

</style>
