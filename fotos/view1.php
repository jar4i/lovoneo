<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="stylesheet" href="fotos/view_alb_edit.css">
		<link href="fotos/css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
		<section class="section_view" id="view">
			<div class="wrap">
				<div class="container">			
					<div class="panel panel-default">
						<div class="panel-body">
							<?php
								if(isset($_POST['delete_conf'])){
									$del_id = $_POST['delete'];
									$delete_query="DELETE FROM files WHERE id = '$del_id'";
									$con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
									$con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
									$stmt = $con->prepare($delete_query);
									$stmt->execute();
								}
							?>
							<?php 
								$con = mysqli_connect("localhost","lovoneo","ZMaLPF2-unV-ch","projekt");
								$query = "SELECT * FROM files WHERE us_us_id= '".$_SESSION['us_id']."'";
								$result = mysqli_query($con, $query);
								if(mysqli_num_rows($result) > 0)
								{
									while($row = mysqli_fetch_assoc($result)){
									
										$url = "albums/uploads/";
							?>
							<form class ="delete inline-block" action="" method="post">
								<div class="img_box rel" style="background:  url('<?php echo $url.$row['file_name']; ?>') no-repeat">
									<input type="text" class="not_a_block" name="delete" id="delete" value="<?php echo $row['id'];?>">
									<input type="submit" class="btn_delete" name="delete_conf" id="delete_conf" value="">	
								</div>
								
							</form>
							<?php
								}}
								else{
							?>
								<p>There are no images uploaded to display.</p>
							<?php
								}
							?>					
						</div>
					</div>
				</div>
			</div>
		</section>
		
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="fotos/js/jQuery.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="fotos/js/bootstrap.min.js"></script>		
	</body>
</html>
