<?php
include("database_connection.php");
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');
session_start();
$array = $_SESSION['array'];
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
	<link rel="stylesheet" href="menu.css">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<header class="head fixed">
    <div class="wrap rel">
        <div class="menu">
            <div class="menu_left">
                <div class="hamburger pull-left _hamburger">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                </div>
                <nav class=" hero-nav pull_left _nav">
                    <ul class="list-unstyled ">
                        <a class="active" href="index.php"><?php echo $array[1];?> |</a><!--2-->
                        <a class="active" href="view_profile.php"> <?php 
                        if (isset($_SESSION['user_name'])) {
                            echo $array[60];
                            echo '  |';} 
                        ?>
                        </a>
                        <a class="active" href="message1/message.php"> <?php 
                        if (isset($_SESSION['user_name'])) {
                            echo $array[13];
                            echo '  |';
                        }
                        ?>
                        </a>
                        <a class="active" href="personal_page_edit.php?user_activation_code=<?php echo $_SESSION['user_activation_code'];?>&&user_id=<?php echo $_SESSION['user_id'];?>">
                        <?php
                        if (isset($_SESSION['user_name'])) {
                            echo $array[2];
                            echo '  |';
                        }
                        ?>
                        </a>
                
                    </ul>
                </nav>
            </div>
            <div class="right_side_menu rel">
                <form method="post" class="active2 language_box ">
                <input class="language1  language" name="en" value=""  type="submit">
                    <input class="language2  language" name="de" value=""  type="submit">
                </form>
                   <?php 
                    if (isset($_SESSION['user_name'])) {
                        echo "<a class='active2 rel' href='view_profile.php'>
                                <div class='inlne-block profile_photo_menu_box'>
                                    <img class='profile_photo_menu' src='".$_SESSION['profile_foto']."'> 
                                </div>
                            </a>";
                        echo "<a class='active2' href='view_profile.php'>";
                        echo ''.$_SESSION['first_name'];
                        echo "</a>";
                    }
                    ?> 
                <a class="active2" >
                    <?php 
                    if (isset($_SESSION['user_name'])) {
                        echo"<a href='logout.php'>$array[3]</a>";/*4*/
                    }
                    else echo "<a href='login_page.php'>$array[4]</a>";/*5*/
                    ?>
                </a>
            </div>
        </div>
    </div>
</header>
	<section class="rel section_login">
		<div class="wrap">
			<div class="logo"></div>
	<?php if(!isset($_POST['restore'])){ ?>

			<div class="form-signin"  >
				<div class="form-log" id="form-log">
					<div class="panel panel-default">
						<div class="panel-body rel" id="panel-body">
							<form method="post"  id="register_form">
								<div class="form-group ">
									<input type="password" name="user_password" class="form-control email" required autocomplete="off" placeholder="<?php echo $array[52];?> "/>
								</div>
								<div class="form-group ">
									<input type="submit" name="restore" id="restore" value="<?php echo $array[46]; ?>" class="btn btn-danger login-btn" />
								</div>

							</form>
							
						</div>
					</div>
				</div>
			</div>
			<?php } else { ?>
			<div class="mess">
				<p><?php echo $array[53]; ?></p>
				<a href=login_page.php><div class='btn btn-danger btn-lg'>Log in</div></a>
			</div>
			<?php } ?>
		</div>
	</section>
	</body>
</html>
