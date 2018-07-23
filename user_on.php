<?php
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');
//if(isset($_SESSION['user_name']))
//{
//echo 'Welcome, '.$_SESSION['user_name'];
//echo '<br>';
//echo '<a href="logout.php">Logout</a>';
//}
?>
<!--
<div class="user_on">
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

<a>Name:	</a><?php echo $row['first_name']; ?><br>
<a>City:	</a><?php echo $row['city'];?><br>
<a>Country:	</a><?php echo $row['country'];?><br>
<a>Profile foto	</a><img src = "<?php echo $row['profile_foto'];?>"><br>
<a href="personal_page_edit.php?user_activation_code=<?php echo $row['user_activation_code'];?>&&user_id=<?php echo $row['user_id'];?>">Go to personal page</a>
<?php endwhile; ?>
</div>-->

<!DOCTYPE html>
<html>
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <link rel="stylesheet" href="user_on_style.css">
        <link href="https://fonts.googleapis.com/css?family=Parisienne" rel="stylesheet"> 
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
  <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css'>
      <link rel="stylesheet" href="css/style.css">

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
                            <div class="dropdownlink dropdownlink_1"><i class="fas fa-user"></i>
                              <i class="fa fa-chevron-down" aria-hidden="true"></i>
                            </div>
                            <ul class="submenuItems submenuItems_1">
                              <li><a href="view_profile.php">Profile</a></li>
                            </ul>
                          </li>
                          <li>
                            <div class="dropdownlink dropdownlink_2"><i class="fas fa-envelope"></i>
                              <i class="fa fa-chevron-down" aria-hidden="true"></i>
                            </div>
                            <ul class="submenuItems submenuItems_2">
                              <li><a href="message1/message.php">Mеssages</a></li>
                            </ul>
                          </li>
                          <li>
                            <div class="dropdownlink dropdownlink_3"><i class="fas fa-cogs"></i>
                              <i class="fa fa-chevron-down" aria-hidden="true"></i>
                            </div>
                            <ul class="submenuItems submenuItems_3">
                              <li><a href="personal_page_edit.php?user_activation_code=<?php echo $row['user_activation_code'];?>&&user_id=<?php echo $row['user_id'];?>">Edit profile</a></li>
                            </ul>
                          </li>
                          <li>
                            <div class="dropdownlink dropdownlink_4"><i class="fas fa-credit-card"></i>
                              <i class="fa fa-chevron-down" aria-hidden="true"></i>
                            </div>
                            <ul class="submenuItems submenuItems_4">
                              <li><a href="#">Credit</a></li>
                            </ul>
                          </li>
                          <li>
                            <div class="dropdownlink dropdownlink_5"><i class="fas fa-user-times"></i>
                              <i class="fa fa-chevron-down" aria-hidden="true"></i>
                            </div>
                            <ul class="submenuItems submenuItems_5">
                              <li><a href="#">Log out</a></li>
                            </ul>
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

<script src="js/index.js"></script>

	</body>
</html>

