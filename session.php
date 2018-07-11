<?php
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');
session_start();
echo $_SESSION['username'];
$conn = mysqli_connect("localhost","root","jar4ik3591","projekt" );
$query = "SELECT * FROM pers_data";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)){
echo $row['username'];
echo $row['last_name'];
}

session_destroy();
if (empty($_SESSION)){
header ("location : 123.php");
}
?>
<?php
session_start();
if (isset($_POST['password']) && isset($_POST['userName'])) {
        if($_POST['password']==$pass && $_POST['userName']==$username)
        {
            header( 'Location: admin.php' ) ;
            $_SESSION['isLogged'] = true;
		
        }
?>
