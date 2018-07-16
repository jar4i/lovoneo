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
				$_SESSION['user_id'] = $row['register_user_id'];
                                        $_SESSION['user_name'] = $row['user_name'];
                                        $_SESSION['user_activation_code'] = $row['user_activation_code'];
				
                                        header("location:index.php");}
									


				
					
				}
			}
			else
			{
				$message = '<label class="text-info">Your Email Address Already Verified</label>';
			}
		}
	}
	else
	{
		$message = '<label class="text-danger">Invalid Link</label>';
	}
}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Register/Login </title>		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>
		
		<div class="container">
			<h1 align="center"> Register confirmation</h1>
		
			<h3><?php echo $message; ?></h3>
			
		</div>
	
	</body>
	
</html>
