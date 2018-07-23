<?php require_once("connect.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
 
</head>
<body style="background:#eee;">
    <!-- login -->
    <div class="login-container">
        <?php
            /*login script*/
            if(isset($_POST['login'])){
                $username = trim(mysqli_real_escape_string($con, $_POST['username']));
                $password = trim(mysqli_real_escape_string($con, $_POST['password']));
                $md5password = md5($password);
                //check user and password match to the database
                $query = mysqli_query($con,"SELECT * FROM `user` WHERE username='$username' AND password='$md5password'");
                //check how much rows return
                if(mysqli_num_rows($query) == 1){
                    //login the user
 
                    //get the id of the user
                    $fetch = mysqli_fetch_assoc($query);
                    //start the session and store user id in the session
                    session_start();
                    $_SESSION['id'] = $fetch['id'];
                    $_SESSION['username'] = $fetch['username'];
                    header("Location: message.php");
                }else{
                    //show error message
                    echo "<div class='alert alert-danger'>Invalid username Or password.</div>";
                }
            }
        ?>
        <h1>Login</h1>
        <form action="index.php" method="post">
            <div class="form-group">
                <input required type="text" class="form-control" name="username" placeholder="Enter Your username.">
            </div>
            <div class="form-group">
                <input required type="password" class="form-control" name="password" placeholder="Enter Your password.">
            </div>
            <input type="submit" value="login"  name="login" class="btn btn-primary btn-block">
        </form>
 
    </div>
</body>
</html>
