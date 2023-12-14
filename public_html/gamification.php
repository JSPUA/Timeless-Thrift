<?php
require_once "gamificationDb.php";

 session_start();
  $username ="";
  if(!empty($_SESSION['user_id'])){
      $username = $_SESSION['username'];
  }

  if(empty($_SESSION['user_id'])){
    header("Location: LoginPage.php");
  }
// $query = "";
// $stmt = $pdo -> prepare($query);
$progresswidth = "35%";

$reward_id = "";
$reward_name = "";
$reward_cost = "";
$reward_type = "";
$reward_value = "";

$time_created = "";

$loyalty_id = "";
$user_id = "";
$loyalty_points = "";
$loyalty_level = "";

function LoyaltyLevel($loyalty_points) {
  // Determine user level based on loyalty points
  if ($loyalty_points >= 3000) {
    return "Gold";
  } elseif ($loyalty_points >= 1500) {
    return "Silver";
  } else {
    return "Bronze";
  }
}

function pointsReward($user_id) {
  // Update loyalty points for the user
  $reward_points = 100;

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
    // Update loyalty points for the user
    $query = "UPDATE loyalty_profile SET loyalty_points = loyalty_points + $reward_points WHERE user_id = $user_id";
    $stmt = $pdo->prepare($query);
  
    header("Location: star2.php");
    exit();
}

function obtainCoupon($reward_type) {
  $coupon_code = ""; // Variable to store the obtained coupon code

  if ($reward_type == "Discount") {
    $coupon_code = "DISCOUNT10";
  } elseif ($reward_type == "Free Shipping") {
    $coupon_code = "FREESHIP";
  } elseif ($reward_type == "Bonus Gift") {
    $coupon_code = "BONUSGIFT";
  } else {
    echo "Invalid reward type";
    return;
  }

  // Redirect the user to the payment page or any desired page
  header("Location: payment_page.php?coupon=$reward_type");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Timeless Thrift</title>
    <link rel="stylesheet" href="./static/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./static/css/style.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    />
    <style>
    /* POINTSSS */
    .points-header {
      /* display: flex;
  justify-content: center;
  align-items: center; */
      text-align: center;
      vertical-align: baseline;
      /* margin: 1%; */
      padding: 2%;
      /* border: #121212 1px solid; */
    }

    .points-header>h2 {
      display: flex;
      flex-direction: row;
    }

    .points-collect {
      margin-left: 10%;
      margin-top: 2%;

      display: flex;
      flex-wrap: wrap;
      flex-direction: row;


      /* max-width: 50%; */
      /* max-height: 50%; */
      /* min-height: 100%; */

      /* border: #121212 1px solid; */
    }

    .points-collect>div {
      display: flex;
      flex-basis: calc(50% - 40px);
      justify-content: center;
      align-items: center;
      flex-direction: column;
      /* border: #e60f0f 1px solid; */
      background-color: #FFE7E1;
      border-radius: 5%;

      max-width: 50%;
      /* min-height: 80%; */
    }

    .points-collect>div>div {
      display: flex;
      justify-content: center;
      flex-direction: row;
    }

    .box {
      margin: 20px;
    }

    /* Progress Bar */
    .progress-bar {
      border: #000000 2px solid;
      margin-left: 29.5%;
      width: 40%;
      height: 20px;
      background-color: #f2f2f2;
      border-radius: 10px;
      margin-top: 10px;
      overflow: hidden;
    }

    .progress {
      height: 100%;
      background-color: #dfa2a2;
      width: 70%;
      /* Adjust this value to set the progress percentage */
      transition: width 0.3s ease-in-out;
    }

    h4,
    h3 {
      margin-top: 10px;
    }

    /* Rewardsss */
    .rewards {
      /* border: #121212 1px solid; */
      margin-left: 1%;
      margin-top: 2%;
      /* margin-right: 5%; */
      row-gap: 15px;
      display: flex;
      flex-direction: column;


      /* max-width: 50%;
  max-height: 50%; */
      /* min-height: 100%; */

    }

    .rewards>h3 {
      margin-bottom: none;
    }

    .rewards-list-1,
    .rewards-list-2 {
      /* flex-basis: calc(50% - 5px); */
      display: flex;
      min-width: 70%;
      margin: 1%;
      padding: auto;
      align-items: center;
      flex-direction: row;
      /* padding-bottom: 5px; */
      /* border: #5f14e8 1px solid; */

      /* margin-left: 7%; */
    }

    .discount {
      /* flex: 1; */
      border: 1px solid rgb(10, 10, 10);
      background-color: #FFFFFF;
      border-radius: 5%;
      margin: 15px;
      text-align: center;
      padding: 10px;
    }

    /* .discount:first-child {
  margin-right: 50px;
} */

    .seperate {
      display: flex;
      /* border: 2px solid rgb(190, 26, 127); */
      margin: none;
      padding-right: 10%;
      justify-content: auto;

    }

    button {
      width: 70px;
    }
  </style>
  </head>

  <body>
    <!-- <div id="navbar"></div> -->

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

    <!-- Content Here! -->
    <div class="points-header">
      <h1>Here Are Your Thrift Points!</h1>
      <h3>You currently have 2,465 points</h3>

      <div class="progress-bar">
        <div class="progress" style="<?php
        echo "width : " . $progresswidth;
        ?>"></div>
      </div>

      <h4>Current level : Silver</h4>
      <h3>534 points left to reach <b>Gold Level</b>!</h3>
    </div>
    

    <div class="seperate">
      <div class="points-collect">

        <h2 style="text-align: right; align-self: right; margin-left:33%; font-size: 24;">
          Collect extra points!
        </h2>

        <div class="box make-purchase">
          <img
            src="./static/img/shop-bag.png"
            style="width: 100px; height: 100px; margin: 2.5%;"
          />
          <div>Make a purchase</div>
          <h6><b>50 points</b></h6>
          <button style="background-color: rgb(248, 249, 250); margin: 2.5%; border: none;">GO!</button>
        </div>

        <div class="box product-review">
          <img
            src="./static/img/comment.png"
            style="width: 100px; height: 100px; margin: 2.5%;"
          />
          <div>Write a product review</div>
          <h6><b>10 points</b></h6>
          <button style="background-color: rgb(248, 249, 250); margin: 2.5%; border: none;">GO!</button>
        </div>

        <div class="box vote-listing">
          <img
            src="./static/img/vote.png"
            style="width: 100px; height: 100px; margin: 2.5%;"
          />
          <div>Vote product listing</div>
          <h6><b>20 points</b></h6>
          <a href="star3.php">
          <button style="background-color: rgb(248, 249, 250); margin: 2.5%; border: none;">GO!</button>
          </a>
        </div>

        <div class="box mailing-list">
          <img
            src="./static/img/recycle_icon.png"
            style="width: 100px; height: 100px; margin: 2.5%;"
          />
          <div>Recycle your old clothing</div>
          <h6><b>50 points</b></h6>
          <a href="recycle.php">
          <button style="background-color: rgb(248, 249, 250); margin: 2.5%; border: none;">GO!</button>
          </a>
        </div>
      </div>

      <div class="rewards">
        <h3 style="text-align: center">Your current rewards!</h3>
        <div class="rewards-list-1">
          <div class="discount">
            <h5>5% discount</h5>
            <h6>Obtained 5 hours ago</h6>
            <img
              src="./static/img/right-arrow.png"
              style="width: 25px; height: 25px"
              ;
            />
          </div>
          <div class="discount">
            <h5>10% discount</h5>
            <h6>Obtained 3 hours ago</h6>
            <img
              src="./static/img/right-arrow.png"
              style="width: 25px; height: 25px"
            />
          </div>
        </div>

        <h3 style="text-align: center">Next rewards!</h3>
        <div class="rewards-list-2">
          <div class="discount">
            <img
              src="./static/img/discount.png"
              style="width: 140px; height: 120px;"
            />
            <div>$5 discount</div>
            <h6><b>500 points</b></h6>
            <button style="background-color: rgb(248, 249, 250); margin: 2%; border: solid black 1px;">Gold Level</button>
          </div>
          <div class="discount">
            <img
              src="./static/img/gift-card.png"
              style="width: 140px; height: 120px;"
            />
            <div>$5 gift card</div>
            <h6><b>500 points</b></h6>
            <button style="background-color: rgb(248, 249, 250); margin: 2%; border: solid black 1px;">Gold Level</button>
          </div>
        </div>
      </div>
    </div>
    <!-- End of content! -->

    <script src="static/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
      function toggleSubmenu() {
        const submenuWrapper = document.querySelector(".submenu-wrapper");
        submenuWrapper.classList.toggle("show");
      }
      const h3Elements = document.querySelectorAll(".submenulists h3");

      h3Elements.forEach((h3) => {
        h3.addEventListener("mouseenter", () => {
          // Remove active-h3 class from all h3 elements
          h3Elements.forEach((h3) => h3.classList.remove("active-h3"));

          // Add active-h3 class to the hovered h3 element
          h3.classList.add("active-h3");
        });
      });
    </script>
  </body>
</html>
