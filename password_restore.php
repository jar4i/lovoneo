<?php
include("class.phpmailer.php");
include("class.smtp.php");
include("database_connection.php");

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
		$query = "
	SELECT * FROM register_user 
	WHERE user_email = :user_email
	";
	$statement = $connect->prepare($query);
	$statement->execute(
		array(
			':user_email'	=>	$_POST['user_email']
		)

			$base_url = "https://lovoneo.com/";  
			$mail_body = "
			<p>Hi ".$_POST['user_name'].",</p>
			<p>Here is your link to restore your password. 
			<p>Please Open this link to restore your password - ".$base_url."password_restore_confirmation.php?activation_code=".$user_activation_code."
			<p>Best Regards,<br />Lovoneo</p>
			";
			
			$mail = new PHPMailer;
			$mail->SMTPDebug = 0;
			$mail->IsSMTP();								
			$mail->Host = 'smtp.gmail.com';		
			$mail->Port = '587';								
			$mail->SMTPAuth = true;							
			$mail->Username = 'jaroslaw.vinnichuck@gmail.com';					
			$mail->Password = 'jar4ik3591';					
			$mail->SMTPSecure = 'tls';							
						
			$mail->setFrom('jaroslaw.vinnichuck@gmail.com', 'LOVONEO');
					
			$mail->AddAddress($_POST['user_email'], $_POST['user_name']);		
			$mail->WordWrap = 50;							
			$mail->IsHTML(true);											
			$mail->Subject = 'Password restore';			
			$mail->Body = $mail_body;							
			if($mail->Send())								
			{
				$message = "<p>All is done, check your mail</p>";
			}
		}


?>

<!DOCTYPE html>
<html>
	<head>
		<title> Register </title>		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>
		<br />
		<div class="container" style="width:100%; max-width:600px">
			<h2 align="center">Restore password</h2>
			<br />
			<div class="panel panel-default">
				<div class="panel-heading"><h4>Restore password</h4></div>
				<div class="panel-body">
					<form method="post" id="register_form">
						<?php echo $message; ?>
						<div class="form-group">
						
							<label>Please specify your Email</label>
							<input type="email" name="user_email" class="form-control" required />
						</div>
						<div class="form-group">
							<input type="submit" name="restore" id="restore" value="Restore" class="btn btn-info" />
						</div>
					</form>
					
				</div>
			</div>
		</div>
	</body>
</html>
?>
