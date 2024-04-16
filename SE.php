<?php 
session_start();
require_once("classes/config.php");
require_once("classes/Product.php");
$product = new Product();

// Fetch products for the "Claviers" category
$claviers = $product->selectProductsByCategory("Stockage externe");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Claviers - Products</title>
    <!-- Stylesheets -->
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="css/slick.css" />
    <link type="text/css" rel="stylesheet" href="css/slick-theme.css" />
    <link type="text/css" rel="stylesheet" href="css/nouislider.min.css" />
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="css/style.css" />
</head>
<body>
    <!-- Header -->
    <header>
        <div id="header">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="header-logo">
                            <a href="#" class="logo">
                                <img src="./img/logo.png" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 clearfix">
                        <div class="header-ctn">
                        <div class="dropdown">
                                <a class="dropdown-toggle" href="cart.php" data-toggle="dropdown" aria-expanded="true">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Your Cart</span>
                                    <div class="qty">3</div>
                                </a>
                                <div class="cart-dropdown">
                                    <div class="cart-list">
                                        <div class="product-widget">
                                            <div class="product-img">
                                                <img src="./img/product01.png" alt="">
                                            </div>
                                            <div class="product-body">
                                                <h3 class="product-name"><a href="#">product name goes here</a></h3>
                                                <h4 class="product-price"><span class="qty">1x</span>$980.00</h4>
                                            </div>
                                            <button class="delete"><i class="fa fa-close"></i></button>
                                        </div>

                                        <div class="product-widget">
                                            <div class="product-img">
                                                <img src="./img/product02.png" alt="">
                                            </div>
                                            <div class="product-body">
                                                <h3 class="product-name"><a href="#">product name goes here</a></h3>
                                                <h4 class="product-price"><span class="qty">3x</span>$980.00</h4>
                                            </div>
                                            <button class="delete"><i class="fa fa-close"></i></button>
                                        </div>
                                    </div>
                                    <div class="cart-summary">
                                        <small>3 Item(s) selected</small>
                                        <h5>SUBTOTAL: $2940.00</h5>
                                    </div>
                                    <div class="cart-btns">
                                        <a href="#">View Cart</a>
                                        <a href="#">Checkout <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <a class="dropdown-toggle" href="index.php" data-toggle="dropdown" aria-expanded="true">
                                    <i class="fa fa-sign-out"></i>
                                    <span>logout</span>
                                </a>
                            </div>
                            <div class="menu-toggle">
                                <a href="#">
                                    <i class="fa fa-bars"></i>
                                    <span>Menu</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Navigation -->
    <nav id="navigation">
        <div class="container">
            <div id="responsive-nav">
            <ul class="main-nav nav navbar-nav">
                    <li ><a href="storeshop.php">Home</a></li>
                    <li ><a href="claviers.php">Claviers</a></li>
                    <li ><a href="PC.php">Ordinateurs Portables</a></li>
                    <li class="active"><a href="SE.php">Stockage Externe</a></li>
                    <li><a href="monieurs.php">Moniteurs</a></li>
                    <li><a href="Accs.php">Autres Accessories</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Products -->
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">Stockage Externe</h3>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <div id="tab1" class="tab-pane fade in active">
                                <div class="products-slick" data-nav="#slick-nav-2">
                                    <?php 
                                    if (!empty($claviers)) {
                                        foreach ($claviers as $product) {
                                            // Output product details
                                            echo "
                                            <div class='col-md-3 col-xs-6'>
                                                <div class='product'>
                                                    <div class='product-img'>
                                                        <img src=\"/{$product['image_path']}\" alt='{$product['nom']}'>
                                                    </div>
                                                    <div class='product-body'>
                                                        <p class='product-category'>{$product['categorie']}</p>
                                                        <h3 class='product-name'><a href='#'>{$product['nom']}</a></h3>
                                                        <h4 class='product-price'>{$product['prix']} $</h4>
                                                    </div>
                                                </div>
                                            </div>";
                                        }
                                    } else {
                                        echo "No products found for Claviers category.";
                                    }
                                    ?>
                                </div>
                                <div id="slick-nav-2" class="products-slick-nav"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer id="footer">
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <ul class="footer-payments">
                            <li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
                            <li><a href="#"><i class="fa fa-credit-card"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
                        </ul>
                        <span class="copyright">
                            &copy; <script>document.write(new Date().getFullYear())</script> All rights reserved
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Scripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/nouislider.min.js"></script>
    <script src="js/jquery.zoom.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
