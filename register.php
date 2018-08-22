<?php
//register.php
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');
session_start();
$array = $_SESSION['array'];
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
				':user_name'			=>   	$_POST['user_name'],
				':user_email'			=>	    $_POST['user_email'],
				':user_password'		=>   	$user_encrypted_password,
				':user_activation_code'	=>   	$user_activation_code,
				':user_id'		    	=>	    $user_id,
				':user_email_status'	=>  	'not verified',
				':first_name'    		=>      $_POST['user_name'],
				':last_name'    		=>      '',
				':country'    			=>      '',
				':city'    			 =>      '',
				':profile_foto'    		=>      'uploads/default.png',
                		':details'   			=>      '',
				':gender'   			=>      $_POST['gender'],
				':weight'   			=>      '',
				':height'   			=>      ''
			)
		);



		
		$result = $statement->fetchAll();
			

		if(isset($result))
		{
			

			$base_url = "https://lovoneo.com/";  
			$mail_body = "
			<head>
				<meta charset='UTF-8'>
				<meta name='viewport' content='width=device-width, initial-scale=1.0'>
				<style type='text/css'>
					body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
					table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
					img { -ms-interpolation-mode: bicubic; }
					img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }
					table { border-collapse: collapse !important; }
					body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; }
				</style>
			</head>
			<body style='background-color: aliceblue; margin: 0 !important; padding: 60px 0 60px 0 !important;'>
rder='0' cellspacing='0' cellpadding='0' role='presentation' width='100%'>
                                <tr>
                                        <td bgcolor='aliceblue' style='font-size: 0;'>&<200b>nbsp;</td>
                                        <td bgcolor='white' width='600' style='border-bottom: 1px solid gainsboro; text-align: center; color: dimgray; font-family: sans-serif; font-size: 18px; line-height: 28px; padding: 20px 40px;'>
                                                <img alt='placeholder image' src='https://lovoneo.com/logo.png' height='150' width='250' style='color: white; display: block; font-family: sans-serif; font-size: 18px; font-weight: bold; height: auto; max-width: 100%; text-align: center;'>
                                        </td>
                                        <td bgcolor='aliceblue' style='font-size: 0;'>&<200b>nbsp;</td>
                                </tr>
                                <tr>
                                        <td bgcolor='aliceblue' style='font-size: 0;'>&<200b>nbsp;</td>
                                        <td bgcolor='white' width='600' style='border-radius: 4px; color: dimgray; font-family: sans-serif; font-size: 18px; line-height: 28px; padding: 40px 40px;'>
                                                <h1 style='color: dimgray; font-size: 32px; font-weight: bold; line-height: 36px; margin: 0 0 30px 0;'>Hi, ".$_POST['user_name']."!</h1>
                                                <p style='margin: 30px 0 30px 0;'>$array[48]</p>
                                                <p style='margin: 30px 0 30px 0;'> $array[49] <span style='font-weight: 600; color: dimgray; '> ".$user_password." </span>$array[50]</p>
                                                <p style='margin: 30px 0 30px 0;'>$array[51]:</p> 
                                                <a href='".$base_url."email_verification.php?activation_code=".$user_activation_code."' style='font-weight: bold; color: deeppink !important;'> lovoneo.com</a>
                                                <p style='color: dimgray;  line-height: 36px;'>Best Regards,<br />Lovoneo</p><!--32-->
                                        </td>
                                        <td bgcolor='aliceblue' style='font-size: 0;'>&<200b>nbsp;</td>
                                </tr>
                                </table>

			
			</body>";
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
	<link rel="stylesheet" href="menu.css">

		<title><?php echo $array[21];?></title><!--22-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="register.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

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
                            echo "Profile";
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
		<section class="section_register rel">
			<div class="wrap" >
            	<div class="logo"></div>
				<div class="panel panel-default">
					<div class="panel-body">
						<form method="post" id="register_form">
							<?php echo $message; ?>
							<div class="form-group">
								<label for="user_name"><?php echo $array[26]; ?></label><!--27-->
								<input type="text" name="user_name" id="user_name" class="form-control email" value="<?php echo isset($_POST['user_name']) ? $_POST['user_name'] : '' ?>" pattern="[a-zA-Z ]+" required />
							</div>
							<div class="form-group">
								<label for="user_email"><?php echo $array[27]; ?></label><!--28-->
								<input type="email" name="user_email" id="user_email" class="form-control email" value="<?php echo isset($_POST['user_email']) ? $_POST['user_email'] : '' ?>" required />
							</div>
							<div class="form-group">
								<label for="user_password"><?php echo $array[28]; ?></label><!--29-->
								<input type="password" name="user_password" id="user_password" class="form-control password" value="<?php echo isset($_POST['user_password']) ? $_POST['user_password'] : '' ?>" required />
              </div>
              <label for="gender"><?php echo $array[29]; ?></label><!--30-->
              <div class="input-group">
                <select class="custom-select" id="gender" name="gender">
									<option value="male">male</option>
									<option value="female">female</option>
                </select>
              </div>
							<div class="form-group">
								<label for="birth_date"><?php echo $array[30] ;?></label><!--31-->
								<input type="date" name="birth_date" id="birth_date" class="form-control email" value="<?php echo isset($_POST['birth_date']) ? $_POST['birth_date'] : '' ?>" required />
							</div>

							<div class="form-group">
								<input type="submit" name="register" id="register" value="Register" class="btn btn-danger inline-block register-btn" />
								<a  href="login_page.php" class="login-link inline-block btn btn-danger "><?php echo $array[4]; ?></a><!--31-->
							</div>
						</form>
					</div>
				</div>
			</div>
		</section>
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	</body>
</html>
