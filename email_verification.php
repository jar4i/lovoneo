<?php

include('database_connection.php');

$message = '';

if(isset($_GET['activation_code']))
{
	$query = "
		SELECT * FROM register_user 
		WHERE user_activation_code = :user_activation_code
	";
	$statement = $connect->prepare($query);
	$statement->execute(
		array(
			':user_activation_code'			=>	$_GET['activation_code']
		)
	);
	$no_of_row = $statement->rowCount();
	
	if($no_of_row > 0)
	{
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			if($row['user_email_status'] == 'not verified')
			{
				$update_query = "
				UPDATE register_user 
				SET user_email_status = 'verified' 
				WHERE register_user_id = '".$row['register_user_id']."'
				";
				
				$statement = $connect->prepare($update_query);
				$statement->execute();
				$sub_result = $statement->fetchAll();
				$register_user_id = $row['register_user_id'];
				if(isset($sub_result))
				{
				$select_query = "SELECT * FROM register_user WHERE register_user_id = ".$register_user_id."";
                                $stmt = $connect->prepare($select_query);
                                $stmt->execute();
                                $sel_result = $stmt->fetchAll();
				foreach($sel_result as $row);
				if(isset($register_user_id)){
				session_start();
				$_SESSION['us_id'] = $row['user_id'];
					$_SESSION['user_id'] = $row['register_user_id']; 
					$_SESSION['profile_foto'] = $row['profile_foto']; 
					$_SESSION['first_name'] = $row['first_name']; 
					$_SESSION['user_name'] = $row['user_name'];
					$_SESSION['user_activation_code'] = $row['user_activation_code'];
				
                                        header("location:index.php");}
									


				
					
				}
			}
			else
			{
				$message = '<label ">Your Email address already verified!</label>';
			}
		}
	}
	else
	{
		$message = '<label class="text-danger">Invalid Link!</label>';
	}
}

?>
<!DOCTYPE html>
<html>
	<head>	
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Register </title>		
		<link rel="stylesheet" href="style.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	</head>
	<body>
	<header class="head fixed">
		<div class="wrap">
			<a class="active inline-block " href="index.php">Home |</a>
			<a href="login_page.php" class="float-right inline-block">Log in</a>
		</div>
	</header>
	<div class="section_reg_confirm">
		<div class="wrap">
			<p><?php echo $message; ?></p>
		</div>
	</div>
	<div class="logo2"></div>
	</body>
</html>
