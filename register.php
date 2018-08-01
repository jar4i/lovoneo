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

if(isset($_POST["submit"])) {
$user_activation_code = $_GET["user_activation_code"];
$folder = "uploads/";
$upload_image = $folder . basename($_FILES["fileToUpload"]["name"]);
move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $upload_image);
$temp_img = imagecreatefromjpeg($upload_image);
$to_crop_array = array('x' =>$_COOKIE["x"], 'y' => $_COOKIE["y"], 'width' => $_COOKIE["width"], 'height'=> $_COOKIE["height"]);
$im2 = imagecrop($temp_img, $to_crop_array);
imagejpeg($im2, $folder . basename($_FILES["fileToUpload"]["name"]));
$update_img = ($folder . basename($_FILES["fileToUpload"]["name"]));
$con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
$insert_query="UPDATE register_user SET profile_foto = '$update_img' WHERE user_activation_code = '$user_activation_code'";
$stmt = $con->prepare($insert_query);
$stmt->execute();
$_SESSION['profile_foto'] = $update_img;
}
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
				':user_name'			=>	$_POST['user_name'],
				':user_email'			=>	$_POST['user_email'],
				':user_password'		=>	$user_encrypted_password,
				':user_activation_code'		=>	$user_activation_code,
				':user_id'			=>	$user_id,
				':user_email_status'		=>	'not verified',
				':first_name'    		=>      'User',
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
		$_SESSION['profile_foto'] = "uploads/default.png";
		$result = $statement->fetchAll();
		if(isset($result))
		{
			$base_url = "https://lovoneo.com/";  
			$mail_body = "
			<p>Hi ".$_POST['user_name'].",</p>
			<p>Thanks for Registration. Your password is ".$user_password.", This password will work only after your email verification.</p>
			<p>Please Open this link to verified your email address - ".$base_url."email_verification.php?user_activation_code=".$user_activation_code."
			<p>Best Regards,<br />Lovoneo</p>
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
				header("location:register_done.php");
			}
		}
	}
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title> Register </title>	
		<link rel="stylesheet" href="register.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>
	<header class="head fixed">
    <div class="wrap">
        <nav class="pull_left">
        
            <ul class="list-unstyled ">
            <a class="active" href="index.php">Home |</a>
            <a class="active" href="view_profile.php"> <?php 
            if (isset($_SESSION['user_name'])) {
                echo "Profile";
                echo '  |';} 
            ?>
            </a>
            <a class="active" href="message1/message.php"> <?php 
            if (isset($_SESSION['user_name'])) {
                echo "Massage";
                echo '  |';
            }
            ?>
            </a>
   

            <a class="active" href="personal_page_edit.php?user_activation_code=<?php echo $_SESSION['user_activation_code'];?>&&user_id=<?php echo $_SESSION['user_id'];?>">
            <?php
            if (isset($_SESSION['user_name'])) {
                echo "Edit profile";
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
<section class="section_profile_photo mt-8">
        <div class="wrap">
    <?php while($row = $sthandler->fetch(PDO::FETCH_ASSOC)) : ?>
        
        <div class="container">
            <form class ="button_foto" action="" method="post" enctype="multipart/form-data">
                <div class="clearfix_card rel">
                    <div class="prof_photo_box">
                        <img class="rounded prof_photo" id="avatar" src = "<?php if(isset($row ['profile_foto'])){echo $row ['profile_foto'];}else{echo "uploads/default""}?>" alt="avatar">
                    </div>
                        <input type="file"  id="input" name="fileToUpload" >
                        <label for="input"  class="text_edit_box"> 
                            <div class="btn-add-photo"><i class="fas fa-camera"></i></div>
                            <div class="text_edit"> Edit your profile photo</div>
                        </label>
                </div>
                <div class="alert" role="alert"></div>
                <div class="modal" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel">Crop the image</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="img-container">
                            <img id="image" src="image_crop/default.jpg">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary" id="zoom-in" title="Zoom In">
                                    <span class="docs-tooltip" data-toggle="tooltip" >
                                    <span class="fa fa-search-plus"></span>
                                    </span>
                                </button>
                                <button type="button" class="btn btn-primary" id="zoom-out" title="Zoom Out">
                                    <span class="docs-tooltip" data-toggle="tooltip" >
                                    <span class="fa fa-search-minus"></span>
                                    </span>
                                </button>
                            </div>
                            <div class="btn-group btn-group-footer">
                                <button type="button" class="btn btn-primary" id="move-left" title="Move Left">
                                    <span class="docs-tooltip" data-toggle="tooltip" >
                                    <span class="fa fa-arrow-left"></span>
                                    </span>
                                </button>
                                <button type="button" class="btn btn-primary" id="move-right" title="Move Right">
                                    <span class="docs-tooltip" data-toggle="tooltip" >
                                    <span class="fa fa-arrow-right"></span>
                                    </span>
                                </button>
                                <button type="button" class="btn btn-primary" id="move-up" title="Move Up">
                                    <span class="docs-tooltip" data-toggle="tooltip">
                                    <span class="fa fa-arrow-up"></span>
                                    </span>
                                </button>
                                <button type="button" class="btn btn-primary" id="move-down" title="Move Down">
                                    <span class="docs-tooltip" data-toggle="tooltip" s>
                                    <span class="fa fa-arrow-down"></span>
                                    </span>
                                </button>
                            </div>
                            <button type="button" class="btn btn-default " data-dismiss="modal">Cancel</button>
                            <button type="button" class="notablock" >Crop</button>
                            <input type="submit" value="Upload Image" id="crop" class="btn btn-primary" name="submit">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        </div>
		<?php endwhile;?>
        

        </div>
    </section>
		<section class="section_register rel">
			<div class="wrap" >
            	<div class="logo"></div>
				<div class="panel panel-default">
					<div class="panel-body">
						<form method="post" id="register_form">
							<?php echo $message; ?>
							<div class="form-group">
								<label for="user_name">User Name</label>
								<input type="text" name="user_name" id="user_name" class="form-control email" value="<?php echo isset($_POST['user_name']) ? $_POST['user_name'] : '' ?>" pattern="[a-zA-Z ]+" required />
							</div>
							<div class="form-group">
								<label for="user_email">User Email</label>
								<input type="email" name="user_email" id="user_email" class="form-control email" value="<?php echo isset($_POST['user_email']) ? $_POST['user_email'] : '' ?>" required />
							</div>
							<div class="form-group">
								<label for="user_password">Your Password</label>
								<input type="text" name="user_password" id="user_password" class="form-control password" value="<?php echo isset($_POST['user_password']) ? $_POST['user_password'] : '' ?>" required />
							</div>
							<div class="form-group">
								<label for="gender">Gender</label>
								<select name="gender">
									<option value="male">male</option>
									<option value="female">female</option>
								</select> 
							</div>
							<div class="form-group">
								<label for="birth_date">Birthday</label>
								<input type="date" name="birth_date" id="birth_date" class="form-control email" value="<?php echo isset($_POST['birth_date']) ? $_POST['birth_date'] : '' ?>" required />
							</div>

							<div class="form-group">
								<input type="submit" name="register" id="register" value="Register" class="btn btn-danger register-btn" />
							</div>

							
						</form>
						<div class="login-link btn btn-danger "><a href="login_page.php" >Log in</a></div>
					</div>
				</div>
			</div>
		</section>
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.bundle.min.js"></script>
  <script src="cropper.js"></script>
  
  <script>
      
    window.addEventListener('DOMContentLoaded', function () {
      var avatar = document.getElementById('avatar');
      var image = document.getElementById('image');
      var input = document.getElementById('input');
      var moveLeft = document.getElementById('move-left');
      var moveRight = document.getElementById('move-right');
      var moveUp = document.getElementById('move-up');
      var moveDown = document.getElementById('move-down');
      var zoomIn = document.getElementById('zoom-in');
      var zoomOut = document.getElementById('zoom-out');
      var $alert = $('.alert');
      var $modal = $('#modal');
      var cropper;
      $('[data-toggle="tooltip"]').tooltip();
      
      moveLeft.addEventListener('click', function(){
        cropper.move(4, 0);
      })
      moveRight.addEventListener('click', function(){
        cropper.move(-4, 0);
      })
      moveUp.addEventListener('click', function(){
        cropper.move(0, 4);
      })
      moveDown.addEventListener('click', function(){
        cropper.move(0, -4);
      })
      zoomIn.addEventListener('click', function(){
        cropper.zoom(0.1);
      })
      zoomOut.addEventListener('click', function(){
        cropper.zoom(-0.1);
      })
      input.addEventListener('change', function (e) {
        var files = e.target.files;
        var done = function (url) {
          
          image.src = url;
          $alert.hide();
          $modal.modal('show');
        };
        var reader;
        var file;
        var url;

        if (files && files.length > 0) {
          file = files[0];

          if (URL) {
            done(URL.createObjectURL(file));
          } else if (FileReader) {
            reader = new FileReader();
            reader.onload = function (e) {
              done(reader.result);
            };
            reader.readAsDataURL(file);
          }
        }
      }); 
     
        var cook = function createCookie(x, y, w, h) {
            document.cookie = "y=" + escape(y) 
              + "; path=/";
             document.cookie =  "width=" + escape(w) 
             +  "; path=/";
             document.cookie = 
             "height=" + escape(h)  + "; path=/";
             document.cookie = "x=" + escape(x) 
              + "; path=/";
        }
      var data = document.querySelector('#data');
      $modal.on('shown.bs.modal', function () {
        cropper = new Cropper(image, {
            
        ready: function (event) {
          // Zoom the image to its natural size
          cropper.zoomTo(1);
        },

        crop: function (event) {
            cook(cropper.getData().x, cropper.getData().y, cropper.getData().width, cropper.getData().height);
        },

          dragMode: 'move',
        aspectRatio: 200 / 250,
        autoCropArea: 0.65,
        restore: false,
        guides: false,
        center: false,
        highlight: false,
        cropBoxMovable: false,
        cropBoxResizable: false,
        toggleDragModeOnDblclick: false,
        });
        
      }).on('hidden.bs.modal', function () {
        cropper.destroy();
        cropper = null;
      });

      document.getElementById('crop').addEventListener('click', function () {
        var initialAvatarURL;
        var canvas;

        $modal.modal('hide');

        if (cropper) {
          canvas = cropper.getCroppedCanvas({
            width: 160,
            height: 160,
          });
          initialAvatarURL = avatar.src;
          avatar.src = canvas.toDataURL();
        }
      });
    });
  </script>
	</body>
</html>
