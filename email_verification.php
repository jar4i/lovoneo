<?php

include('database_connection.php');
$message = '';
$array = $_SESSION['array'];

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
		<link rel="stylesheet" href="menu.css">
		<link rel="shortcut icon" href="ico.png">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
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
	<div class="section_reg_confirm">
		<div class="wrap">
			<p><?php echo $message; ?></p>
		</div>
	</div>
	<div class="logo2"></div>
	</body>
</html>
