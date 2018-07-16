<?php
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');
include('connection.php');

if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
$start_from = ($page-1) * $limit;  
  
$sql = "SELECT TIMESTAMPDIFF(YEAR, `birth_date`, CURDATE()) AS age , first_name, user_id, last_name, details, country, city,  profile_foto FROM register_user ORDER BY rand(register_user_id)  ASC LIMIT $start_from, $limit";  
$rs_result = mysqli_query($conn, $sql);
 
?>

<?php  
while ($row = mysqli_fetch_assoc($rs_result)) :
?>  
<div>
<div class="rel card">
    <a href="personal_page.php?user_id=<?php echo $row['user_id'];?>" >
		<img src="<?php echo $row['profile_foto']; ?>" class="card-photo">
		<div class="small-info" >
			  	<?php echo $row['first_name']?>,
				  <?php echo $row['age']?>
				  <p id="card-country"><?php echo $row['country']?></p>
		</div>
	</a>
</div>
</div>
   <?php
endwhile; 
?>
  
</div>

    
 

<!--
<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 card-container">
	<div class="rel card">
		<a href="personal_page.php?user_id=<?php echo $row['user_id'];?>" >
			<img src="<?php echo $row['profile_foto']; ?>" class="card-photo">
			<div class="small-info" >
				  	<?php echo $row['first_name']?>,
					  <?php echo $row['age']?>
					  <p id="card-country"><?php echo $row['country']?></p>
			</div>
		</a>

	</div>
</div>

-->



