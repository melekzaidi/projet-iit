<?php
session_start(); // Start the session
require_once('classes/Product.php');
require_once('classes/config.php');

$product = new Product();
$products = Product::selectAllProducts();

// Handle edit button click
if (isset($_POST['edit_product_id'])) {
    $_SESSION['edit_product_id'] = $_POST['edit_product_id'];
    header("Location: edit-product.php"); // Redirect to the edit product page
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Listing - Dashboard HTML Template</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/templatemo-style.css">

    <style>
        /* Custom CSS for odd-numbered table rows */
        .tm-table-striped-product tbody tr:nth-child(odd) {
            color: black;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-xl mx-auto">
  <div class="container h-100">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mx-auto h-100">
        <li class="nav-item">
          <a class="nav-link" href="dashboard.php">
            <i class="fas fa-tachometer-alt"></i> Dashboard
            <span class="sr-only">(current)</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="add-product.php ">
            <i class="fas fa-shopping-cart"></i> Add Products
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="listproduct.php">
            <i class="fas fa-list"></i> List Products
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="edit-product.php">
            <i class="fas fa-edit"></i> Edit Products
          </a>
        </li>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link d-block" href="index.php">
            <b>Logout</b>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>


<div class="container tm-mt-big tm-mb-big">
    <div class="row">
        <div class="col-xl-9 col-lg-10 col-md-12 col-sm-12 mx-auto">
            <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
                <div class="row">
                    <div class="col-12">
                        <h2 class="tm-block-title d-inline-block">Product Listing</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <?php if ($products) { ?>
                            <table class="table table-striped tm-table-striped-product">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity in Stock</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Action</th> <!-- Add this column for the Edit button -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($products as $product) { ?>
                                        <tr>
                                            <td><?php echo $product['id']; ?></td>
                                            <td><?php echo $product['nom']; ?></td>
                                            <td><?php echo $product['description']; ?></td>
                                            <td><?php echo $product['prix']; ?></td>
                                            <td><?php echo $product['qte_stock']; ?></td>
                                            <td><?php echo $product['categorie']; ?></td>
                                            <td><img src="<?php echo $product['image_path']; ?>" alt="Product Image" width="100"></td>
                                            <td>
                                                <form method="post">
                                                    <input type="hidden" name="edit_product_id" value="<?php echo $product['id']; ?>">
                                                    <button type="submit" class="btn btn-primary">Edit</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        <?php } else { ?>
                            <p>No products found.</p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
