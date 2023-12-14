<?php
session_start();
$username = "";
if (!empty($_SESSION['user_id'])) {
    $username = $_SESSION['username'];
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Timeless Thrift</title>
  <link rel="stylesheet" href="static\css\bootstrap.min.css" />
  <link rel="stylesheet" href="static\css\style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<title>Timeless thrift</title>
<style>
  .container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
  }

  .item {
    width: 600px;
    margin-bottom: 20px;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    background-color: #FFFFFF;
    display: flex;
  }

  .item img {
    width: 150px;
    height: 150px;
    margin-right: 20px;
    border-radius: 5px;
  }

  .item-details {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }

  .item-name {
    font-weight: bold;
    font-size: 18px;
    margin-bottom: 5px;
  }

  .item-size {
    font-size: 14px;
    margin-bottom: 5px;
  }

  .item-price {
    font-size: 16px;
    margin-bottom: 5px;
  }

  .item-desc {
    font-size: 14px;
    color: #777;
    margin-bottom: 10px;
  }

  .buttons-container {
    display: flex;
    align-items: center;
  }

  .remove-button,
  .edit-button,
  .checkout-button,
  .back-button {
    padding: 10px;
    margin-left: 10px;
    background-color: #FF527B;
    color: black;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  .checkout-container {
    display: flex;
    justify-content: center;
    margin-top: 20px;
  }

  .back-button {
    margin-right: 10px;
  }

  .flash-message {
    position: fixed;
    top: 20px;
    left: 50%;
    transform: translateX(-50%);
    width: 400px;
    padding: 10px;
    border-radius: 5px;
    background-color: #FF527B;
    color: black;
    text-align: center;
    font-family: Arial, sans-serif;
    font-size: 16px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
    opacity: 0;
    transition: opacity 0.2s ease-in-out;
  }

  .flash-message.show {
    opacity: 1;
  }

  .total-price {
    position: fixed;
    bottom: 20px;
    right: 20px;
    padding: 10px;
    border-radius: 5px;
    background-color: #FF527B;
    color: black;
    text-align: right;
    font-family: Arial, sans-serif;
    font-size: 16px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
  }
</style>
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
  <div style="height: 20px;"></div>
  <div class="container">
    <?php
    // Connect to the database
    $servername = "0.tcp.ap.ngrok.io:17968";
    $username = "root";
    $password = "";
    $dbname = "timelessthrift";
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check the database connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    // Check if a remove request was made
    if (isset($_POST['remove_id'])) {
      $removeId = $_POST['remove_id'];
      // Remove the item from the database
      $removeSql = "DELETE FROM cart_items WHERE id = $removeId";
      if ($conn->query($removeSql) === TRUE) {
        echo '<div class="flash-message show">Item removed successfully!</div>';
      } else {
        echo '<div class="flash-message show">Error removing item: ' . $conn->error . '</div>';
      }
    }
    // Retrieve cart items from the database
    $sql = "SELECT b.id,c.name,a.size,c.price,c.description,i.imagePath FROM clothes as c JOIN cart_items as b on b.clothes_id=c.id JOIN clothes_images as i on i.clothes_id=b.clothes_id JOIN clothes_size as a on a.clothes_id = c.id WHERE b.seller_id = ? AND i.isMain = 'true'";
    $stmt = $conn->prepare($sql);
    $stmt -> bind_param('s',$_SESSION['user_id']);
    $stmt -> execute();
    $result = $stmt->get_result();
    $totalPrice = 0; // Initialize total price
    // Display cart items
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $itemId = $row["id"];
        $image = $row["imagePath"]; // Image path updated
        $name = $row["name"];
        $size = $row["size"];
        $price = $row["price"];
        $description = $row["description"];
        // Add item price to the total
        $totalPrice += $price;
        // Output HTML for each cart item
        echo '<div class="item">
                <img src="' . $image . '" alt="' . $name . '">
                <div class="item-details">
                  <div>
                    <div class="item-name">' . $name . '</div>
                    <div class="item-size">Size: ' . $size . '</div>
                    <div class="item-price">' . $price . '</div>
                    <div class="item-desc">' . $description . '</div>
                  </div>
                  <div class="buttons-container">
                    <form method="POST" action="">
                      <input type="hidden" name="remove_id" value="' . $itemId . '">
                      <button type="submit" class="remove-button">Remove</button>
                    </form>
                  </div>
                </div>
              </div>';
      }
    } else {
      echo '<div class="flash-message show">No items in the cart.</div>';
    }
    $conn->close();
    ?>
  </div>
  <div class="checkout-container">
    <button class="back-button" style="background-color: #DFA2A2;" onclick="window.location.href='index.php';">Back</button>
    <button class="checkout-button" style="background-color: #DFA2A2;" onclick="window.location.href='payment_gtw.php';">Checkout</button>
  </div>
  <div class="total-price">
    Total: RM <?php echo $totalPrice; ?>
  </div>
  <script>
    setTimeout(function() {
      var flashMessage = document.querySelector('.flash-message');
      if (flashMessage) {
        flashMessage.classList.remove('show');
      }
    }, 1500);
  </script>

  <div style="height: 20px;"></div>

</body>

</html>