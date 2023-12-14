<?php
require_once "config.php";
session_start();
if (empty($_SESSION['user_id'])) {
  header("Location: LoginPage.php");
}
$username = "";
if (!empty($_SESSION['user_id'])) {
    $username = $_SESSION['username'];
}

$productid = "";
$sellerid = $_SESSION['user_id'];
$name = "";
$clothingType = "";
$price = "";
$description = "";
$datetimeAdded = date("Y-m-d H:i:s");
$insertFlag = true;
$message = null;
$gender = "";
//print_r( $_POST);
if (!empty($_POST)) {
  $insertFlag = true;
  foreach ($_POST as $x => $val) {
    if (empty($val)) {
      $insertFlag = false;
      $message = "Something went wrong. Please try again.";
    }
  }
  if ($insertFlag) {
    // $sellerid = $_SESSION['userid'];
    $name = $_POST['cloth-name'];
    $clothingType = $_POST['type'];
    $gender = $_POST['gender'];
    $price = $_POST['price'];
    // Handle the file upload
    $imagePaths = [];
    $productid = uniqid();
    $imagesmain = $_FILES['imagemain'];
    $images = $_FILES['images'];
    $count = count($images['name']);
    foreach ($images as $key=>$value){
      if(empty($value)){
        $count = 0;
        break;
      };

    }
    $count += 1;
    echo $count;
    for ($i = 0; $i < $count; $i++) {
      if ($i === 0) {
        $extension = pathinfo($imagesmain['name'], PATHINFO_EXTENSION);
        $imagePath = 'uploads/' . "$productid" . "-" . $i . "." . $extension;
        move_uploaded_file($imagesmain['tmp_name'], $imagePath);
        $imagePaths[] = $imagePath;
      } else {
        $extension = pathinfo($images['name'][$i - 1], PATHINFO_EXTENSION);
        $imagePath = 'uploads/' . "$productid" . "-" . $i . "abc." . $extension;
        move_uploaded_file($images['tmp_name'][$i - 1], $imagePath);
        $imagePaths[] = $imagePath;
      }
    }
    $description = $_POST['description'];
    $length = $_POST['length'];
    $hem = $_POST['hem'];
    $strapLength = $_POST['strap-length'];
    $bodice = $_POST['bodice'];
    $bustPoint = $_POST['bust-point'];
    $armhole = $_POST['armhole'];
    $skirt = $_POST['skirt'];
    $waist = $_POST['waist'];
    $neckline = $_POST['neckline'];
    createClothing($imagePaths);
    //header("Location: ./productPage.php?type=" . $clothingType . "&gender=" . $gender);
  }
}
function createClothing($image) {
  global $pdo, $productid, $sellerid, $name, $clothingType, $price, $description, $datetimeAdded, $gender;
  global $length, $hem, $strapLength, $bodice, $bustPoint, $armhole, $skirt, $waist, $neckline;
  $query = "insert into clothes(id,seller_id,name,clothing_gender,clothing_type,price,description,datetime_added) VALUES (:id,:sellerid,:name,:clothinggender,:clothingtype,:price,:description,:datetime_added)";
  $pdo->beginTransaction();
  $stmt = $pdo->prepare($query);
  $stmt->bindParam(":id", $productid);
  $stmt->bindParam(":sellerid", $sellerid);
  $stmt->bindParam(":name", $name);
  $stmt->bindParam(":clothinggender", $gender);
  $stmt->bindParam(":clothingtype", $clothingType);
  $stmt->bindValue(":price", sprintf("%.2f", $price));
  $stmt->bindParam(":description", $description);
  $stmt->bindParam(":datetime_added", $datetimeAdded);
  $stmt->execute();
  $query = "insert into clothes_size values (?,?,?,?,?,?,?,?,?,?,?)";
  $s = calcSize($bustPoint);
  $stmt = $pdo->prepare($query);
  $stmt->bindParam(1, $productid);
  $stmt->bindValue(2, $s);
  $stmt->bindParam(3, $length);
  $stmt->bindParam(4, $hem);
  $stmt->bindParam(5, $strapLength);
  $stmt->bindParam(6, $bodice);
  $stmt->bindParam(7, $bustPoint);
  $stmt->bindParam(8, $armhole);
  $stmt->bindParam(9, $skirt);
  $stmt->bindParam(10, $waist);
  $stmt->bindParam(11, $neckline);
  $stmt->execute();
  for ($i = 0; $i < count($image); $i++) {
    if ($i == 0) {
      insertClothImage($productid, $image[$i], "true");
    } else {
      insertClothImage($productid, $image[$i], "false");
    }
  }
  $pdo->commit();
}
function insertClothImage($id, $path, $main) {
  global $pdo;
  $query = "insert into clothes_images(clothes_id,imagepath,ismain) values (?,?,?)";
  $stmt = $pdo->prepare($query);
  $stmt->bindParam(1, $id);
  $stmt->bindValue(2, $path);
  $stmt->bindParam(3, $main);
  $stmt->execute();
}
function calcSize($a) {
  if ($a >= 82 && $a <= 89.5) {
    return "xs";
  } else if ($a >= 89.5 && $a <= 90.5) {
    return "s";
  } else if ($a >= 90.5 && $a <= 94.5) {
    return "m";
  } else if ($a >= 94.5 && $a <= 102) {
    return "l";
  } else if ($a >= 102 && $a <= 111) {
    return "xl";
  } else {
    return "m";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>List Product</title>
  <link rel="stylesheet" href="static\css\bootstrap.min.css" />
  <link rel="stylesheet" href="static\css\style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="static/css/addProduct.css">
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
  <div>
    <h1>Time to list a product!</h1>
  </div>
  <div style="color:red;font-size:2rem;"><?php echo $message ?></div>
  <form action="addProduct.php" method="POST" enctype="multipart/form-data">
    <div class="container">
      <div class="column-left">
        <label for="type" class="heading2">1. CHOOSE CLOTHING TYPE</label>
        <div class="select-container">
          <select required name="gender" id="type">
            <option value="women">Women</option>
            <option value="men">Men</option>
            <option value="kids">Kids</option>
          </select>
          <select required name="type" id="type">
            <option value="dress">Dress</option>
            <option value="outerwear">Outerwear</option>
            <option value="tops">Tops</option>
            <option value="bottoms">Bottoms</option>
            <option value="blazers">Blazers</option>
          </select>
        </div>
        <label class="heading2">2. ENTER SIZING INFORMATION</label>
        <div class="size-container">
          <div><label for="length">Length (cm)</label>
            <input required type="number" step=".01" name="length">
          </div>
          <div><label for="hem">Hem (cm)</label>
            <input required type="number" step=".01" name="hem">
          </div>
          <div><label for="strap-length">Strap Length (cm)</label>
            <input required type="number" step=".01" name="strap-length">
          </div>
          <div><label for="bodice">Bodice (cm)</label>
            <input required type="number" name="bodice">
          </div>
          <div><label for="bust-point">Bust Point (cm)</label>
            <input required type="number" step=".01" name="bust-point">
          </div>
          <div><label for="armhole">Armhole (cm)</label>
            <input required type="number" step=".01" name="armhole">
          </div>
          <div><label for="skirt">Skirt (cm)</label>
            <input required type="number" step=".01" name="skirt">
          </div>
          <div><label for="waist">Waist (cm)</label>
            <input required type="number" step=".01" name="waist">
          </div>
          <div><label for="neckline">Neckline (cm)</label>
            <input required type="number" step=".01" name="neckline">
          </div>
        </div>
        <div class="heading2">3. PRICE YOUR PRODUCT</div>
        <div class="price-container">
          <label for="price">RM</label>
          <input required type="number" step=".01" placeholder="00.00" name="price">
        </div>
        <div>
          <div class="heading2">4. CREATE PRODUCT DESCRIPTION</div>
          <div class="px-4"><textarea required class="px-4" id="" name="description" rows="5" style="width:100%;background-color: #FFE7E1;border-radius: 10px;" placeholder="Description"></textarea>
          </div>
        </div>
      </div>
      <div class="column-mid">
        <div>
          <div class="pictureBox">
            <div class="heading2">5. ADD CLEAR PICTURES</div>
            <div>
              <div class="images" id="images_main">
              </div>
              <label style="width:100%;display:block">Main Picture</label>
              <div class="images" id="images">
              </div>
              <div>
                <button class="btn-1" onclick="document.getElementById('imagemain').click()" type="button">Upload Main Picture</button>
                <button class="btn-1" onclick="document.getElementById('image_input').click()" type="button">Upload Other Pictures</button>
                <button class="btn-1" onclick="resetImages()" type="button">Reset</button>
              </div>
            </div>
          </div>
        </div>
        <div><label class="heading2" for="cloth-name">6. GIVE IT A NAME! </label><input id="name-input" required style="font-family:'Inter',sans-serif; text-align: center;" type="text" placeholder="Name your clothing!" name="cloth-name">
        </div>
        <input class="btn-1" type="submit">
      </div>
      <input style="display: none;" type="file" name="imagemain" id="imagemain" accept="image/png, image/jpeg">
      <input style="display: none;" type="file" name="images[]" id="image_input" accept="image/png, image/jpeg" multiple>
  </form>
</body>
<script src="static/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
  function toggleSubmenu() {
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

  function toggleUser() {
    const tooltip = document.querySelector('.user-tooltip');
    tooltip.classList.toggle('show');
  }
</script>
<script src="static/js/addProduct.js"></script>

</html>