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
	if($no_of_row > 0){$mail = $_POST['user_email']; $_SESSION['mail'] = $mail; header("location:np.php");}
else
{
echo "Email not found, try again";
}
}?>	
		

<!DOCTYPE html>
<html>
	<head>
		<title> Restore password </title>		
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
					<form method="post" id="register_form" >
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
		</div>
	</body>
</html>

