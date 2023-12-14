<?php
require_once "config.php";
session_start();
$username = "";
if (!empty($_SESSION['user_id'])) {
  $username = $_SESSION['username'];
}
$curSort = "";
$curSize = "";
if (empty($_GET['type']) || empty($_GET['gender'])) {
  header("Location: index.php");
}
if ($_GET['type'] == "dress") {
  $_GET['type'] == "Dresses";
}

$header = ucfirst($_GET['gender']) . " " . ucfirst($_GET['type']);



if(isset($_GET['size'])){
  if (isset($_GET['search']) && !isset($_GET['sort'])) {
    $query = "SELECT a.username as username, a.user_id as user_id, b.id as product_id, b.datetime_added as date_time, b.name as product_name, b.price as product_price, b.likes as product_likes, c.imagepath
      FROM user AS a
      JOIN clothes AS b ON a.user_id = b.seller_id
      JOIN clothes_images AS c ON b.id = c.clothes_id
      WHERE c.isMain = 'true' AND b.clothing_type = ? AND b.clothing_gender = ? AND b.name LIKE ? AND b.id = (SELECT clothes_id FROM clothes_size where clothes_size.size = ?)";
  $curSize = $_GET['size'];
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(1, $_GET['type']); //type
    $stmt->bindParam(2, $_GET['gender']); //gender
    $stmt->bindValue(3, "%" . $_GET['search'] . "%"); //search
    $stmt ->bindValue(4,$_GET['size']);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }else if (isset($_GET['search']) && (isset($_GET['sort']))) {
    $query = "SELECT a.username as username, a.user_id as user_id, b.id as product_id, b.datetime_added as date_time, b.name as product_name, b.price as product_price, b.likes as product_likes, c.imagepath
      FROM user AS a
      JOIN clothes AS b ON a.user_id = b.seller_id
      JOIN clothes_images AS c ON b.id = c.clothes_id
      WHERE c.isMain = 'true' AND b.clothing_type = ? AND b.clothing_gender = ? AND b.name LIKE ? AND b.id = (SELECT clothes_id FROM clothes_size where clothes_size.size = ?)";
  $curSort = $_GET['sort'];
  $curSize = $_GET['size'];
    if ($curSort == "lowhigh") {
      $query .= " ORDER BY b.price ASC";
    } else if ($curSort == "highlow") {
      $query .= " ORDER BY b.price DESC";
    } else if ($curSort == "likes") {
      $query .= " ORDER BY b.likes DESC";
    } else if ($curSort == "upload") {
      $query .= " ORDER BY b.datetime_added DESC";
    }

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(1, $_GET['type']); //type
    $stmt->bindParam(2, $_GET['gender']); //gender
    $stmt->bindValue(3, "%" . $_GET['search'] . "%"); //search
    $stmt ->bindValue(4,$_GET['size']);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  else if (isset($_GET['sort'])) {
    $curSize = $_GET['size'];
    $curSort = $_GET['sort'];
    $query = "SELECT a.username as username, a.user_id as user_id, b.id as product_id, b.datetime_added as date_time, b.name as product_name, b.price as product_price, b.likes as product_likes, c.imagepath
      FROM user AS a
      JOIN clothes AS b ON a.user_id = b.seller_id
      JOIN clothes_images AS c ON b.id = c.clothes_id
      WHERE c.isMain = 'true' AND b.clothing_type = ? AND b.clothing_gender = ? AND b.id = (SELECT clothes_id FROM clothes_size where clothes_size.size = ?)";
    if ($curSort == "lowhigh") {
      $query .= " ORDER BY b.price ASC";
    } else if ($curSort == "highlow") {
      $query .= " ORDER BY b.price DESC";
    } else if ($curSort == "likes") {
      $query .= " ORDER BY b.likes DESC";
    } else if ($curSort == "upload") {
      $query .= " ORDER BY b.datetime_added DESC";
    }
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(1, $_GET['type']); //type
    $stmt->bindParam(2, $_GET['gender']); //gender
    $stmt ->bindValue(3,$_GET['size']);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } else {
    $curSize = $_GET['size'];
    $stmt = $pdo->prepare("SELECT a.username as username, a.user_id as user_id, b.id as product_id, b.datetime_added as date_time, b.name as product_name, b.price as product_price, b.likes as product_likes, c.imagepath
  FROM user AS a
  JOIN clothes AS b ON a.user_id = b.seller_id
  JOIN clothes_images AS c ON b.id = c.clothes_id
  WHERE c.isMain = 'true' AND b.clothing_type = ? AND b.clothing_gender = ? AND b.id = (SELECT clothes_id FROM clothes_size where clothes_size.size = ?)");
    $stmt->bindParam(1, $_GET['type']); //type
    $stmt->bindParam(2, $_GET['gender']); //gender
    $stmt ->bindValue(3,$_GET['size']);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

}else{
  if (isset($_GET['search']) && !isset($_GET['sort'])) {
    $query = "SELECT a.username as username, a.user_id as user_id, b.id as product_id, b.datetime_added as date_time, b.name as product_name, b.price as product_price, b.likes as product_likes, c.imagepath
      FROM user AS a
      JOIN clothes AS b ON a.user_id = b.seller_id
      JOIN clothes_images AS c ON b.id = c.clothes_id
      WHERE c.isMain = 'true' AND b.clothing_type = ? AND b.clothing_gender = ? AND b.name LIKE ?";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(1, $_GET['type']); //type
    $stmt->bindParam(2, $_GET['gender']); //gender
    $stmt->bindValue(3, "%" . $_GET['search'] . "%"); //search
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }else if (isset($_GET['search']) && (isset($_GET['sort']))) {
    $query = "SELECT a.username as username, a.user_id as user_id, b.id as product_id, b.datetime_added as date_time, b.name as product_name, b.price as product_price, b.likes as product_likes, c.imagepath
      FROM user AS a
      JOIN clothes AS b ON a.user_id = b.seller_id
      JOIN clothes_images AS c ON b.id = c.clothes_id
      WHERE c.isMain = 'true' AND b.clothing_type = ? AND b.clothing_gender = ? AND b.name LIKE ?";
  $curSort = $_GET['sort'];
    if ($curSort == "lowhigh") {
      $query .= " ORDER BY b.price ASC";
    } else if ($curSort == "highlow") {
      $query .= " ORDER BY b.price DESC";
    } else if ($curSort == "likes") {
      $query .= " ORDER BY b.likes DESC";
    } else if ($curSort == "upload") {
      $query .= " ORDER BY b.datetime_added DESC";
    }

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(1, $_GET['type']); //type
    $stmt->bindParam(2, $_GET['gender']); //gender
    $stmt->bindValue(3, "%" . $_GET['search'] . "%"); //search
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  else if (isset($_GET['sort'])) {
    $curSort = $_GET['sort'];
    $query = "SELECT a.username as username, a.user_id as user_id, b.id as product_id, b.datetime_added as date_time, b.name as product_name, b.price as product_price, b.likes as product_likes, c.imagepath
      FROM user AS a
      JOIN clothes AS b ON a.user_id = b.seller_id
      JOIN clothes_images AS c ON b.id = c.clothes_id
      WHERE c.isMain = 'true' AND b.clothing_type = ? AND b.clothing_gender = ?";
    if ($curSort == "lowhigh") {
      $query .= " ORDER BY b.price ASC";
    } else if ($curSort == "highlow") {
      $query .= " ORDER BY b.price DESC";
    } else if ($curSort == "likes") {
      $query .= " ORDER BY b.likes DESC";
    } else if ($curSort == "upload") {
      $query .= " ORDER BY b.datetime_added DESC";
    }
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(1, $_GET['type']); //type
    $stmt->bindParam(2, $_GET['gender']); //gender
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } else {
    $stmt = $pdo->prepare("SELECT a.username as username, a.user_id as user_id, b.id as product_id, b.datetime_added as date_time, b.name as product_name, b.price as product_price, b.likes as product_likes, c.imagepath
  FROM user AS a
  JOIN clothes AS b ON a.user_id = b.seller_id
  JOIN clothes_images AS c ON b.id = c.clothes_id
  WHERE c.isMain = 'true' AND b.clothing_type = ? AND b.clothing_gender = ?");
    $stmt->bindParam(1, $_GET['type']); //type
    $stmt->bindParam(2, $_GET['gender']); //gender
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

}


function time_elapsed_string($datetime, $full = false) {
  $now = new DateTime;
  $ago = new DateTime($datetime);
  $diff = $now->diff($ago);

  $diff->w = floor($diff->d / 7);
  $diff->d -= $diff->w * 7;

  $string = array(
    'y' => 'year',
    'm' => 'month',
    'w' => 'week',
    'd' => 'day',
    'h' => 'hour',
    'i' => 'minute',
    's' => 'second',
  );
  foreach ($string as $k => &$v) {
    if ($diff->$k) {
      $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
    } else {
      unset($string[$k]);
    }
  }

  if (!$full) $string = array_slice($string, 0, 1);
  return $string ? implode(', ', $string) . ' ago' : 'just now';
}


function getClothesBySize($pdo,$size){
  $stmt = $pdo -> prepare("SELECT * FROM clothes_size where size = ?");
  $stmt -> bindValue(1,$size);
  return $stmt -> fetchAll(PDO::FETCH_OBJ);
}
// //Get All Products
// $stmt = $pdo -> prepare("SELECT a.username as username, a.user_id as user_id, b.id as product_id, b.datetime_added as date_time, b.name as product_name, b.price as product_price, b.likes as product_likes, c.imagepath
// FROM user AS a
// JOIN clothes AS b ON a.user_id = b.seller_id
// JOIN clothes_images AS c ON b.id = c.clothes_id
// WHERE c.isMain = 'true'");
// $stmt -> execute();
// $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
// //print_r($rows);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Page</title>
  <link rel="stylesheet" href="static\css\bootstrap.min.css" />
  <link rel="stylesheet" href="static\css\style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="static/css/productPage.css">
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
  <!-- Product Page Start Here -->
  <div class="option-bar">
    <div class="left">
      <label class="" for="size">Size</label>
      <select name="size" id="size">
        <option value="my-size" selected>My size</option>
        <option value="xs" <?php $curSize == "xs" ? print("selected") : ""; ?>>XS</option>
        <option value="s" <?php $curSize == "s" ? print("selected") : ""; ?>>S</option>
        <option value="m" <?php $curSize == "m" ? print("selected") : ""; ?>>M</option>
        <option value="l" <?php $curSize == "l" ? print("selected") : ""; ?>>L</option>
        <option value="xl" <?php $curSize == "xl" ? print("selected") : ""; ?>>XL</option>
      </select>
    </div>
    <div class="middle">
      <input class="search-bar" id="search" name="search" placeholder="Search for clothes" type="text">
    </div>
    <div class="right">
      <label for="sort">Sort by</label>
      <select name="sort" id="sort">
        <option value="recommendation" <?php $curSort == "recommendation" ? print("selected") : ""; ?>>Recommendation
        </option>
        <option value="lowhigh" <?php $curSort == "lowhigh" ? print("selected") : ""; ?>>Price Low to High</option>
        <option value="highlow" <?php $curSort == "highlow" ? print("selected") : ""; ?>>Price High to Low</option>
        <option value="likes" <?php $curSort == "likes" ? print("selected") : ""; ?>>Likes</option>
        <option value="upload" <?php $curSort == "upload" ? print("selected") : ""; ?>>Upload Time</option>
      </select>
    </div>
  </div>
  <!-- PHP for header -->
  <h1>
    <?php echo $header; ?>
  </h1>
  <form action="productPage.php" method="POST">
    <div class="product-container">
      <?php
      foreach ($rows as $row) {
        printProductCard($row);
      }
      function printProductCard($row) {
        print('<a href="./product.php?id=' . $row['product_id'] . '">
    <div class="product-card">
        <h2>' . $row['username'] . '</h1>
        <div class="star-grid"></div>
        <p>' . time_elapsed_string($row['date_time']) . '</p>
        <img class="product-image" src="' . $row['imagepath'] . '" alt="">
        <h2 class="full">' . $row['product_name'] . '</h1>
        <h2 class="full">RM ' . $row['product_price'] . '</h2>
        <i class="fa-solid fa-thumbs-up"></i>
        <h2>' . $row['product_likes'] . '</h2>
    </div>
</a>');
      }
      ?>
    </div>
  </form>
</body>
<script src="https://kit.fontawesome.com/575cbb52f7.js" crossorigin="anonymous"></script>
<script src="static/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
  // fetch('base.html')
  //   .then(response => response.text())
  //   .then(html => {
  //     document.getElementById('navbar').innerHTML = html;
  //   });
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
  //ProductPage Script
  var selectElement = document.getElementById('sort');
  selectElement.addEventListener('change', function() {
    var selectedValue = selectElement.value;
    // Construct the new URL with the selected parameter value
    var currentURL = window.location.href;
    var url = new URL(currentURL);
    url.searchParams.set('sort', selectedValue);
    var newURL = url.toString();
    // Redirect to the new URL
    window.location.href = newURL;
  });
  var sizeElement = document.getElementById('size');
  sizeElement.addEventListener('change', function() {
    var sizeValue = sizeElement.value;
    // Construct the new URL with the selected parameter value
    var currentURL = window.location.href;
    var url = new URL(currentURL);
    url.searchParams.set('size', sizeValue);
    var newURL = url.toString();
    // Redirect to the new URL
    window.location.href = newURL;
  });
  searchElement = document.getElementById('search');
  searchElement.addEventListener("keypress", (event) => {
    if (event.key === "Enter") {
      var searchValue = searchElement.value;

      if(searchValue == ""){
        window.location.href = location.reload();
      }
      // Construct the new URL with the selected parameter value
      var currentURL = window.location.href;
      var url = new URL(currentURL);
      url.searchParams.set('search', searchValue);
      var newURL = url.toString();
      // Redirect to the new URL
      window.location.href = newURL;
    }
  })
  //End of productPage script
</script>
<!-- Page Script Start here -->

</html>