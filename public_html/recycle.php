<?php
  require_once "config.php";
  
  session_start();
  $username ="";
  if(!empty($_SESSION['user_id'])){
      $username = $_SESSION['username'];
  }

  if(empty($_SESSION['user_id'])){
    header("Location: LoginPage.php");
  }
  
  $recycle_id = "";
  $user_id = "1312ab";
  $weight= "";
  $bin_location = "";
  $recycle_date = "";
  $recycle_time = "";
  // $insertFlag = true;
  // echo $user_id;
  if(!empty($_POST)){
    $insertFlag = true;
    foreach($_POST as $x => $val){
      if(empty($val)){
        $insertFlag = false;
      }
    }
    if($insertFlag){
      $weight = $_POST['weight-input'];
      $bin_location = $_POST['location-input'];
      $recycle_date = $_POST['date-input'];
      $recycle_time = $_POST['time-input'];

      $img_paths = [];
      $recycle_id = uniqid();
      if (!empty($_FILES['photo-input']['name'])) {
        $filesCount = count($_FILES['photo-input']['name']);

        for ($i = 0; $i < $filesCount; $i++) {
          $fileTmp = $_FILES['photo-input']['tmp_name'][$i];
          $fileName = $_FILES['photo-input']['name'][$i];
          $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
          $newFileName = $recycle_id . "-" . $i . "." . $fileExt;
          $uploadPath = 'uploads/' . $newFileName;

          if (move_uploaded_file($fileTmp, $uploadPath)) {
            $img_paths[] = $uploadPath;
          }
        }
      }
      insertRecycle($img_paths);
      echo '<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script>
        $(document).ready(function() {
            swal({
              title: "Verification in progress",
                text: "Thrift Points will be awarded upon successful verification.",
                icon: "success",
                button: "OK"
            });
        });
      </script>';
    }
  }
  function insertRecycle($image){
    global $pdo,$recycle_id,$user_id,$weight,$bin_location,$recycle_date,$recycle_time;
    $recycle_query = "INSERT INTO recycle(recycle_id,user_id,weight,bin_location,recycle_date,recycle_time) VALUES (:recycle_id,:user_id,:weight,:bin_location,:recycle_date,:recycle_time)";
    $stmt = $pdo->prepare($recycle_query);
    $stmt -> bindParam(":recycle_id",$recycle_id);
    $stmt -> bindParam(":user_id",$user_id);
    $stmt -> bindParam(":weight",$weight);
    $stmt -> bindParam(":bin_location",$bin_location);
    $stmt -> bindParam(":recycle_date",$recycle_date);
    $stmt -> bindParam(":recycle_time",$recycle_time);
    // print("check");
    $stmt -> execute();
    // var_dump($image);
    for($i=0;$i<count($image);$i++){
    //   echo "Recycle ID: " . $recycle_id . "<br>";
    // echo "Image Path: " . $image[$i] . "<br>";
      insertProofPhotos($recycle_id,$image[$i]);
  }
  }
  function insertProofPhotos($id,$path){
    // print("check");
    global $pdo;
    $query="INSERT INTO recycle_img(recycle_id,img_path) VALUES (?,?)";
    $stmt = $pdo->prepare($query);
    $stmt -> bindParam(1,$id);
    $stmt -> bindParam(2,$path);
    $stmt -> execute();
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Timeless Thrift</title>
    <link rel="stylesheet" href="static\css\bootstrap.min.css"/>
    <link rel="stylesheet" href="static\css\style.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  </head>
  <body>
 <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container-fluid">

        <ul class="collapse-menu">
          <a class="collapse-icon" onclick="toggleSubmenu()"><img src="static\img\icon\menu.svg" class="icon"></a>
      </ul>

    <div class="submenu-wrapper">    
      <div class="submenu">
        <div class="left-column">
          <ul class="submenulists">
            <h3 class="active-h3">Women</h3>
            <li><a href="#">New</a></li>
            <li><a href="#">Best Sellers</a></li>
            <li><a href="./productPage.php?type=outerwear&gender=women">Outerwear</a></li>
            <li><a href="./productPage.php?type=dress&gender=women">Dresses</a></li>
            <li><a href="./productPage.php?type=tops&gender=women">Tops</a></li>
            <li><a href="./productPage.php?type=bottoms&gender=women">Bottoms</a></li>
          </ul>
          <ul class="submenulists">
            <h3>Men</h3>
            <li><a href="#">New</a></li>
            <li><a href="#">Best Sellers</a></li>
            <li><a href="./productPage.php?type=blazers&gender=men">Blazers</a></li>
            <li><a href="./productPage.php?type=outerwear&gender=men">Outerwear</a></li>
            <li><a href="./productPage.php?type=tops&gender=men">Tops</a></li>
            <li><a href="./productPage.php?type=bottoms&gender=men">Bottoms</a></li>
          </ul>
          <ul class="submenulists">
            <h3>Kids</h3>
            <li><a href="#">New</a></li>
            <li><a href="#">Best Sellers</a></li>
            <li><a href="#">Newborn girl | 0 - 9 Months</a></li>
            <li><a href="#">Newborn boy | 0 - 9 Months</a></li>
            <li><a href="#">Baby girl | 9 Months - 6 Years</a></li>
            <li><a href="#">Baby boy | 9 Months - 6 Years</a></li>
            <li><a href="#">Newborn girl | 6 Years - 14 Years</a></li>
            <li><a href="#">Newborn girl | 6 Years - 14 Years</a></li>
            </ul>
        </div>

          <ul class="submenulists">
            <div class="right-column">
              <h3>Recycle</h3>
              <li><a href="recycle.php">Recycle clothes with us</a></li>
            </div>
          </ul>
      </div>
    </div>

    <a href="index.php"><img src="static/img/TimelessThrift.png" class="logo"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarResponsive">
      <ul class="navbar-nav">
        <li class="nav-item">
          
        <h4 class="showUsername"><?php !empty($_SESSION['username']) ? print("Welcome, ".$username) : "" 
          ?></h4>
        </li>
        
          <li class="nav-item active">
          
          <a href="#" class="nav-link">Contact</a>
        </li>
      <div class="navbar-icons">
        <div class="user-tooltip">
          <?php if (!empty($username)): ?>
            <a href="logout.php">Sign Out</a>
          <?php else: ?>
            <a href="LoginPage.php">Sign In</a>
            <a href="RegisterPage.php">Sign Up</a>
          <?php endif; ?>
        </div>
        <a class="user-icon" onclick="toggleUser()"><i class="far fa-user"></i> </a>
          <a href="addProduct.php"><i class="fas fa-tshirt"></i></a> 
          <a href="gamification.php"><i class="far fa-star"></i></a>
          <a href="cart.php"><i class="fas fa-shopping-cart"></i></a>
        </div>
      </ul>
    </div>
    </div>
  </nav> 

    <div class="content text-center">
      <div class="cover-image">
        <img src="static\img\recycle.png" class="recycle-image">
      </div>
      <form action="recycle.php" method="post" enctype="multipart/form-data" >
        <div class="form-container">
          <div class="column-left">
            <div class="column-left-upper">
              <div class="weight-input">
                <label for="weight-input">1. Weight of Unused Clothes Recycled (kg)* :</label>
                <input type="text" id="weight-input" name="weight-input" placeholder=" Enter weight" required>
              </div>
              <div class="bin-input">
                <label for="location-input">2. Kloth Cares Bin Location* :</label>
                <select id="location-input" name="location-input" placeholder="Enter location" required>
                  <option value = "shell_bk5">SHELL Bandar Kinrara 5</option>
                  <option value = "shell_kuchailama">SHELL Jalan Kuchai Lama</option>
                  <option value = "shell_pandanmewah">SHELL Pandan Mewah</option>
                </select>
              </div>
            </div>
            <div class="column-left-lower">
              <div class="date-input">
                <label for="date-input">3. Date* :</label>
                <input type="date" id="date-input" name="date-input" required>
              </div>
              <div class="time-input">
                <label for="time-input">4. Time* :</label>
                <input type="time" id="time-input" name="time-input" required>
              </div>
            </div>
          </div>
          <div class="column-right">
            <div class="column-right-upper">
              <div class="photo-input">
                <label for="photo-input">5. Add Proof Photo* :</label>
                <input type="file" id="photo-input" name="photo-input[]" multiple required>
              </div>
            </div>
            <div class="column-right-lower">
              <input type="submit" value="Submit" onclick="return validateForm()">
            </div>
          </div>
        </div>
      </form>
    </div>
    <script src="static/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript">
    // fetch('base.html')
    //   .then(response => response.text())
    //   .then(html => {
    //     document.getElementById('navbar').innerHTML = html;
    //   });
      function toggleSubmenu(){
      const submenuWrapper = document.querySelector('.submenu-wrapper');
      submenuWrapper.classList.toggle('show');
    }
    const h3Elements = document.querySelectorAll('.submenulists h3');
    h3Elements.forEach((h3) => {
      h3.addEventListener('mouseenter', () => {
        // Remove active-h3 class from all h3 elements
        h3Elements.forEach((h3) => h3.classList.remove('active-h3'));

        // Add active-h3 class to the hovered h3 element
        h3.classList.add('active-h3');
      });
    });
    function toggleUser(){
      const tooltip = document.querySelector('.user-tooltip');
      tooltip.classList.toggle('show');
    }
    //time@recycle.html
    const currentDate = new Date();
    currentDate.setDate(currentDate.getDate());
    const formattedDate = currentDate.toISOString().split('T')[0];
    document.getElementById('date-input').setAttribute('max', formattedDate);
    function validateForm() {
      var weightInput = document.getElementById('weight-input');
      var dateInput = document.getElementById('date-input');
      var timeInput = document.getElementById('time-input');
      var photoInput = document.getElementById('photo-input');
      var weightValue = weightInput.value.trim();
      var dateValue = dateInput.value.trim();
      var timeValue = timeInput.value.trim();

      if (weightValue === '') {
        alert('Please insert weight');
        return false;
      }

      if (dateValue === '') {
        alert('Please select a date');
        return false;
      }
      if (timeValue === '') {
        alert('Please select a time');
        return false;
      }

      if (photoInput.files.length === 0) {
        alert('Please upload at least one proof photo');
        return false;
      }

      return true;
    }
  </script>
  </body>
</html>