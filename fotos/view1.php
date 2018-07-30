<!DOCTYPE html>
<html lang="en">
	<header>
		
		
		
		<!-- Bootstrap -->
		<link href="fotos/css/bootstrap.min.css" rel="stylesheet">
		<style>
			.images{
				width:150px;
				height:150px;
				cursor:pointer;
				margin:10px;
			}
			.images:hover{
				-webkit-transform: scale(1.2);
				-moz-transform: scale(1.2);
				-o-transform: scale(1.2);
				transform: scale(1.2);
				transition: all 0.3s;
				-webkit-transition: all 0.3s;
			}
		</style>
	</header>
	<body>
		<div class="container">			
			
			<div class="panel panel-default">
				<div class="panel-body">
					<h3>Uploaded Fotos:</h3>
					<br/>
	
								<?php
		
		if(isset($_POST['delete_conf']))
{
$del_id = $_POST['delete'];
$delete_query="DELETE FROM files WHERE id = '$del_id'";
$con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
$con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
$stmt = $con->prepare($delete_query);
$stmt->execute();
}
?>
					<?php 
						$conn = mysqli_connect("localhost","lovoneo","ZMaLPF2-unV-ch","projekt");
						
						$query = "SELECT * FROM files WHERE us_us_id= '$user_id'";
						
						$result = mysqli_query($conn, $query);
						
						if(mysqli_num_rows($result) > 0)
						{
							while($row = mysqli_fetch_assoc($result))
							{
								$url = "albums/uploads/";
						
					?>
								<form class ="delete" action="" method="post">
								<image src="<?php echo $url.$row['file_name']; ?>" class="images" />
								<input type="text" name="delete" id="delete" value="<?php echo $row['id'];?>">
								<input type="submit" name="delete_conf" id="delete_conf" value="">
								</form>
					<?php
							}
						}
						else
						{
					?>
						<p>There are no images uploaded to display.</p>
					<?php
						}
					?>					
				</div>
			</div>
		</div>
		
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="fotos/js/jQuery.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="fotos/js/bootstrap.min.js"></script>		
	</body>
</html>
