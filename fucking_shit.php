
<?php
session_start();
error_reporting(E_ALL | E_STRICT);
$array = $_SESSION['array'];
ini_set('display_errors', 'On');
if(empty($_GET["user_activation_code"])){
header('location:logout.php');
}
include("config.php");
$user_activation_code=$_GET["user_activation_code"];
$con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
$sthandler = $con->prepare("SELECT TIMESTAMPDIFF(YEAR, `birth_date`, CURDATE()) AS age, user_id, birth_date, city, weight, height, country, details, first_name, last_name, profile_foto FROM register_user  WHERE user_activation_code = '$user_activation_code'");
$sthandler->execute();
while($row = $sthandler->fetch(PDO::FETCH_ASSOC)) :
if(isset($_POST["submit"])) {
    $user_activation_code = $_GET["user_activation_code"];
    if(basename($_FILES["fileToUpload"]["name"])){
        $folder = "uploads/";
        $upload_image = $folder . basename($_FILES["fileToUpload"]["name"]);
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $upload_image);
        $temp_img = imagecreatefromjpeg($upload_image);
        $to_crop_array = array('x' =>$_COOKIE["x"], 'y' => $_COOKIE["y"], 'width' => $_COOKIE["width"], 'height'=> $_COOKIE["height"]);
        $im2 = imagecrop($temp_img, $to_crop_array);
        imagejpeg($im2, $folder . basename($_FILES["fileToUpload"]["name"]));
        $update_img = ($folder . basename($_FILES["fileToUpload"]["name"]));
    }
    else{
        $upload_image = $row ['profile_foto'];
        $temp_img = imagecreatefromjpeg($upload_image);
        $to_crop_array = array('x' =>$_COOKIE["x"], 'y' => $_COOKIE["y"], 'width' => $_COOKIE["width"], 'height'=> $_COOKIE["height"]);
        $im2 = imagecrop($temp_img, $to_crop_array);
        imagejpeg($im2, $row ['profile_foto']);
        $update_img = ($row ['profile_foto']);
    }
    $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $insert_query="UPDATE register_user SET profile_foto = '$update_img' WHERE user_activation_code = '$user_activation_code'";
    $stmt = $con->prepare($insert_query);
    $stmt->execute();
    $_SESSION['profile_foto'] = $update_img;
    $uac = $_SESSION['user_activation_code'];
	$usi = $_SESSION['user_id'];
    header("Location: https://lovoneo.com/personal_page_edit.php?user_activation_code=$uac &&user_id= $usi");
    
}

?>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
    <link  href="css/cropper.css" rel="stylesheet">
<link rel="shortcut icon" href="ico.png">
    <link rel="stylesheet" href="personal_page_edit.css">
    <link rel="stylesheet" href="menu.css">
</head>
<style>
    img {
  max-width: 100%; /* This rule is very important, please do not ignore this! */
}
</style>
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
<div class="section">
    <div class="wrap">       
        <div class="btn_back_box">
            <a href="personal_page_edit.php?user_activation_code=<?php echo $user_activation_code;?>&&user_id=<?php echo $row ['user_id'];?>" class="btn_back">Back to profile</a>
        </div>
    </div>
</div>
<div class="section_upload">
    <div class="wrap">
        <div class="photo-box">
            <div>
                <img id="image" src="<?php echo $row ['profile_foto']?>" alt="Choze file to upload, not a png">
            </div>
        </div>
    </div>
</div>
<div class="section_btns">
    <div class="wrap">
        <div class="btn-box">
            <form action="" method="post" enctype="multipart/form-data">
                <label for="input" class="btn_violet btn">Choose file</label>
                <input type="file"  id="input" name="fileToUpload" class="notablock">
                <input type="submit" value="Upload Image" id="crop" class="btn btn_violet" name="submit" >
            </form>
        </div>
    </div>
</div>

                <?php endwhile;?>


    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.bundle.min.js"></script>
  <script src="cropper.js"></script>
  


  <script>
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
      const image = document.getElementById('image');
      var inputImage = document.getElementById('input');
      cropper = new Cropper(image,{
        dragMode: 'move',
        aspectRatio: 200 / 250,
        autoCropArea: 0.65,
        restore: false,
        highlight: false,
        
        toggleDragModeOnDblclick: false,
        crop: function (event) {
            cook(cropper.getData().x, cropper.getData().y, cropper.getData().width, cropper.getData().height);
        },
});
  if (URL) {
    inputImage.onchange = function () {
      var files = this.files;
      var file;

      if (files &&  files.length > 0) {
        file = files[0];

        if (/^image\/\w+/.test(file.type)) {
          uploadedImageType = file.type;
          uploadedImageName = file.name;


          image.src = uploadedImageURL = URL.createObjectURL(file);
          cropper.destroy();
          cropper = new Cropper(image,{
        dragMode: 'move',
        aspectRatio: 200 / 250,
        autoCropArea: 0.65,
        restore: false,
        highlight: false,
        toggleDragModeOnDblclick: false,
        crop: function (event) {
            cook(cropper.getData().x, cropper.getData().y, cropper.getData().width, cropper.getData().height);
        },
  
});
        } else {
          window.alert('Please choose an image file.');
        }
      }
    };
  } else {
    inputImage.disabled = true;
    inputImage.parentNode.className += ' disabled';
  }

    </script>
  
</body>












