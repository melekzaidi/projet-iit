<?php
session_start(); // Start the session
require_once('classes/Product.php');
require_once('classes/config.php');

$product = new Product();

// Retrieve the product details based on the ID stored in the session
if (isset($_SESSION['edit_product_id'])) {
    $edit_product_id = $_SESSION['edit_product_id'];
    $edit_product = $product->selectProductById($edit_product_id);
}

// Handle form submission to update the product
if (isset($_POST["update_product"])) {
    $id = $_SESSION['edit_product_id'];
    $nom = $_POST["nom"];
    $description = $_POST["description"];
    $prix = $_POST["prix"];
    $qte_stock = $_POST["qte_stock"];
    $categorie = $_POST["categorie"];
    $image_path = $_POST["image_path"];

    $product->setNom($nom);
    $product->setDescription($description);
    $product->setPrix($prix);
    $product->setQteStock($qte_stock);
    $product->setCategorie($categorie);
    $product->setImagePath($image_path);

    // Update the product
    $product->updateProduct($id);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Edit Product - Dashboard HTML Template</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700" />
    <link rel="stylesheet" href="css/fontawesome.min.css" />
    <link rel="stylesheet" href="jquery-ui-datepicker/jquery-ui.min.css" type="text/css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/templatemo-style.css">
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
          <a class="nav-link" href="listproduct.php">
            <i class="fas fa-list"></i> List Products
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="edit-product.php">
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
                            <h2 class="tm-block-title d-inline-block">Edit Product</h2>
                        </div>
                    </div>
                    <div class="row tm-edit-product-row">
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <form action="#" method="post" class="tm-edit-product-form">
                                <input type="hidden" name="id" value="<?php echo $edit_product['id']; ?>">
                                <div class="form-group mb-3">
                                    <label for="name">Product Name</label>
                                    <input id="name" name="nom" type="text" class="form-control validate" value="<?php echo $edit_product['nom']; ?>" required />
                                </div>
                                <div class="form-group mb-3">
    <label for="image_path">Image Path</label>
    <input id="image_path" name="image_path" type="text" class="form-control validate" value="<?php echo $edit_product['image_path']; ?>" required />
</div>
                                <div class="form-group mb-3">
                                    <label for="price">Product price</label>
                                    <input id="price" name="prix" type="text" class="form-control validate" value="<?php echo $edit_product['prix']; ?>" required />
                                </div>
                                <div class="form-group mb-3">
                                    <label for="description">Description</label>
                                    <textarea class="form-control validate" rows="3" name="description" required><?php echo $edit_product['description']; ?></textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="category">Category</label>
                                    <select class="custom-select tm-select-accounts" id="category" name="categorie">
                                        <option selected>Select category</option>
                                        <option value="Ordinateurs portables" <?php if ($edit_product['categorie'] == 'Ordinateurs portables') echo 'selected'; ?>>Laptops</option>
                                        <option value="Accessoires informatiques" <?php if ($edit_product['categorie'] == 'Accessoires informatiques') echo 'selected'; ?>>Smartphones</option>
                                        <option value="Stockage externe" <?php if ($edit_product['categorie'] == 'Stockage externe') echo 'selected'; ?>>Cameras</option>
                                        <option value="Moniteurs" <?php if ($edit_product['categorie'] == 'Moniteurs') echo 'selected'; ?>>Accessories</option>
                                        <option value="Claviers" <?php if ($edit_product['categorie'] == 'Claviers') echo 'selected'; ?>>Accessories</option>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="form-group mb-3 col-xs-12 col-sm-6">
                                        <label for="stock">Units In Stock</label>
                                        <input id="stock" name="qte_stock" type="number" class="form-control validate" value="<?php echo $edit_product['qte_stock']; ?>" required />
                                    </div>
                                </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" name="update_product" class="btn btn-primary btn-block text-uppercase">Update Product</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="jquery-ui-datepicker/jquery-ui.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        $(function() {
            $("#expire_date").datepicker();
        });
    </script>
</body>

</html>
