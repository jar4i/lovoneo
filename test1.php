<?php
include("connection.php");
$query = "SELECT phrase FROM de";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_all($result, MYSQLI_NUM);
echo array_values($row);

?>
