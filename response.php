<?php
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');
include('connection.php');

if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
$start_from = ($page-1) * $limit;  
  
$sql = "SELECT TIMESTAMPDIFF(YEAR, `birth_date`, CURDATE()) AS age , first_name, last_name, details, register_user_id,  profile_foto FROM register_user ORDER BY register_user_id  ASC LIMIT $start_from, $limit";  
$rs_result = mysqli_query($conn, $sql);
 
?>
<form class= "main_form">
<?php  

while ($row = mysqli_fetch_assoc($rs_result)) :
?>  

<div class="clearfix_card">

	<img src="<?php echo $row['profile_foto']; ?>" width="140" height="200"><br>

	
	  <?php echo $row['first_name']?><br>
	  <?php echo $row['last_name']?><br>
	  <a href="fetch_card.php?register_user_id=<?php echo $row['register_user_id']?>" class="btn btn-primary">More Info!</a>
	</div>


<?php
endwhile; 
?>
</form> 
<style>

</style>
