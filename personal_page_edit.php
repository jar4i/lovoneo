
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
$user_activation_code= $_GET["user_activation_code"];
$folder = "uploads/";
$image_src = imagecreatefrompng($_FILES['uploads/1.png']['1.png']);
$im2 = imagecrop($image_src, ['x' => 0, 'y' => 0, 'width' => 400, 'height' => 200]);
imagedestroy($_FILES["fileToUpload"]["name"]);
$im2 = $folder . basename($_FILES["fileToUpload"]["name"]);
echo $_COOKIE["x"];
echo $_COOKIE["y"];
echo $_COOKIE["width"];
echo $_COOKIE["height"];

if(isset($_POST["submit"])) {
if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $im2)) {
$insert_query="UPDATE register_user SET profile_foto = '$im2' WHERE user_activation_code = '$user_activation_code'";
$_SESSION['profile_foto'] = $im2;
$con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
$con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
$stmt = $con->prepare($insert_query);
$stmt->execute();
}
}
?>
<?php
$user_activation_code= $_GET["user_activation_code"];
if(isset($_POST["save"])) {
$_POST['details'];
$_POST['first_name'];
$_POST['last_name'];
$_POST['country'];
$_POST['city']; 
$details = $_POST['details'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$country = $_POST['country'];
$city = $_POST['city'];
$insert_query="UPDATE register_user SET details = '$details', first_name = '$first_name', last_name = '$last_name', country = '$country', city ='$city'  WHERE user_activation_code = '$user_activation_code' ";
$con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
$con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
$stmt = $con->prepare($insert_query);
$stmt->execute();
}
?>
<?php 
$user_activation_code=$_GET["user_activation_code"];
$con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
$con= new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
$sthandler = $con->prepare("SELECT TIMESTAMPDIFF(YEAR, `birth_date`, CURDATE()) AS age, city, country,  details, first_name, last_name, profile_foto FROM register_user  WHERE user_activation_code = '$user_activation_code'");
$sthandler->execute();
?>
<body>
   <!-- <header class="head fixed">
        <div class="wrap">
            <nav class="pull_left">
                <ul class="list-unstyled ">
                  <a class="active" href="index.php"><li class="li-item inline-block">Home</li></a>
                  <a href="#news"><li class="li-item inline-block">News</li></a>
                  <a href="#contact"><li class="li-item inline-block">Contact</li></a>
                  <a href="#about"><li class="li-item inline-block">About</li></a>
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
                    ?>
            </div>
        </div>
    </header>-->
    <?php while($row = $sthandler->fetch(PDO::FETCH_ASSOC)) : ?>

    <section class="section_profile_photo mt-8">
        <div class="wrap">
            <div class="clearfix_card rel">
                <div class="prof_photo_box">
                    <img src = "<?php echo $row ['profile_foto']?>" class="prof_photo">
                </div>
                <div class="btn-add-photo"><i class="fas fa-plus"></i></div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <h1>Upload cropped image to server</h1>
            <img class="rounded" id="avatar" src="image_crop/default.jpg" alt="avatar">

            <label class="label" data-toggle="tooltip" title="Change your avatar">
            <form class ="button_foto" action="" method="post" enctype="multipart/form-data">

                <input type="file"  id="input" name="fileToUpload" >
                <input type="submit" value="Upload Image" name="submit">
            </form>
            </label>
            <div class="alert" role="alert"></div>
            <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="crop">Crop</button>
                </div>
                </div>
            </div>
        </div>
        <?php endwhile;?>

    <p><strong>Data: </strong><span id="data"></span></p>
    <p><strong>Crop Box Data: </strong><span id="cropBoxData"></span></p>
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
      var $alert = $('.alert');
      var $modal = $('#modal');
      var cropper;

      $('[data-toggle="tooltip"]').tooltip();

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
            console.log(cropper.getData());
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
          console.log(avatar.src);
        }
      });
    });
  </script>
</body>


<<<<<<< HEAD
=======
	

<div class="demo"></div>
>>>>>>> 6f891795eb827d17960b4779786c1bbc5465dbc5

<!--
<form action="" method="post" enctype="multipart/form-data">
<textarea name="details"><?php echo $row ['details']?></textarea>
<div class="input_block"><label for="first_name">First name: </label><input type="text" name="first_name" id="first_name"  value="<?php echo $row ['first_name']?>"><br>
<label for="last_name">Last name: </label><input type="text" name="last_name" id="last_name"  value="<?php echo $row ['last_name']?>"><br>
<label for="country">State: </label><input type="text" name="country" id="country"  value="<?php echo $row ['country']?>"><br>
<label for="city">City: </label><input type="text" name="city" id="city"  value="<?php echo $row ['city']?>"><br>
</div>
<input type="submit" value="save info" name="save" id="save">
</form>
</div>
<<<<<<< HEAD
=======

<?php endwhile;?>
>>>>>>> 6f891795eb827d17960b4779786c1bbc5465dbc5

<div>
<?php include('albums/index.php');?>
</div>
<div class = "view">

<?php
$user_id=$_GET["user_id"];
include('fotos/view.php');?>
</div>
<<<<<<< HEAD
=======




>>>>>>> 6f891795eb827d17960b4779786c1bbc5465dbc5

-->





