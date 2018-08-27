<!DOCTYPE html>
<html lang="en">
	<head>
	<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" href="fotos/view_alb.css">
		<link href="fotos/css/bootstrap.min.css" rel="stylesheet">
	</head>
<body>
	<section class="section_view" id="view">
		<h3 class="txt_alb"><?php echo $array[58]; ?></h3>
				<!-- Modal -->
		<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
					</div>
					<div class="modal-body">
						<div class="myalert">
							<img class="img" src="" />
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-body">
			<div class="row">

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
					<div class="col-lg-3 col-md-2 col-sm-3 col-xs-4">
					<div class="img_box rel" onclick="zoom('<?php echo $url.$row['file_name']; ?>')" data-toggle="modal" data-target="#exampleModalCenter" style="background:  url('<?php echo $url.$row['file_name']; ?>') no-repeat"></div>

					</div>
				<?php
					}}
					else{
				?>
				<p><?php echo $array[59]; ?></p>
				<?php
					}
				?>	
				</div>

			</div>
		</div>
	</section>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="fotos/js/jQuery.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="fotos/js/bootstrap.min.js"></script>	
		<script>
			function zoom(file){
				$('.img').attr("src",file);
			}
</script>		
	</body>
</html>
