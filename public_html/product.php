<?php
//Start of session
session_start();
$username = "";
if (!empty($_SESSION['user_id'])) {
    $username = $_SESSION['username'];
}

//Start of database
require_once "config.php";
function getClothesByID($pdo, $prodId) {
    $stmt = $pdo->prepare("SELECT * FROM CLOTHES WHERE id=?");
    $stmt->bindValue(1, $prodId);
    $stmt->execute();
    return  $stmt->fetch(PDO::FETCH_OBJ);
}

function getClothesImageByID($pdo, $prodId) {
    $stmt = $pdo->prepare("SELECT * FROM clothes_images WHERE clothes_id=?");
    $stmt->bindValue(1, $prodId);
    $stmt->execute();
    return  $stmt->fetchAll(PDO::FETCH_OBJ);
}

function getClothesSizeByID($pdo, $prodId) {
    $stmt = $pdo->prepare("SELECT * FROM clothes_size WHERE clothes_id=?");
    $stmt->bindValue(1, $prodId);
    $stmt->execute();
    return  $stmt->fetch(PDO::FETCH_OBJ);
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

function createClothesCart($pdo, $sellerId, $clothesId) {
    $stmt = $pdo->prepare("INSERT INTO cart_items(seller_id,clothes_id) values (?,?)");
    $stmt->bindValue(1, $sellerId);
    $stmt->bindValue(2, $clothesId);
    return $stmt->execute();
};

if (isset($_POST['clothes_id'])) {
    if (!empty($_SESSION['user_id'])) {
        createClothesCart($pdo, $_SESSION['user_id'], $_POST['clothes_id']);
        $_SESSION['addSuccess'] = 1;
        header("Location: ./product.php?id=" . $_POST['clothes_id']);
    } else {
        $_SESSION['current_id'] = $_POST['clothes_id'];
        $_SESSION['err'] = "Please Sign In first";
        header("Location: ./LoginPage.php");
    }
}


$prod = getClothesByID($pdo, $_GET["id"]);
$prodImg = getClothesImageByID($pdo, $_GET["id"]);
$prodSize = getClothesSizeByID($pdo, $_GET["id"]);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cloth</title>
    <link rel="stylesheet" href="static\css\bootstrap.min.css" />
    <link rel="stylesheet" href="static\css\style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Dongle:wght@400;700&family=Inter:wght@400;700;900&family=Poppins:wght@400;700;900&display=swap');

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
        }

        h1 {
            font-size: 2rem;
        }

        h2 {
            font-size: 1.25rem;
        }

        h3 {
            font-size: 1rem;
            margin: 0;
            padding: 0;
            white-space: nowrap;
            color: black;
            line-height: 1.6;

        }

        .container {
            background-color: #E9E9E9;
            margin-block: 3rem;
            display: flex;
            max-width: 960px;
        }

        .column-left {
            width: 33%;
            display: flex;
            flex-direction: column;
        }

        .column-left>img {
            margin-block: 1rem;
            width: 100%;
            aspect-ratio: 1/1;
            object-fit: cover;

        }

        .column-left>button {
            margin-block: calc(30%);
            text-decoration: none;
            border: 0.1px solid black;
            background-color: #FFE7E1;
            padding: 1rem;
            border-radius: 2rem;
            box-shadow: 0 2px 2px;
            transition: all 250ms;
        }

        button:hover {
            border: 0.1px solid transparent;
            background-color: #fff;
            transform: translateY(0.5rem);
        }

        .pic-container {
            display: flex;
            flex-direction: row;
            justify-content: center;
        }

        .pic-container>img {
            width: 5rem;
            aspect-ratio: 1/1;
            object-fit: cover;
            outline: 1px solid red;
        }

        .column-right {
            width: 66%;
            display: flex;
            flex-direction: column;
            height: 0;
            padding-block: 0.2rem;
        }

        .column-right .header {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 0.25rem solid black;
            margin-left: 0.5rem;
        }

        .header>* {
            margin: 0;
            padding: 0.5rem 0.3rem;
        }

        .header>p {
            align-self: flex-end;
            padding: 0;
        }

        .info-container {
            margin-block: 1rem;
            margin-inline: 1rem;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            column-gap: 1rem;
            row-gap: 0.5rem;
        }

        .grid-measurement {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            row-gap: 1rem;
        }

        .voting-calc {
            background-color: #fff;
            margin: 2rem;
            width: calc(100%-2rem);
            border-radius: 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem;
            gap: 0.2rem;
        }

        .voting-calc>* {
            margin: 0;
            padding: 0;
        }

        .voting-calc>h2 {
            font-size: 1rem;
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

                        <h4 class="showUsername"><?php !empty($_SESSION['username']) ? print("Welcome, " . $username) : ""
                                                    ?></h4>
                    </li>

                    <li class="nav-item active">

                        <a href="#" class="nav-link">Contact</a>
                    </li>
                    <div class="navbar-icons">
                        <div class="user-tooltip">
                            <?php if (!empty($username)) : ?>
                                <a href="logout.php">Sign Out</a>
                            <?php else : ?>
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
    <!-- Product page start here -->
    <div class="container">
        <div class="column-left">
            <img src="
            <?php

            foreach ($prodImg as $img) {
                if ($img->isMain == "true") {
                    echo $img->imagePath;
                }
            }

            ?>" alt="">
            <div class="pic-container">
                <?php

                foreach ($prodImg as $img) {
                    if ($img->isMain == "false") {
                        print('<img src="' . $img->imagePath . '"alt=""> ');
                    }
                }

                ?>
            </div>
            <button type="button" onclick=addToCart()>Add to Cart</button>
            <form id="myForm" method="POST" action="./product.php"><input type="hidden" name="clothes_id" value="<?php echo $prod->id ?>"></form>
        </div>
        <div class="column-right">
            <div class="header">
                <h1><?php echo $prod->name ?></h1>
                <p><?php print time_elapsed_string($prod->datetime_added) ?></p>
            </div>
            <div class="info-container">
                <h2>Price</h2>
                <h2>RM <?php echo $prod->price ?></h2>
                <h2>Type</h2>
                <h2><?php print(ucfirst($prod->clothing_type)) ?></h2>
                <h2>Colour</h2>
                <h2><?php echo $prod->name ?></h2>
                <h2>Description</h2>
                <h2><?php echo $prod->description ?></h2>
                <h2>Measurement info</h2>
                <div class="grid-measurement">
                    <div class="grid-cell">
                        <h3>Length</h3>
                        <h3><?php echo $prodSize->length ?> cm</h3>
                    </div>
                    <div class="grid-cell">
                        <h3>Hem</h3>
                        <h3><?php echo $prodSize->hem ?> cm</h3>
                    </div>
                    <div class="grid-cell">
                        <h3>Strap Length</h3>
                        <h3><?php echo $prodSize->strap_length ?> cm</h3>
                    </div>
                    <div class="grid-cell">
                        <h3>Bodice</h3>
                        <h3><?php echo $prodSize->bodice ?> cm</h3>
                    </div>
                    <div class="grid-cell">
                        <h3>Bust Point</h3>
                        <h3><?php echo $prodSize->bust_point ?> cm</h3>
                    </div>
                    <div class="grid-cell">
                        <h3>Armhole</h3>
                        <h3><?php echo $prodSize->armhole ?> cm</h3>
                    </div>
                    <div class="grid-cell">
                        <h3>Skirt</h3>
                        <h3><?php echo $prodSize->skirt ?> cm</h3>
                    </div>
                    <div class="grid-cell">
                        <h3>Waist</h3>
                        <h3><?php echo $prodSize->waist ?> cm</h3>
                    </div>
                    <div class="grid-cell">
                        <h3>Neckline</h3>
                        <h3><?php echo $prodSize->neckline ?> cm</h3>
                    </div>
                </div>
            </div>
            <div class="voting-calc">
                <h1>13%</h1>
                <h2>Product Description Accuracy</h2>
                <h1>91.4%</h1>
                <h2>Image Quality</h2>
            </div>
        </div>
    </div>
    <div class="small-container"></div>
</body>
<script src="static/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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

    function addToCart() {
        if(<?php echo !empty($_SESSION['user_id'])? "true":"false"; ?>){
            $(document).ready(function() {
            swal({
                title: "HOORAY!",
                text: "Item added to your cart successfully",
                icon: "success",
                button: "OK"
            });
        });

        }

        setTimeout((()=>{
            document.getElementById("myForm").submit();
        }),1000);

    }
</script>
<?php
// if(!empty($_SESSION['addSuccess'])){
//     if($_SESSION['addSuccess'] == 1){
//         print('<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
//           <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
//           <script>
//             $(document).ready(function() {
//                 swal({
//                   title: "HOORAY!",
//                     text: "Item added to your cart successfully",
//                     icon: "success",
//                     button: "OK"
//                 });
//             });
//           </script>') ;
//      $_SESSION['addSuccess'] = 0;
//     }
// }

?>

</html>