<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="stylesheet" href="fotos/view_alb.css">
		<link href="fotos/css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
		<section class="section_view" id="view">
		<h3 class="txt_alb">Albom:</h3>

				<div class="container">			
					<div class="panel panel-default">
						<div class="panel-body">
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
							<!--<div class="fade slick-card-box">
								<div>
									<img src="<?php// echo $url.$row['file_name']; ?>">
								</div>
							</div>-->
							<div class="img_box rel" onclick="sli()" style="background:  url('<?php echo $url.$row['file_name']; ?>') no-repeat"></div>

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
		</section>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="fotos/js/jQuery.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="fotos/js/bootstrap.min.js"></script>	
		<script>
   $(document).ready(function(){
		$('.fade').slick({
			dots: true,
			infinite: true,
			speed: 500,
			fade: true,
			cssEase: 'linear'
			});});
		function sli(){
$(".fade").css("display", "none");

}
function slisli(){
    $(".section-slide").css("display", "block");

}
</script>		
	</body>
</html>
