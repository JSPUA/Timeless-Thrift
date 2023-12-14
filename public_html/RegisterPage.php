<?php
require_once "session.php";
$username ="";
if(!empty($_SESSION['user_id'])){
$username = $_SESSION['username'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timeless Thrift</title>
    <link rel="stylesheet" href="static\css\bootstrap.min.css"/>
  <link rel="stylesheet" href="static\css\registerStyle.css"/>
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

    <div class="register-content">
        <h2>Start your thrifting journey!</h2>
        <form action="RegisterAction.php" method="post" class='button'>
        <div class="form-row">
            <label for="username"><strong>1. USERNAME* :</strong></label>
            <input type="text" id="username" name="username">
            <label for="age"><strong>AGE* :</strong></label>
            <input type="text" id="age" name="age">
        </div>

        <div class="row-label"><label><strong>2. ENTER SIZING INFORMATION* :</strong></label></div>

        <div class="form-row2">
            <label for="len"></label>
            <input type="text" id="len" name="len" placeholder="Length (cm)">
            <span id="len-error" class="error-message"></span>

            <label for="hem"></label>
            <input type="text" id="hem" name="hem" placeholder="Hem (cm)">
            <span id="hem-error" class="error-message"></span>

            <label for="strap"></label>
            <input type="text" id="strap" name="strap" placeholder="Strap (cm)">
            <span id="strap-error" class="error-message"></span>
        </div>

        <div class="form-row3">
            <label for="bodice"></label>
            <input type="text" id="bodice" name="bodice" placeholder="Bodice (cm)">
            <span id="bodice-error" class="error-message"></span>

            <label for="bust"></label>
            <input type="text" id="bust" name="bust" placeholder="Bust point (cm)">
            <span id="bust-error" class="error-message"></span>

            <label for="armhole"></label>
            <input type="text" id="armhole" name="armhole" placeholder="Armhole (cm)">
            <span id="armhole-error" class="error-message"></span>
        </div>

        <div class="form-row4">
            <label for="skirt"></label>
            <input type="text" id="skirt" name="skirt" placeholder="Skirt (cm)">
            <span id="skirt-error" class="error-message"></span>

            <label for="waist"></label>
            <input type="text" id="waist" name="waist" placeholder="Waist (cm)">
            <span id="waist-error" class="error-message"></span>

            <label for="neckline"></label>
            <input type="text" id="neckline" name="neckline" placeholder="Neckline (cm)">
            <span id="neckline-error" class="error-message"></span>
        </div>

        <div class="form-row5">
            <label for="email"><strong>3. EMAIL* :</strong></label>
            <input type="text" id="email" name="email">
            <span id="email-error" class="error-message"></span>

            <label for="phone"><strong>PHONE NUMBER* :</strong></label>
            <input type="text" id="phone" name="phone">
            <span id="phone-error" class="error-message"></span>
        </div>

        <div class="password">
            <label for="password"><strong>4. PASSWORD* :</strong></label>
            <input type="password" id="password" name="password" class="password-input">
            <span id="password-error" class="error-message"></span>
        </div>

        <div class="row-label2"><label><strong>5. ADDRESS* :</strong></label></div>
        <div class="form-row6">
            <label for="streetAddress1"></label>
            <input type="text" id="streetAddress1" name="streetAddress1" placeholder="Street Address 1">
            <span id="streetAddress1-error" class="error-message"></span>

            <label for="streetAddress2"></label>
            <input type="text" id="streetAddress2" name="streetAddress2" placeholder="Street Address 2">
            <span id="streetAddress2-error" class="error-message"></span>
        </div>

        <div class="form-row7">
            <label for="city"></label>
            <input type="text" id="city" name="city" placeholder="City">
            <span id="city-error" class="error-message"></span>

            <label for="postCode"></label>
            <input type="text" id="postCode" name="postCode" placeholder="Postal Code">
            <span id="postCode-error" class="error-message"></span>

            <label for="region"></label>
            <input type="text" id="region" name="region" placeholder="Region">
            <span id="region-error" class="error-message"></span>

            <label for="country"></label>
            <input type="text" id="country" name="country" placeholder="Country">
            <span id="country-error" class="error-message"></span>
        </div>
            <br>
            <br>
        <input type="submit" value="Register" class="register-button">
        </form>
    </div>
    
</body>
</html>

<script src="static/js/bootstrap.bundle.min.js"></script>
<script>
    document.querySelector("form").addEventListener("submit", function(event) {

        var hasError = false;
        var usernameInput = document.getElementById("username");

        var ageInput = document.getElementById("age");
        var lenInput = document.getElementById("len");
        var hemInput = document.getElementById("hem");
        var strapInput = document.getElementById("strap");
        var bodiceInput = document.getElementById("bodice");
        var bustInput = document.getElementById("bust");
        var armholeInput = document.getElementById("armhole");
        var skirtInput = document.getElementById("skirt");
        var waistInput = document.getElementById("waist");
        var necklineInput = document.getElementById("neckline");
        var emailInput = document.getElementById("email");
        var phoneInput = document.getElementById("phone");

        var passwordInput = document.getElementById("password");

        var streetAddress1Input = document.getElementById("streetAddress1");
        var streetAddress2Input = document.getElementById("streetAddress2");
        var cityInput = document.getElementById("city");
        var postCodeInput = document.getElementById("postCode");
        var regionInput = document.getElementById("region");
        var countryInput = document.getElementById("country");

        usernameInput.classList.remove("error");
        ageInput.classList.remove("error");
        lenInput.classList.remove("error");
        hemInput.classList.remove("error");
        strapInput.classList.remove("error");
        bodiceInput.classList.remove("error");
        bustInput.classList.remove("error");
        armholeInput.classList.remove("error");
        skirtInput.classList.remove("error");
        waistInput.classList.remove("error");
        necklineInput.classList.remove("error");
        emailInput.classList.remove("error");
        phoneInput.classList.remove("error");
        passwordInput.classList.remove("error");
        streetAddress1Input.classList.remove("error");
        streetAddress2Input.classList.remove("error");
        cityInput.classList.remove("error");
        postCodeInput.classList.remove("error");
        regionInput.classList.remove("error");
        countryInput.classList.remove("error");

        usernameInput.placeholder = "";
        ageInput.placeholder = "";
        lenInput.placeholder = "";
        hemInput.placeholder = "";
        strapInput.placeholder = "";
        bodiceInput.placeholder = "";
        bustInput.placeholder = "";
        armholeInput.placeholder = "";
        skirtInput.placeholder = "";
        waistInput.placeholder = "";
        necklineInput.placeholder = "";
        emailInput.placeholder = "";
        phoneInput.placeholder = "";
        passwordInput.placeholder = "";
        streetAddress1Input.placeholder = "";
        streetAddress2Input.placeholder = "";
        cityInput.placeholder= "";
        postCodeInput.placeholder = "";
        regionInput.placeholder = "";
        countryInput.placeholder = "";

        if (usernameInput.value === "") {
        usernameInput.placeholder = "Name is required.";
        usernameInput.classList.add("error");
        hasError = true;
        }

        if (ageInput.value === "") {
        ageInput.placeholder = "Age is required.";
        ageInput.classList.add("error");
        hasError = true;
        }

        if (lenInput.value === "") {
            lenInput.placeholder = "Length is required.";
            lenInput.classList.add("error");
            hasError = true;
        }

        if (hemInput.value === "") {
            hemInput.placeholder = "Hem is required.";
            hemInput.classList.add("error");
            hasError = true;
        }

        if (strapInput.value === "") {
            strapInput.placeholder = "Strap is required.";
            strapInput.classList.add("error");
            hasError = true;
        }

        if (bodiceInput.value === "") {
            bodiceInput.placeholder = "Bodice is required.";
            bodiceInput.classList.add("error");
            hasError = true;
        }

        if (bustInput.value === "") {
            bustInput.placeholder = "Bust point is required.";
            bustInput.classList.add("error");
            hasError = true;
        }

        if (armholeInput.value === "") {
            armholeInput.placeholder = "Armhole is required.";
            armholeInput.classList.add("error");
            hasError = true;
        }

        if (skirtInput.value === "") {
            skirtInput.placeholder = "Skirt is required.";
            skirtInput.classList.add("error");
            hasError = true;
        }

        if (waistInput.value === "") {
            waistInput.placeholder = "Waist is required.";
            waistInput.classList.add("error");
            hasError = true;
        }

        if (necklineInput.value === "") {
            necklineInput.placeholder = "Neckline is required.";
            necklineInput.classList.add("error");
            hasError = true;
        }

        if (emailInput.value === "") {
            emailInput.placeholder = "Email is required.";
            emailInput.classList.add("error");
            hasError = true;
        } else if (!isValidEmail(emailInput.value)) {
                emailInput.value = ""; // 清空输入框的值
                emailInput.placeholder = "Invalid email format.";
                emailInput.classList.add("error");
                hasError = true;
            }

        if (phoneInput.value === "") {
            phoneInput.placeholder = "Phone number is required.";
            phoneInput.classList.add("error");
            hasError = true;
        }

        if (passwordInput.value === "") {
            passwordInput.placeholder = "Password is required.";
            passwordInput.classList.add("error");
            hasError = true;
        }

        if (streetAddress1Input.value === "") {
            streetAddress1Input.placeholder = "Street Address is required.";
            streetAddress1Input.classList.add("error");
            hasError = true;
        }

        if (cityInput.value === "") {
            cityInput.placeholder = "City is required.";
            cityInput.classList.add("error");
            hasError = true;
        }

        if (postCodeInput.value === "") {
            postCodeInput.placeholder = "Postal Code is required.";
            postCodeInput.classList.add("error");
            hasError = true;
        }

        if (regionInput.value === "") {
            regionInput.placeholder = "Region is required.";
            regionInput.classList.add("error");
            hasError = true;
        }

        if (countryInput.value === "") {
            countryInput.placeholder = "Country is required.";
            countryInput.classList.add("error");
            hasError = true;
        }

        if (hasError) {
        event.preventDefault();
        }else {
            document.querySelector(".register-button").disabled = false;
        }
    });

    function isValidEmail(email) {
        var emailRegex = /^\S+@\S+\.\S+$/;
        return emailRegex.test(email);
    }


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

  </script>
</script>

