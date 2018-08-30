<!DOCTYPE html>
<html lang="en">
	<head>
	<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" href="fotos/view_alb.css">
		<link href="fotos/css/bootstrap.min.css" rel="stylesheet">
	</head>
<body>
	<div class="section_view" id="view">
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
		<h3 class="center"><?php echo $array[58];?></h3>
			<div class="rowii">
			<?php 
					$conn = mysqli_connect("localhost","lovoneo","ZMaLPF2-unV-ch","projekt");
					$query = "SELECT * FROM  register_user WHERE user_id = '$user_id'";
					$result = mysqli_query($conn, $query);
					
						while($row = mysqli_fetch_assoc($result))
						{
				?>

					<div>
						<div class="img_box rel" onclick="zoom('<?php echo $row['profile_foto']?>')" data-toggle="modal" data-target="#exampleModalCenter" style="background:  url('<?php echo $row['profile_foto']?>') no-repeat"></div>
					</div>
				<?php
				}
					$query2 = "SELECT * FROM files WHERE us_us_id= '$user_id'";
					$result2 = mysqli_query($conn, $query2);
					
						while($row2 = mysqli_fetch_assoc($result2))
						{
							if(mysqli_num_rows($result2) > 0)
					{
							$url = "albums/uploads/";
				?>
					<div>
						<div class="img_box rel" onclick="zoom('<?php echo $url.$row2['file_name']; ?>')" data-toggle="modal" data-target="#exampleModalCenter" style="background:  url('<?php echo $url.$row2['file_name']; ?>') no-repeat"></div>
					</div>
				<?php
						}}
					?>	

			</div>
	</div>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="fotos/js/jQuery.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="fotos/js/bootstrap.min.js"></script>	
		<script>
			function zoom(file){
				$('.img').attr("src",file);
			}
</script>	


<script type="text/javascript">
   
   $(document).ready(function(){
       $('.rowii').slick({
		infinite: true,
     speed: 300,
     slidesToShow: 5,
     slidesToScroll: 5,
	 dots: true,
	 arrows: false,
     responsive: [
       {
         breakpoint: 1199,
         settings: {
           slidesToShow: 6,
           slidesToScroll: 6,
         }
       },
       {
         breakpoint: 991,
         settings: {
           slidesToShow: 4,
           slidesToScroll: 4
         }
       },
       {
         breakpoint: 768,
         settings: {
           slidesToShow: 3,
           slidesToScroll: 3
          }
        } ,

       {
         breakpoint: 600,
         settings: {
           slidesToShow: 4,
           slidesToScroll: 4,
          }
        } 
       // You can unslick at a given breakpoint now by adding:
       // settings: "unslick"
       // instead of a settings object
     ]
   });
   });
   </script>




	</body>
</html>
