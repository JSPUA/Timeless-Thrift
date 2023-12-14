<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] === "GET") {
  // Reset $_SESSION["points"] to zero
  $_SESSION["points"] = 0;
}
// Establish database connection
/*$servername = "localhost";
$username = "user";
$password = "admin";
$dbname = "tt";*/
$servername = "0.tcp.ap.ngrok.io:17968";
$username = "root";
$password = "";
$dbname = "timelessthrift";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
if (!isset($_GET["product_id"])) {
  // If no product ID is provided in the URL, fetch the first product
  $startProductId = 1; // Specify the product_id to start from
  $sql = "SELECT * FROM rating WHERE product_id >= $startProductId ORDER BY product_id LIMIT 1";
} else {
  $currentProductId = $_GET["product_id"];
  // Fetch the next product based on the current product ID
  $sql = "SELECT * FROM rating WHERE product_id > $currentProductId ORDER BY product_id LIMIT 1";
}
// Retrieve product data from the database
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  $product = $result->fetch_assoc();
  if (!isset($_SESSION["points"])) {
    $_SESSION["points"] = 0;
  }

  // Handle form submission to update the database
  if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $imageQuality = $_POST["star"];
    $descriptionQuality = $_POST["star2"];
    $reason = $_POST["reason"];


    // Update the product data in the database
    $updateSql = "UPDATE rating SET image_quality = $imageQuality, description_quality = $descriptionQuality, reason = '$reason' WHERE product_id = " . $product["product_id"] - 1;
    if ($conn->query($updateSql) === TRUE) {
      // Data updated successfully
      echo "Product data updated successfully!";
      $_SESSION["points"] += 5;
    } else {
      echo "Error updating product data: " . $conn->error;
    }
  }
  $points = $_SESSION["points"];
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
  <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    .horizontal-line {
      display: flex;
      text-align: center;
      margin-top: 20px;
      margin-bottom: 10px;
      margin-right: 15px;
      margin-left: 600px;
      /* border: 1px solid rgb(222, 247, 0);*/
    }

    .radio {
      display: flex;
    }

    .ratingPart {


      margin-left: 50px;
      margin-top: 30px;
      /*border: 1px solid rgb(148, 7, 7);*/
    }

    input[type="radio"] {
      width: 25px;
      /* Adjust the width as desired */
      height: 25px;
      /* Adjust the height as desired */

    }

    .radio-option {
      margin-right: 50px;
      /* Adjust the margin as desired */
    }

    .pd {
      margin-right: 15px;
      margin-left: 25px;
      margin-top: 350px;
      width: 300px;
      /*border: 1px solid rgb(11, 214, 21);*/
    }

    .bg {
      display: flex;
      background-color: #e9e9e9;
      margin-top: 20px;
      margin-bottom: 10px;
      margin-right: 100px;
      margin-left: 100px;
      border-radius: 20px;
      /*border: 1px solid rgb(48, 11, 214);*/
    }

    .column {
      display: inline-block;
      width: 700px;
      /* Adjust the width as desired */
      vertical-align: top;
      /* Align columns from the top */
      /*border: 1px solid black;*/
    }

    .big {
      margin-top: 20px;
      margin-bottom: 10px;
      margin-right: 100px;
      margin-left: 100px;
    }

    .small {
      margin-top: 20px;
      margin-bottom: 10px;
      margin-right: 100px;
      margin-left: 430px;
    }

    .button-container {
      display: flex;
      justify-content: space-around;
      margin-top: 20px;

    }

    .button-container button {
      width: 100px;
    }

    .hide {
      display: none;
    }

    .clear {
      float: none;
      clear: both;
    }

    .rating {
      width: 600px;
      unicode-bidi: bidi-override;
      direction: rtl;
      text-align: left;
      position: relative;

    }

    .rating>label {

      display: inline;
      padding: 0;
      margin: 0;
      position: relative;
      width: 1.1em;
      cursor: pointer;
      color: #000;
      font-size: 50px;
    }

    .rating>label:hover,
    .rating>label:hover~label,
    .rating>input.radio-btn:checked~label {
      color: transparent;
    }

    .rating>label:hover:before,
    .rating>label:hover~label:before,
    .rating>input.radio-btn:checked~label:before,
    .rating>input.radio-btn:checked~label:before {
      content: "\2605";
      position: absolute;
      left: 0;
      color: #DFA2A2;
    }
  </style>
</head>
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
              <li><a href="#">Blazers</a></li>
              <li><a href="#">Jackets</a></li>
              <li><a href="#">Dresses</a></li>
              <li><a href="#">Shirts</a></li>
              <li><a href="#">T-shirts</a></li>
              <li><a href="#">Tops</a></li>
              <li><a href="#">Trousers</a></li>
              <li><a href="#">Jeans</a></li>
              <li><a href="#">Skirts</a></li>
              <li><a href="#">Shorts</a></li>
            </ul>
            <ul class="submenulists">
              <h3>Men</h3>
              <li><a href="#">New</a></li>
              <li><a href="#">Best Sellers</a></li>
              <li><a href="#">Blazers</a></li>
              <li><a href="#">Jackets</a></li>
              <li><a href="#">Hoodies</a></li>
              <li><a href="#">Shirts</a></li>
              <li><a href="#">T-shirts</a></li>
              <li><a href="#">Tops</a></li>
              <li><a href="#">Trousers</a></li>
              <li><a href="#">Jeans</a></li>
              <li><a href="#">Polo Shirts</a></li>
              <li><a href="#">Shorts</a></li>
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
              <li><a href="recycle.html">Recycle clothes with us</a></li>
            </div>
          </ul>
        </div>
      </div>
      <a href="#"><img src="static/img/TimelessThrift.png" class="logo"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarResponsive">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a href="#" class="nav-link">Contact</a>
          </li>
          <div class="navbar-icons">
            <a href="#"><i class="far fa-user"></i></a>
            <a href="#"><i class="far fa-heart"></i></a>
            <a href="#"><i class="far fa-star"></i></a>
            <a href="#"><i class="fas fa-shopping-cart"></i></a>
          </div>
        </ul>
      </div>
    </div>
  </nav>
  <div class="horizontal-line">

    <i class="fas fa-solid fa-star" style="font-size:30px"></i>
    <h2 style="font-family: 'Poppins'; font-size:21px; ">Vote for Points!</h2>
    <i class="fas fa-solid fa-star" style="font-size:30px"></i>
    <button style="border-radius: 12px; width: 20%; margin-left: 280px;" id="myButton">End</button>
  </div>

  <div class="bg">
    <div class="column">
      <div class="picture">
        <div class="small">


          <a href="#"><img src="<?php echo $product['Image1']; ?>" id="image1" onclick="changeImage('image1', 'image2')" style="position: absolute;

        width: 74px;
        height: 74px;
        border: #000000;
        border-width: 1px;
        object-fit: cover;"></a>
        </div>
        <div class="big">
          <a href="#"><img src="<?php echo $product['Image2']; ?>" id="image2" onclick="changeImage('image2', 'image1')" style="position: absolute;

        width: 300px;
        height: 300px;
        object-fit: cover;"></a>
        </div>
      </div>

      <div class="pd">
        <h3 style="font-family: 'Poppins'; ">Product description</h3>
        <textarea id="pd" name="pd" rows="4" cols="50" style="border-radius: 10px; background-color: #f9f9f9;
          font-size: 16px;
          resize: none; font-family: 'Poppins'; "><?php echo $product['product_description']; ?></textarea>
      </div>
    </div>
    <div class="column">
      <div class="ratingPart">
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"] . "?product_id=" . $product["product_id"]; ?>">

          <h2 style="font-family: 'Poppins'; font-size:30px;">Is the image quality good?</h2>

          <div class="rating">
            <input id="star5" name="star" type="radio" value="5" class="radio-btn hide" />
            <label for="star5">☆</label>
            <input id="star4" name="star" type="radio" value="4" class="radio-btn hide" />
            <label for="star4">☆</label>
            <input id="star3" name="star" type="radio" value="3" class="radio-btn hide" />
            <label for="star3">☆</label>
            <input id="star2" name="star" type="radio" value="2" class="radio-btn hide" />
            <label for="star2">☆</label>
            <input id="star1" name="star" type="radio" value="1" class="radio-btn hide" />
            <label for="star1">☆</label>
            <div class="clear"></div>
          </div>
          <br>
          <!-- <input type="number"  style="border-radius: 5px; "name="imageQuality" id="imageQuality" min="1" max="5" required><br><br>-->
          <h2 style="font-family: 'Poppins'; font-size:30px;">Is the product description good?</h2>

          <div class="rating">
            <input id="star6" name="star2" type="radio" value="5" class="radio-btn hide" />
            <label for="star6">☆</label>
            <input id="star7" name="star2" type="radio" value="4" class="radio-btn hide" />
            <label for="star7">☆</label>
            <input id="star8" name="star2" type="radio" value="3" class="radio-btn hide" />
            <label for="star8">☆</label>
            <input id="star9" name="star2" type="radio" value="2" class="radio-btn hide" />
            <label for="star9">☆</label>
            <input id="star10" name="star2" type="radio" value="1" class="radio-btn hide" />
            <label for="star10">☆</label>
            <div class="clear"></div>
          </div>
          <br>
          <!-- <input type="number"  style="border-radius: 5px; "name="descriptionQuality" id="descriptionQuality" min="1" max="5" required><br><br>-->
          <div class="radio">
            <h2 style="font-family: 'Poppins'; ">Tell us why? </h2>


          </div>

          <textarea id="reason" name="reason" rows="4" cols="50" placeholder="Enter your reason" style="border-radius: 10px; font-family: 'Poppins'"></textarea>


          <div class="button-container">

            <button type="submit" style="border-radius: 12px; width: 20%; " id="next">Next</button>

          </div>
        </form>


      </div>

    </div>
  </div>


  <div>

    <script src="static/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript">
      document.getElementById("myButton").addEventListener("click", function() {
        // Stop the rating process and show the points obtained
        Swal.fire({
          icon: 'success',
          title: 'Points',
          text: 'Points: <?php echo $points; ?>',
          confirmButtonText: 'OK'
        }).then((result) => {
          if (result.isConfirmed) {
            // Redirect to another page
            window.location.href = "chat.html";
          }
        });
        // Optionally, you can redirect the user to a different page or perform other actions here
      });
      h3Elements.forEach((h3) => {
        h3.addEventListener('mouseenter', () => {
          // Remove active-h3 class from all h3 elements
          h3Elements.forEach((h3) => h3.classList.remove('active-h3'));

          // Add active-h3 class to the hovered h3 element
          h3.classList.add('active-h3');
        });
      });

      function changeImage(imageId, otherImageId) {
        var image = document.getElementById(imageId);
        var otherImage = document.getElementById(otherImageId);
        var temp = image.src;
        image.src = otherImage.src;
        otherImage.src = temp;
      }
    </script>
</body>

</html>
<?php
// Close the database connection
$conn->close();
?>