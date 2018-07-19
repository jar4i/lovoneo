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
					<a href="index.php" class="btn btn-info">Go Back</a>
					<h3>Uploaded Files:</h3>
					<br/>
					<?php 
						$conn = mysqli_connect("localhost","lovoneo","ZMaLPF2-unV-ch","projekt");
						
						$query = "SELECT * FROM userfiles WHERE user_user_id= '$user_id'";
						
						$result = mysqli_query($conn, $query);
						
						if(mysqli_num_rows($result) > 0)
						{
							while($row = mysqli_fetch_assoc($result))
							{
								$url = $row["FilePath"]."/".$row["FileName"];
					?>
								<a href="<?php echo $url; ?>"><image src="<?php echo $url; ?>" class="images" /></a>
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
