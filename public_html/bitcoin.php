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
  <title>Timeless Thrift - Bitcoin Payment</title>
  <style>
    .container {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }
    .payment-form {
      width: 500px;
      padding: 50px;
      border-radius: 5px;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
      background-color: #FFFFFF;
      margin: 20px;
    }
    .payment-form .picture-frame {
      display: flex;
      justify-content: center;
      align-items: center;
      width: 200px;
      height: 200px;
      border: 1px solid #CCC;
      border-radius: 5px;
      margin: 0 auto 20px;
    }
    .payment-form .picture-frame img {
      max-width: 100%;
      max-height: 100%;
    }
    .payment-form p {
      font-size: 16px;
      margin-bottom: 20px;
      text-align: center;
    }
    .payment-form input[type="submit"] {
      display: block;
      margin: 0 auto;
      padding: 10px;
      background-color: #DFA2A2;
      color: black;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    .back-button {
      margin-top: 20px;
      padding: 10px;
      background-color: #DFA2A2;
      color: black;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      margin-right: 10px;
    }
    .back-to-payment-button {
      margin-top: 20px;
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
    <h1>Bitcoin Payment</h1>
    <div class="payment-form">
      <div class="picture-frame">
        <img src="payment_icons/bitcoin_qr_code.png" alt="Bitcoin QR Code">
      </div>
      <p>Scan the QR code from your crypto wallet to proceed with the payment or transfer the amount manually to the following address:</p>
      <p>1GX4pgm6oAchkh3wqkXq2kASk144gMR57P</p>
      <form action="success.php" method="POST">
        <input type="submit" value="Proceed">
      </form>
    </div>
    <div>
      <button class="back-button" onclick="window.location.href='cart.php';">Back to Cart</button>
      <button class="back-to-payment-button" onclick="window.location.href='payment_gtw.php';">Back to Payment</button>
    </div>
  </div>

	<div style="height: 20px;"></div>
</body>
</html>
