	<?php
$like_to= $_GET["user_id"];
$like_from = $_SESSION['us_id'];
$pdo = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD);
$nRows = $pdo->query("select count(*) FROM likes WHERE like_to = '$like_to'")->fetchColumn(); 
if($nRows = 0){
$insert_query="INSERT INTO likes (like_from, like_to) VALUES ('$like_from', '$like_to')";
$con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
$con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
$ins = $con->prepare($insert_query);
$ins->execute();
echo "Like was given!";
}
else
{
echo "please log in";
}
?>
