<?php
include('database_connection.php');
session_start();
include("connection.php");
$array = $_SESSION['array'];
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
					


					header("location:index.php");
				}
				else
				{
					$message = "<label>$array[12]</label>";/*13*/
				}
			}
			else
			{
				$message = "<label class='text-danger'>$array[11]</label>";/*12*/
			}
		}
	}
	else
	{
		$message = "<label class='text-danger'>$array[10]</label>";/*11*/
	}
}

?>

<!DOCTYPE html>
<html>
	<body>
		<div class="form-log" id="form-log">
			<div class="panel panel-default">
				<div class="panel-body rel" id="panel-body">
					<form method="post">
						<?php echo $message; ?>
						<div class="form-group ">
							<input type="email" name="user_email" class="form-control email" required autocomplete="off" placeholder="<?php echo $array[5];?>"/>
						</div>
						<div class="form-group ">
							<input type="password" name="user_password" class="form-control password" autocomplete="off" required  placeholder="<?php echo $array[6];?>"/>
						</div>
						<div class="form-group ">
							<input type="submit" name="login" value="<?php echo $array[4];?>" class="btn btn-danger  inline-block login-btn" /><!--10-->
							<a href="register.php" class="btn inline-block btn-danger register-link" ><?php echo $array[7];?></a><!--8-->
						</div>
					</form>
					<div class="fg-pass"><a href="password_restore.php"><?php echo $array[8];?></a></div><br><!--9-->
				</div>
			</div>
		</div>
	</body>
</html>

