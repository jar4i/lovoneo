
<head>
    <link rel="stylesheet" href="personal_page_edit.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.4.1/cropper.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
</head>
<?php
session_start();
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');
if(empty($_GET["user_activation_code"])){
header('location:logout.php');
}
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

/*
$_SESSION['profile_foto'] = $upload_image;s
$folder = "123/";
$upload_image = $folder . basename($_FILES["fileToUpload"]["name"]);
move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $upload_image);
$temp_img = imagecreatefromjpeg($upload_image);
$to_crop_array = array('x' =>$_COOKIE["x"], 'y' => $_COOKIE["y"], 'width' => $_COOKIE["width"], 'height'=> $_COOKIE["height"]);
$im2 = imagecrop($temp_img, $to_crop_array);
imagejpeg($im2, '123/new1.jpeg');
*/

/*$to_crop_array = array('x' =>$_COOKIE["x"], 'y' => $_COOKIE["y"], 'width' => $_COOKIE["width"], 'height'=> $_COOKIE["height"]);
$im2 = imagecrop($upload_image, $to_crop_array);
imagejpeg($im2, '123/new.jpeg');
echo $update_img;
*/





?>
<?php
$user_activation_code= $_GET["user_activation_code"];
if(isset($_POST["save"])) {
$birth_date = $_POST['birth_date'];
$weight = $_POST['weight'];
$height = $_POST['height'];
$details = $_POST['details'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$country = $_POST['country'];
$city = $_POST['city'];
$insert_query="UPDATE register_user SET details = '$details', first_name = '$first_name', last_name = '$last_name', country = '$country', city ='$city', weight = '$weight', height = '$height', birth_date = '$birth_date' WHERE user_activation_code = '$user_activation_code' ";
$con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
$con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
$stmt = $con->prepare($insert_query);
$stmt->execute();
$_SESSION['first_name'] = $first_name;
}
?>
<?php 
$user_activation_code=$_GET["user_activation_code"];
$con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
$con= new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
$sthandler = $con->prepare("SELECT TIMESTAMPDIFF(YEAR, `birth_date`, CURDATE()) AS age, birth_date, city, weight, height,  country,  details, first_name, last_name, profile_foto FROM register_user  WHERE user_activation_code = '$user_activation_code'");
$sthandler->execute();
?>
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
                        <img class="rounded prof_photo" id="avatar" src = "<?php echo $row ['profile_foto']?>" alt="avatar">
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
        

        </div>
    </section>
    <section class="section_question">
        <div class="wrap">
            <form action="" method="post" enctype="multipart/form-data" class="form_1">
            <div class="header_question">*** Required fields ***</div>
                <div class="input_block">
                    <div class="block_name inline-block">
                        <label for="first_name">First name: </label>
                        <div class="input_box rel">
                            <input class="input_info" type="text" name="first_name" id="first_name"  value="<?php echo $row ['first_name']?>">
                            <div class="icon_box"><i class="fas fa-pen"></i></div>
                        </div>
                        <label for="last_name">Last name: </label>
                        <div class="input_box rel">
                            <input type="text" class="input_info" name="last_name" id="last_name"  value="<?php echo $row ['last_name']?>">
                            <div class="icon_box"><i class="fas fa-pen"></i></div>
                        </div>
                    </div>
                    <div class="block_state inline-block">
                        <label for="country">State: </label>
                        <div class="input_box rel">
                            <input type="text" class="input_info" name="country" id="country"  value="<?php echo $row ['country']?>">
                            <div class="icon_box"><i class="fas fa-pen"></i></div>
                        </div>
                        <label for="city">City: </label>
                        <div class="input_box rel">
                            <input type="text" class="input_info" name="city" id="city"  value="<?php echo $row ['city']?>">
                            <div class="icon_box"><i class="fas fa-pen"></i></div>
                        </div>
                    </div>
                    <div class="block_center">
                        <label for="birth_date">Birth Date: </label>
                        <div class="input_box rel">
                            <input type="text" class="input_info" name="birth_date" id="birth_date"  value="<?php echo $row ['birth_date']?>">
                            <div class="icon_box"><i class="fas fa-pen"></i></div>
                        </div>
                    </div>
                </div>
                <div class="header_question">*** Personal information ***</div>
                <div class="input_block">
                    <div class="block_name inline-block">
			            <label for="weight">Weight: </label>
                        <div class="input_box rel">
                            <input type="text" class="input_info" name="weight" id="weight"  value="<?php echo $row ['weight']?>">
                            <div class="icon_box"><i class="fas fa-pen"></i></div>
                        </div>
                    </div>
                    <div class="block_state inline-block">
			            <label for="height">Height: </label>
                        <div class="input_box rel">
                            <input type="text" class="input_info" name="height" id="height"  value="<?php echo $row ['height']?>">
                            <div class="icon_box"><i class="fas fa-pen"></i></div>
                        </div>
                    </div>

                    <div class="block_center">
                        <label for="details">About me: </label>
                        <div class=" rel">
                            <textarea placeholder="Write something about yourself..." class="input_info_textarea" name="details" id="details" ><?php echo $row ['details']?></textarea>
                            <div class="icon_box"><i class="fas fa-pen"></i></div>
                        </div>
                    </div>
                </div>
            <?php endwhile;?>
                <div class="btn_save_inf">
                    <input type="submit" value="SAVE INFORMATION" class="btn btn-danger " name="save" id="save">
                </div>
            </form>
        </div>
    </section>
    <section class="section_drop_me">
        <div class="wrap">
            <div class="header_question">*** Upload photos in your albom ***</div>

            <?php include('albums/index.php');?>
            <div class="btn_save_inf">
                    <input type="submit" value="SAVE INFORMATION" class="btn btn-danger " onClick="history.go(0)"  name="save" id="save">
                </div>
            <div class="header_question">*** Delete photos from your albom ***</div>

            <div class = "view">
                <?php
                $user_id=$_GET["user_id"];
                include('fotos/view1.php');?>

            </div>
            <div class="btn_save_inf">
                    <input type="submit" value="SAVE INFORMATION" class="btn btn-danger " name="save"  onClick="history.go(0)"  id="save">
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












