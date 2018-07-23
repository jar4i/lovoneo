<?php
include('database_connection.php');
session_start();
if(isset($_POST["login"]))
{
	$query = "
	SELECT * FROM register_user 
		WHERE user_email = :user_email
	";
	$statement = $connect->prepare($query);
	$statement->execute(
		array(
				'user_email'	=>	$_POST["user_email"]
			)
	);
	$count = $statement->rowCount();
	if($count > 0)
	{
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			if($row['user_email_status'] == 'verified')
			{
				if(password_verify($_POST["user_password"], $row["user_password"]))
				
				{	$_SESSION['us_id'] = $row['user_id'];
					$_SESSION['user_id'] = $row['register_user_id']; 
					$_SESSION['profile_foto'] = $row['profile_foto']; 
					$_SESSION['first_name'] = $row['first_name']; 
					$_SESSION['user_name'] = $row['user_name'];
					$_SESSION['user_activation_code'] = $row['user_activation_code'];
					$user_activation_code=$_SESSION['user_activation_code'];
					$user_name=$_SESSION['user_name'];


					header("location:index.php");
				}
				else
				{
					$message = "<label>Wrong Password</label>";
				}
			}
			else
			{
				$message = "<label class='text-danger'>Please First Verify, your email address</label>";
			}
		}
	}
	else
	{
		$message = "<label class='text-danger'>Wrong Email Address</label>";
	}
}

?>

<!DOCTYPE html>
<html>
	<head>
				
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<link rel="stylesheet" href="login.css">
	</head>
	<body>
		<div class=" form-log">
			<div class="panel panel-default">
				<div class="panel-body rel">
					<form method="post">
						<?php echo $message; ?>
						<div class="form-group ">
							<input type="email" name="user_email" class="form-control email" required autocomplete="off" placeholder="Username"/>
						</div>
						<div class="form-group ">
							<input type="password" name="user_password" class="form-control password" autocomplete="off" required  placeholder="Password"/>
						</div>
						<div class="form-group ">
							<input type="submit" name="login" value="Log in" class="btn btn-danger login-btn" />
						</div>
					</form>
					<div class="register-link"><a href="register.php" >or Register</a></div>
				</div>
			</div>
		</div>
	</body>
</html>

