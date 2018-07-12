<?php
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');
session_start();
$_SESSION['user_name'] = "vinni";
if(isset($_SESSION['user_name']))
{
echo 'Welcome, '.$_SESSION['user_name'];
echo '<br>';
echo '<a href="logout.php">Logout</a>';
}
?>
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
</div>

