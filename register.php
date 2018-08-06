<?php
//register.php
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');


include("class.phpmailer.php");
include("class.smtp.php");
include("database_connection.php");
if(isset($_SESSION['user_id']))
{
	header("location:index.php");
}

$message = '';
include("config.php");




if(isset($_POST["register"]))
{
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
	if($no_of_row > 0)
	{
		$message = '<label class="text-danger">Email Already Exits</label>';
	}
	else
	{
		$user_password = $_POST['user_password'];
		$user_encrypted_password = password_hash($user_password, PASSWORD_DEFAULT);
		$user_activation_code = md5(rand());
		$user_id = md5(rand());
		$insert_query = "
		INSERT INTO register_user 
		(birth_date, user_name, user_email, user_password, user_activation_code, user_id, user_email_status, first_name, last_name, country, city,  profile_foto, details, gender, weight, height) 
		VALUES (:birth_date, :user_name, :user_email, :user_password, :user_activation_code, :user_id, :user_email_status, :first_name, :last_name, :country, :city, :profile_foto, :details, :gender, :weight, :height)
		";
		$statement = $connect->prepare($insert_query);
		$statement->execute(
			array(
				':birth_date'   		=>      $_POST['birth_date'],
				':user_name'			=>	'',
				':user_email'			=>	$_POST['user_email'],
				':user_password'		=>	$user_encrypted_password,
				':user_activation_code'		=>	$user_activation_code,
				':user_id'			=>	$user_id,
				':user_email_status'		=>	'not verified',
				':first_name'    		=>      $_POST['user_name'],
				':last_name'    		=>      '',
				':country'    			=>      '',
				':city'    			=>      '',
				':profile_foto'    		=>      'uploads/default.png',
                                ':details'   			=>      $_POST['gender'],
				':gender'   			=>      '',
				':weight'   			=>      '',
				':height'   			=>      ''


			)
		);



		session_start();
		$array = $_SESSION['array'];
		
		$result = $statement->fetchAll();
			

		if(isset($result))
		{
			

			$base_url = "https://lovoneo.com/";  
			$mail_body = "
			<p>Hi ".$_POST['user_name'].",</p>
			<p>Thanks for Registration. Your password is ".$user_password.", This password will work only after your email verification.</p>
			<p>Please Open this link to verified your email address - ".$base_url."email_verification.php?activation_code=".$user_activation_code."
			<p>Best Regards,<br />Lovoneo</p><!--32-->
			";
			$mail = new PHPMailer;
			$mail->SMTPDebug = 0;
			$mail->IsSMTP();								
			$mail->Host = 'smtp.gmail.com';		
			$mail->Port = '587';								
			$mail->SMTPAuth = true;							
			$mail->Username = 'jaroslaw.vinnichuck@gmail.com';					
			$mail->Password = 'Jvaac2283591';					
			$mail->SMTPSecure = 'tls';							
						
			$mail->setFrom('confirm@lovoneo.com', 'LOVONEO');
					
			$mail->AddAddress($_POST['user_email'], $_POST['user_name']);		
			$mail->WordWrap = 50;							
			$mail->IsHTML(true);											
			$mail->Subject = 'Email Verification';			
			$mail->Body = $mail_body;							
			if($mail->Send())								
			{

				header("location:register_foto_upload.php?user_activation_code=$user_activation_code");
							

			}
		}
	}
}



?>


<!DOCTYPE html>
<html>
	<head>

<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

		<title><?php echo $array[21];?></title><!--22-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="register.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

	</head>
	<body>
	<header class="head fixed">
    <div class="wrap">
        <nav class="pull_left">
        
            <ul class="list-unstyled ">
            <a class="active" href="index.php">Home |</a><!--2-->
            <a class="active" href="view_profile.php"> <?php 
            if (isset($_SESSION['user_name'])) {
                echo "Profile";
                echo '  |';} 
            ?>
            </a>
            <a class="active" href="message1/message.php"> <?php 
            if (isset($_SESSION['user_name'])) {
                echo "Message";/*14*/
                echo '  |';
            }
            ?>
            </a>
   

            <a class="active" href="personal_page_edit.php?user_activation_code=<?php echo $_SESSION['user_activation_code'];?>&&user_id=<?php echo $_SESSION['user_id'];?>">
            <?php
            if (isset($_SESSION['user_name'])) {
                echo "Edit profile";/*14*/
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
		<section class="section_register rel">
			<div class="wrap" >
            	<div class="logo"></div>
				<div class="panel panel-default">
					<div class="panel-body">
						<form method="post" id="register_form">
							<?php echo $message; ?>
							<div class="form-group">
								<label for="user_name">User Name</label><!--27-->
								<input type="text" name="user_name" id="user_name" class="form-control email" value="<?php echo isset($_POST['user_name']) ? $_POST['user_name'] : '' ?>" pattern="[a-zA-Z ]+" required />
							</div>
							<div class="form-group">
								<label for="user_email">User Email</label><!--28-->
								<input type="email" name="user_email" id="user_email" class="form-control email" value="<?php echo isset($_POST['user_email']) ? $_POST['user_email'] : '' ?>" required />
							</div>
							<div class="form-group">
								<label for="user_password">Your Password</label><!--29-->
								<input type="password" name="user_password" id="user_password" class="form-control password" value="<?php echo isset($_POST['user_password']) ? $_POST['user_password'] : '' ?>" required />
              </div>
              <label for="gender">Gender</label><!--30-->
              <div class="input-group">
                <select class="custom-select" id="gender" name="gender">
									<option value="male">male</option>
									<option value="female">female</option>
                </select>
              </div>
							<div class="form-group">
								<label for="birth_date">Birthday</label><!--31-->
								<input type="date" name="birth_date" id="birth_date" class="form-control email" value="<?php echo isset($_POST['birth_date']) ? $_POST['birth_date'] : '' ?>" required />
							</div>

							<div class="form-group">
								<input type="submit" name="register" id="register" value="Register" class="btn btn-danger register-btn" />
							</div>

							
						</form>
						<div class="login-link btn btn-danger "><a href="login_page.php" >Log in</a></div><!--31-->
					</div>
				</div>
			</div>
		</section>
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	</body>
</html>
