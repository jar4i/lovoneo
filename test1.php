<?php
include("connection.php");
$query = $conn->query("SELECT phrase FROM de");
$array = Array();
while($result = $query->fetch_assoc()){
    $array[] = $result['phrase'];
}
 
echo $array[3];

?>
