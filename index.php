<?php
session_start();
if (isset($_POST['search'])) { 
$_SESSION['age1'] = $_POST['age1'];
$_SESSION['age2'] = $_POST['age2'];
$_SESSION['gender'] = $_POST['gender'];
$_SESSION['state'] = $_POST['state'];
} 
?>
<head>
<title>LOVONEO | FIND YOUR LOVE</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
<script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.3.js"></script>
</head>
<body>
<header class="head fixed">
    <div class="wrap">
        <nav class="pull_left">
            <ul class="list-unstyled ">
            <a class="active" href="#home"><li class="li-item inline-block">Home</li></a>
              <a href="#news"><li class="li-item inline-block">News</li></a>
              <a href="#contact"><li class="li-item inline-block">Contact</li></a>
              <a href="#about"><li class="li-item inline-block">About</li></a>
            </ul>
        </nav>
        <div class="pull-right">
            <a class="welcom" > <?php 
                if (isset($_SESSION['user_name'])) {
                   echo 'Welcome, '.$_SESSION['username'];
                }
                ?>
            </a>
            <a href="#" class="log-in-out">
            <?php 
                if (isset($_SESSION['user_name'])) {
                   echo 'Log out';
                }
                else echo 'Log in';
                ?>
            </a>
        </div>
    </div>
</header>
<section class="section-head rel">
<div class="wrap">
    <div class="container">
        <div class="row">
            <div class="form-signin col-md-4"  method="POST">
                    <?php
                    if(isset($_SESSION['user_name']))
                    {
                    include("user_on.php");
                    }
                    else 
                    {
                    include("login.php");
                    }
                    ?>
            </div>
            <div class="panel panel-default col-md-4">
				<div class="panel-body">
            <div class="card ">
               <h2> Featured</h2>
              </div>
              <div class="card-body">
                <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
              </div>
            </div>
            </div>
            </div>
        </div>
    </div>
    
</div>
</div>

</section>
<section class="section-search">
    <div class="wrap">
        <form class="search" action="search_form.php" method="post">
            <input list="age" autocomplete="off" id="age1" type="text" name="age1" value="<?php echo isset($_POST['age1']) ? $_POST['age1'] : '' ?>" placeholder="age from, years">
            <input list="age" autocomplete="off" id="age2" type="text" name="age2" value="<?php echo isset($_POST['age2']) ? $_POST['age2'] : '' ?>" placeholder="age to, years">
            <input id="gender" type="text" name="gender"  value="<?php echo isset($_POST['gender']) ? $_POST['gender'] : '' ?>" placeholder="gender">
            <input list="state1" autocomplete="off" id="state" type="text" name="state"value="<?php echo isset($_POST['state']) ? $_POST['state'] : '' ?>" placeholder="state">
            <input id="search" onclick="location.href = 'search_form.php';" type="submit" name="search" value="search">
            <datalist id="age">
                <?php
                for($i = 18; $i <= 100; $i += 1){
                     echo("<option value='{$i}'>");}
                ?>
                </datalist>
                <datalist id="state1">
                <option value="USA">
                <option value="Germany">
                <option value="Ukraine">
                <option value="Russia">
            </datalist>
        </form>
    </div>
    

</section>



<div id="target-content" class="clearfix">


</div>
     <?php

include('connection.php');
$countSql = "SELECT COUNT(register_user_id) FROM register_user";
$tot_result = mysqli_query($conn, $countSql);
$row = mysqli_fetch_row($tot_result);
$total_records = $row[0];
$total_pages = ceil($total_records / $limit);
?>
<div class="pagination_main">
<ul class='pagination' id="pagination">
 <?php if(!empty($total_pages)):for($i=1; $i<=$total_pages; $i++):  
 if($i == 1):?>
 <li class='page-item active'  id="<?php echo $i;?>"><a href='user_icon.php?page=<?php echo $i;?>' class="page-link"><?php echo $i;?></a></li> 
 <?php else:?>
 <li id="<?php echo $i;?>" class="page-item"><a href='user_icon.php?page=<?php echo $i;?>' class="page-link"><?php echo $i;?></a></li>
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
        jQuery("#target-content").load("user_icon.php?page=" + pageNum);
});
</script>
      
<!--

<style>

.header_main
{
width:1280;
height: 50px;
border: solid 2px;
position: relative;
}

.pagination_main
{
width:1280;
height: 50px;

margin-left: 100px;
margin-top: 120px;
position: absolute;
top: 750px;
}


.main_foto

{

float: left;
background-image: url('https://www.gentlemenhood.com/wp-content/uploads/2014/12/man-woman-thinking-750x499.jpg');
height: 500px;
width: 1280px;
border: solid 2px;
margin-left: 50px;
margin-top: 20px;
}

div.form-signin
{

border:solid 2px; 
float: right; 
width: 450px; 
height: 450px; 
margin: 20px; 
background: #303030; opacity: 0.8; 
 
}




.clearfix_card
	{
	display: inline-block;
	margin: 50px;
	border: inset 6px;
	float: left;
	width: 300px;
	height: 300px;
	background: #FFF;
	box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 40px 0 rgba(0, 0, 0, 0.19);
	z-index:1;
	}

.main_form
{
margin-right: 50px;
margin-left: 50px;
width: auto; 
height: auto;
border: solid 2px;
position: absolute; 
top: 800px;
background-color: rgba(48,48,48,0.8); 


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
  
text-align: right; 
 

}

h5
{
text-align:center;
}


h2
{
color:#E0E0E0;
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

margin-left: 50px;
margin-top:20px; 
float: left;
width: 1280px;
height: 60px; 
background: #303030; opacity: 0.8; 

}

body
{
background-image:url('https://i.pinimg.com/564x/85/0a/51/850a51b334db7a09b6e35770aac16b49.jpg');
}

footer
{
position:fixed;
   left:0px;
   bottom:0px;
   height:30px;
   width:100%;
   background:#999;
}

.search  input
{
margin-top:12px;
margin-left:5px;
}




</style>
<footer>
<p>Contact US</p>
</footer>
-->
<script type="text/javascript">
$(document).ready(function(){
        jQuery("#target-content").load("response.php?page=1");
})
</script>
</body>



