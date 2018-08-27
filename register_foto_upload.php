
<?php 
session_start();
$array = $_SESSION['array'];
error_reporting(E_ALL | E_STRICT);
$array = $_SESSION['array'];
ini_set('display_errors', 'On');
if(empty($_GET["user_activation_code"])){
header('location:logout.php');
}
include("config.php");

if(isset($_POST["crop"])) {
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

$user_activation_code=$_GET["user_activation_code"];
$con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
$con= new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
$sthandler = $con->prepare("SELECT TIMESTAMPDIFF(YEAR, `birth_date`, CURDATE()) AS age, birth_date, city, weight, height,  country,  details, first_name, last_name, profile_foto FROM register_user  WHERE user_activation_code = '$user_activation_code'");
$sthandler->execute();
?>

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="menu.css">
    <link rel="stylesheet" href="personal_page_edit.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
</head>
<body><header class="head fixed">
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
		    <div class="text_edit"><?php echo $array[22];?> </div>
                        </label>
                </div>
                <div class="alert" role="alert"></div>
                <div class="modal" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel"><?php echo $array[43];?></h5>
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
                            <button type="button" class="btn btn-default " data-dismiss="modal"><?php $array[24];?></button>
                            <button type="button" class="notablock" ><?php $array[25];?></button>
                            <input type="submit" value="Upload Image" id="crop" class="notablock" name="cro">
				            <input type="submit" value="Upload Image" id="cro" class="btn btn-primary" name="crop">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        </div>
        <?php endwhile; ?>
        </div>
    </section>
    <section class="section_message">
        <div class="wrap">
        <?php 
             if(isset($_POST["crop"])) { ?>
            <div class="tex_message">
                <p><?php echo $array[54]; ?></p><p><?php echo $array[55];?></p>
            </div>
            <?php  } ?>
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

<script type="text/javascript">
$(document).ready(function(){
    $('._hamburger').click(function () {
        $('._nav').slideToggle();
    });
});
</script>
</body>












