<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Timeless Thrift - Payment</title>
    <link rel="stylesheet" href="static\css\bootstrap.min.css"/>
    <link rel="stylesheet" href="static\css\style.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
  <title>Timeless Thrift - Payment</title>
  <style>
    .container {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }
    .payment-methods {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-top: 20px;
    }
    .payment-methods-row {
      display: flex;
      justify-content: center;
      gap: 20px;
      margin-bottom: 20px;
    }
    .payment-method {
      display: flex;
      flex-direction: column;
      align-items: center;
      width: 200px;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
      background-color: #FFFFFF;
    }
    .payment-method img {
      width: 140px;
      height: 50px;
      margin-bottom: 10px;
    }
    .payment-method span {
      font-weight: bold;
      font-size: 16px;
      margin-bottom: 5px;
      text-align: center;
    }
    .checkout-container {
      display: flex;
      justify-content: center;
      margin-top: 20px;
    }
    .back-button {
      padding: 10px;
      margin-right: 10px;
      background-color: #DFA2A2;
      color: black;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      text-decoration: none;
    }
    .checkout-button {
      padding: 10px;
      background-color: #DFA2A2;
      color: black;
      border: none;
      border-radius: 5px;
      cursor: pointer;
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
    <a href="cart.html"><img src="static/img/TimelessThrift.png" class="logo"></a>
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
  </script>
<div style="height: 20px;"></div>

  <div class="container">
    <h1>Choose a Payment Method</h1>
    <div class="payment-methods">
      <div class="payment-methods-row">
        <a href="credit_card.php" class="payment-link">
          <div class="payment-method">
            <img src="payment_icons/credit_card.png" alt="Credit/Debit Card">
            <span>Credit/Debit Card</span>
          </div>
        </a>
        <a href="paypal.php" class="payment-link">
          <div class="payment-method">
            <img src="payment_icons/paypal.png" alt="PayPal">
            <span>PayPal</span>
          </div>
        </a>
        <a href="bitcoin.php" class="payment-link">
          <div class="payment-method">
            <img src="payment_icons/btc.png" alt="Bitcoin">
            <span>Bitcoin</span>
          </div>
        </a>
      </div>
      <div class="payment-methods-row">
        <a href="touch_n_go.php" class="payment-link">
          <div class="payment-method">
            <img src="payment_icons/touch_n_go.png" alt="Touch 'n Go eWallet">
            <span>Touch 'n Go eWallet</span>
          </div>
        </a>
        <a href="fpx.php" class="payment-link">
          <div class="payment-method">
            <img src="payment_icons/FPX.png" alt="FPX">
            <span>FPX</span>
          </div>
        </a>
        <a href="cod.php" class="payment-link">
          <div class="payment-method">
            <img src="payment_icons/cod.png" alt="Cash on Delivery">
            <span>Cash on Delivery</span>
          </div>
        </a>
      </div>
    </div>
    <div class="checkout-container">
      <a href="cart.php" class="back-button">Back</a>
    </div>
  </div>
 </body>
</html>
