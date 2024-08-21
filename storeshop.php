<?php 
session_start();
require_once("classes/config.php");
require_once("classes/Product.php");
$product = new Product();

// Default category to display
$category = isset($_GET['category']) ? $_GET['category'] : '';

// Fetch products based on category
if ($category) {
    $products = $product->selectProductsByCategory($category);
} else {
    $products = $product->selectAllProducts();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        #categoryFilter {
            margin :10px;
    width: 200px;
    padding: 8px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
    background-color: #f9f9f9;
    color: #333;
    outline: none;
    transition: all 0.3s ease;
}

#categoryFilter:hover {
    border-color: #888;
}

#categoryFilter:focus {
    border-color: #555;
    background-color: #fff;
}
    </style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Electro - HTML Ecommerce Template</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="css/slick.css" />
    <link type="text/css" rel="stylesheet" href="css/slick-theme.css" />
    <link type="text/css" rel="stylesheet" href="css/nouislider.min.css" />
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="css/style.css" />
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
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
                                        <!-- Cart items here -->
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

    <nav id="navigation">
        <div class="container">
            <div id="responsive-nav">
                <ul class="main-nav nav navbar-nav">
                    <li><a href="index.php">Home</a></li>
                    <li>
                <select id="categoryFilter" onchange="filterProducts()">
    <option value="">All Categories</option>
    <option value="Claviers" <?php echo $category === 'Claviers' ? 'selected' : ''; ?>>Claviers</option>
    <option value="Ordinateurs Portables" <?php echo $category === 'Ordinateurs Portables' ? 'selected' : ''; ?>>Ordinateurs Portables</option>
    <option value="Stockage Externe" <?php echo $category === 'Stockage Externe' ? 'selected' : ''; ?>>Stockage Externe</option>
    <option value="Moniteurs" <?php echo $category === 'Moniteurs' ? 'selected' : ''; ?>>Moniteurs</option>
    <option value="Accessoires informatiques" <?php echo $category === 'Accessoires informatiques' ? 'selected' : ''; ?>>Autres Accessoires</option>
</select>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">Nos Produits</h3>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <div id="tab2" class="tab-pane fade in active">
                                <div class="products-slick" data-nav="#slick-nav-2">
                                    <?php  
                                    if (!empty($products)) {
                                        foreach ($products as $product) {
                                            $id = $product['id'];
                                            $name = $product['nom'];
                                            $price = $product['prix'];
                                            $categorie = $product['categorie'];
                                            $image = $product['image_path'];
                                            
                                            if (isset($_POST['addtocart']) && $_POST['product_id'] == $id) {
                                                $ventes = isset($_SESSION["ventes"]) ? $_SESSION["ventes"] : [];
                                                $productExists = false;
                                                foreach ($ventes as $vente) {
                                                    if ($vente['id'] == $id) {
                                                        $productExists = true;
                                                        break;
                                                    }
                                                }
                                                if (!$productExists) {
                                                    $ventes[] = ["id" => $id, "nom" => $name, "prix" => $price, "image" => $image];
                                                    $_SESSION['ventes'] = $ventes;
                                                }
                                            }
                                            
                                            echo "
                                            <form method='post'>
                                                <div class='product'>
                                                    <div class='product-img'>
                                                        <img height=300px src=\"/$image\" alt=\"\">
                                                        <div class=\"product-label\"></div>
                                                    </div>
                                                    <div class=\"product-body\">
                                                        <p class=\"product-category\">$categorie</p>
                                                        <h3 class=\"product-name\"><a href=\"#\">$name</a></h3>
                                                        <h4 class=\"product-price\">$price $</h4>
                                                        
                                                        <div class=\"product-btns\">
                                                            <button class=\"add-to-wishlist\"><i class=\"fa fa-heart-o\"></i><span class=\"tooltipp\">add to wishlist</span></button>
                                                            <button class=\"add-to-compare\"><i class=\"fa fa-exchange\"></i><span class=\"tooltipp\">add to compare</span></button>
                                                            <button class=\"quick-view\"><i class=\"fa fa-eye\"></i><span class=\"tooltipp\">quick view</span></button>
                                                        </div>
                                                    </div>
                                                    <div class=\"add-to-cart\">
                                                        <input type='hidden' name='product_id' value='$id'>
                                                        <button name='addtocart' class=\"add-to-cart-btn\"><i class=\"fa fa-shopping-cart\"></i> add to cart</button>
                                                    </div>
                                                </div>
                                            </form>";
                                        } 
                                    } else {
                                        echo "No products found.";
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

    <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-xs-6">
                    <div class="footer-about">
                        <h3 class="footer-title">About Us</h3>
                        <p>We are a team of passionate individuals dedicated to bringing you the best products at the most competitive prices.</p>
                        <ul class="footer-social">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-xs-6">
                    <div class="footer-links">
                        <h3 class="footer-title">Categories</h3>
                        <ul>
                            <li><a href="claviers.php">Claviers</a></li>
                            <li><a href="PC.php">Ordinateurs Portables</a></li>
                            <li><a href="SE.php">Stockage Externe</a></li>
                            <li><a href="moniteurs.php">Moniteurs</a></li>
                            <li><a href="Accs.php">Autres Accessories</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-xs-6">
                    <div class="footer-links">
                        <h3 class="footer-title">Information</h3>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Terms & Conditions</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-xs-6">
                    <div class="footer-newsletter">
                        <h3 class="footer-title">Newsletter</h3>
                        <p>Sign up for our newsletter and be the first to know about new products and special offers.</p>
                        <form>
                            <input class="input" type="email" placeholder="Enter your email">
                            <button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/nouislider.min.js"></script>
    <script src="js/jquery.zoom.min.js"></script>
    <script src="js/main.js"></script>
    <script>
        function filterProducts() {
            var category = document.getElementById('categoryFilter').value;
            window.location.href = 'storeshop.php?category=' + category;
        }
    </script>
</body>
</html>
