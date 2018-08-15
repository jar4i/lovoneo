<?php
include("database_connection.php");
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');
if(isset($_POST['restore'])){
session_start();
	$query = "
	SELECT * FROM register_user 
	WHERE user_email = :user_email
	";
	$statement = $connect->prepare($query);
	$statement->execute(
		array(
			':user_email'	=>	$_POST['user_email']
		)
	);
	$no_of_row = $statement->rowCount();
	if($no_of_row > 0){
        $mail = $_POST['user_email']; $_SESSION['mail'] = $mail; header("location:np.php");
$message = "";
    
    }
else
{
$message = "Email not found, try again";
}
}?>	
		

<!DOCTYPE html>
<html>
	<head>
		<title> Restore password </title>		
		<link rel="stylesheet" href="restore_pass.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>
	<header class="head fixed">
    <div class="wrap">
        <nav class="pull_left">
        
            <ul class="list-unstyled ">
            <a class="active" href="index.php">Home |</a>
            <a class="active" href="view_profile.php"> <?php 
            if (isset($_SESSION['user_name'])) {
                echo "Profile";
                echo '  |';} 
            ?>
            </a>
            <a class="active" href="message1/message.php"> <?php 
            if (isset($_SESSION['user_name'])) {
                echo "Massage";
                echo '  |';
            }
            ?>
            </a>
   

            <a class="active" href="personal_page_edit.php?user_activation_code=<?php echo $_SESSION['user_activation_code'];?>&&user_id=<?php echo $_SESSION['user_id'];?>">
            <?php
            if (isset($_SESSION['user_name'])) {
                echo "Edit profile";
                echo '  |';
            }
            ?>
            </a>
            
            </ul>
        </nav>
        <div class="pull-right rel">
        <a class="welcom" href="view_profile.php"> <?php 
            if (isset($_SESSION['user_name'])) {
                echo "<div class='profile_photo_menu_box inline-block'><img class='profile_photo_menu' src='".$_SESSION['profile_foto']."'> </div>";
               echo ''.$_SESSION['first_name'];
               echo '  |';
            
            }
            ?>
        </a>
        <?php 
            if (isset($_SESSION['user_name'])) {
                echo'<a href="logout.php">Log out</a>';
            }
            else echo '<a href="login_page.php">Log in</a>';
            ?>
        </div>

    </div>
</header>
<section class="rel section_login">
    <div class="wrap">
        <div class="logo"></div>
		<div class="form-signin"  >
			<div class="form-log" id="form-log">
				<div class="panel panel-default">
					<div class="panel-body rel" id="panel-body">
						<form method="post"  id="register_form">
							<div class="form-group ">
                                <h4 class="text-danger"><?php echo $message; ?></h4>
								<input type="email" name="user_email" class="form-control email" required autocomplete="off" placeholder="Username (E-mail)"/>
							</div>
							<div class="form-group ">
								<input type="submit" name="restore" id="restore" value="Restore password" class="btn btn-danger login-btn" />
							</div>

						</form>
						
					</div>
				</div>
			</div>
        </div>
    </div>
</section>
	</body>
</html>

