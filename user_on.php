<?php
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');

?>


<!DOCTYPE html>
<html>
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <link rel="stylesheet" href="user_on_style.css">
        <link href="https://fonts.googleapis.com/css?family=Parisienne" rel="stylesheet"> 
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
  <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css'>

    </head>
	<body>
    <?php
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');
include("connection.php");

$user_name = $_SESSION['user_name'];
$query = "SELECT * FROM register_user WHERE user_name = '$user_name'";
$mysql_result = mysqli_query($conn, $query);
?>

<?php
while ($row = mysqli_fetch_assoc($mysql_result)) :
?>
		<div class=" form-log">
			<div class="panel panel-default">
				<div class="panel-body rel">
                    <div class="photo-user-box inline-bock">
                        <img src = "<?php echo $row['profile_foto'];?>" class="photo-user">
                    </div>
                    <div class="buttons inline-bock">
                        <ul class="accordion-menu">
                          <li>
                            <div class="dropdownlink dropdownlink_4">
                            <a href="view_profile.php">Profile</a>
                            </div>
                          </li>
                          <li>
                            <div class="dropdownlink dropdownlink_4">
                            <a href="message1/message.php">Mеssages</a>
                            </div>
                          </li>
                          <li>
                            <div class="dropdownlink dropdownlink_4">
                            <a href="personal_page_edit.php?user_activation_code=<?php echo $row['user_activation_code'];?>&&user_id=<?php echo $row['user_id'];?>">Edit profile</a>
                            </div>
                          </li>
                          <li>
                            <div class="dropdownlink dropdownlink_4">
                            <a href="#">Credit</a>
                            </div>
                          </li>
                        </ul>
                    </div>
                    <div class="user-name-txt">
                    <?php echo $row['first_name']; ?>
                    <?php echo $row['last_name']; ?>
                    </div>
				</div>
			</div>
        </div>
        
<?php endwhile; ?>
<script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>


	</body>
</html>

