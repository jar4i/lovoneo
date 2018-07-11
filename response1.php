<?php

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');
session_start();
include('connection.php');

if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
$start_from = ($page-1) * $limit;  
  
$sql = "SELECT TIMESTAMPDIFF(YEAR, `birth_date`, CURDATE()) AS age , gender,  username, last_name, details, more_info, profile_foto FROM pers_data WHERE gender LIKE '%".$_SESSION['gender']."%'ORDER BY u_id ASC LIMIT $start_from, $limit";  
$rs_result = mysqli_query($conn, $sql); 
?>
<form class= "main_form">
<?php  

while ($row = mysqli_fetch_assoc($rs_result)) {
?>  

<div class="clearfix_card">
	<?php echo $row['profile_foto']; ?><br>
	
	  <?php echo $row['username']?><br>
	  <?php echo $row['last_name']?><br>
	  <a href="<?php echo $row['more_info']?>" class="btn btn-primary">More Info!</a>
	</div>

<?php  
};  
?>
</form> 
<style>

</style>
