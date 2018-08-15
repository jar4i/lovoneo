<?php
include("database_connection.php");
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');
session_start();
if(isset($_POST['restore'])){
	
	$user_password = $_POST['user_password'];
	$user_email = $_SESSION['mail'];
	$user_encrypted_password = password_hash($user_password, PASSWORD_DEFAULT);
	$query = "UPDATE register_user SET user_password = '$user_encrypted_password' WHERE user_email = '$user_email'";
	$statement = $connect->prepare($query);
	$statement->execute();}?>
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
	<?php if(!isset($_POST['restore'])){ ?>
	<section class="rel section_login">
		<div class="wrap">
			<div class="logo"></div>
			<div class="form-signin"  >
				<div class="form-log" id="form-log">
					<div class="panel panel-default">
						<div class="panel-body rel" id="panel-body">
							<form method="post"  id="register_form">
								<div class="form-group ">
									<input type="password" name="user_password" class="form-control email" required autocomplete="off" placeholder="Enter Your new password"/>
								</div>
								<div class="form-group ">
									<input type="submit" name="restore" id="restore" value="Restore" class="btn btn-danger login-btn" />
								</div>

							</form>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</section><?php } else { ?>
	<section class="section_message">
		<div class="wrap">
			<div class="mess">
				<p>Password was succesfully changed!</p>
				<a href=login_page.php><div class='btn btn-danger btn-lg'>Log in</div></a>
			</div>
		</div>
	</section>
	<?php } ?>
	</body>
</html>