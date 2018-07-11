<?php session_start();?>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
<script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.3.js"></script>
</head>
<body>
<ul>
  <li><a class="active" href="#home">Home</a></li>
  <li><a href="#news">News</a></li>
  <li><a href="#contact">Contact</a></li>
  <li><a href="#about">About</a></li>
</ul>
<?php 
if (isset($_POST['search'])) {
$_SESSION['age1'] = $_POST['age1'];
$_SESSION['age2'] = $_POST['age2'];
$_SESSION['gender'] = $_POST['gender'];
$_SESSION['state'] = $_POST['state'];
}
?>
<form class="search" action="search_form.php" method="post">
<input id="age1" type="text" name="age1" value="<?php echo isset($_SESSION['age1']) ? $_SESSION['age1'] : '' ?>" placeholder="age from, years">
<input id="age2" type="text" name="age2" value="<?php echo isset($_SESSION['age2']) ? $_SESSION['age2'] : '' ?>" placeholder="age to, years">
<input id="gender" type="text" name="gender"  value="<?php echo isset($_SESSION['gender']) ? $_SESSION['gender'] : '' ?>" placeholder="gender">
<input id="state" type="text" name="state"value="<?php echo isset($_SESSION['state']) ? $_SESSION['state'] : '' ?>" placeholder="state">
<input id="search" type="submit" name="search" value="search"><br><br>
</form>
<div id="target-content" class="clearfix">
</div>
<script type="text/javascript">
$(document).ready(function(){
	jQuery("#target-content").load("response1.php?page=1");
})
</script>
     <?php
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');

include('connection.php');
//for total count data
$countSql = "SELECT COUNT(u_id) FROM pers_data";  
$tot_result = mysqli_query($conn, $countSql);  
$row = mysqli_fetch_row($tot_result);  
$total_records = $row[0];  
$total_pages = ceil($total_records / $limit);
?>

<ul class='pagination' id="pagination">
 <?php  if(!empty($total_pages)):for($i=1; $i<=$total_pages; $i++):  
 if($i == 1):?>
 <li class='page-item active'  id="<?php echo $i;?>"><a href='response1.php?page=<?php echo $i;?>' class="page-link"><?php echo $i;?></a></li> 
 <?php else:?>
 <li id="<?php echo $i;?>" class="page-item"><a href='response1.php?page=<?php echo $i;?>' class="page-link"><?php echo $i;?></a></li>
 <?php endif;?>
 <?php endfor;endif;?>
 </ul>
</div>
<script>
jQuery("#pagination li").on('click',function(e){
 e.preventDefault();
 jQuery("#target-content").html('loading...');
 jQuery("#pagination li").removeClass('active');
 jQuery(this).addClass('active');
        var pageNum = this.id;
        jQuery("#target-content").load("response1.php?page=" + pageNum);
});
</script>
      



<style>
.clearfix_card
	{
	display: inline-block;
	margin: 50px;
	border: inset 6px;
	float: left;
	width: 300px;
	height: 300px;
	}
.main_form
{
width: auto; 
height: auto;
border: solid 2px;
position: absolute; 
top: 300px;
}

.pers_infos
{
position: absolute; 
top: 600px;
left: 50px;
border: solid 2px;
height: 600px;
}

.right_column
{
border: inset 6px;
margin: 50px; 
float: left;
width: 200px; 
height: 200px;
}

.w3-border
{
margin-left:25%;
margin-right:25%;
}
.search_element

{
display: inline-block;
}

.profiles
{
border: solid 2px;
height: 800px; 
margin : 5px; 
}
.inner_search
{
height: 150px; 
}

.main
{
position: absolute;
top: 5000px; 

width: 1000px;
height: 300px: 
background-color: #ddd;
}

.footer
{
background-color: #ddd;
float: bottom;

   
margin:50px;
height:100px;
} 
.image
{
height:100px;
}
.welcom
{
margin-right:100px;  
float: right; 
width: 50px; 
height: 50px; 

}

h5
{
text-align:center;
}
.form-signin
{
border:solid 2px; 
float: right; 
width: 450px; 
height: 500px; 
margin: 20px; 
}

.login
{

height: 600px; 

}





.btn btn-lg btn-primary btn-block{
text-align: left;
}

.form-signin-heading {
  color: black;
  font-size: 18px;
  font-family: "Raleway", Helvetica, Arial, sans-serif;
  font-weight: 600;
  text-transform: uppercase;
  text-align: center;
}

.images {
  width  : 500px;
  height : auto
  float: left;
  #overflow:scroll;
  text-align:center;
}

label {
padding : 5px;
margin-left: 25%;
margin-right:25%;
color: #000000;
font-weight: bold;
display: block;
width: 1000px;
}






ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
}

li {
    float: left;
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover {
    background-color: #111;
}

/* Style the tab */
.tab {
	display: block;
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
}

/* Style the buttons inside the tab */

.search

{
margin-top:20px; 
float: left;
width: 1200px;
height: 150px; 
background-color: #ddd;
}

footer
{
height: 100px;
position: absolute; 
top: 1700px;
background-color: #ddd;
width: 100%;
}

</style>
<footer>
<p>Contact US</p>
</footer>
</body>

