<?php
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');
include('connection.php');

if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
$start_from = ($page-1) * $limit;  
  
$sql = "SELECT TIMESTAMPDIFF(YEAR, `birth_date`, CURDATE()) AS age , first_name, user_id, last_name, details, country, city,  profile_foto FROM register_user ORDER BY rand()  ASC LIMIT $start_from, $limit";  
$rs_result = mysqli_query($conn, $sql);
 
?>

<div class="responsive slick-card-box">
	<?php  
	while ($row = mysqli_fetch_assoc($rs_result)) :
	?>  
		<div>
			<div class="rel card1">
        <a href="personal_page.php?user_id=<?php echo $row['user_id'];?>" >
					<img src="<?php echo $row['profile_foto']; ?>" class="card-photo1">
				</a>
			</div>
		</div>
	<?php
	endwhile; 
	?>
</div>

    

<script type="text/javascript">
   
   $(document).ready(function(){
    $('.responsive').slick({
     infinite: true,
     autoplay: true,
     speed: 300,
     slidesToShow: 6,
     slidesToScroll: 5,
     responsive: [
      
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
         breakpoint: 660,
         settings: {
           slidesToShow: 1,
           slidesToScroll: 1
          }
        } 
       // You can unslick at a given breakpoint now by adding:
       // settings: "unslick"
       // instead of a settings object
     ]
   });
   });
   </script>



