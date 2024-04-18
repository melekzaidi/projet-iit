<?php

class Product
{

    public $nom;
    public $description;
    public $prix;
    public $qte_stock;
    public $categorie;
    public $image_path;

    public function __construct()
    {
      
    }
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    public function setQteStock($qte_stock)
    {
        $this->qte_stock = $qte_stock;
    }

    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }

    public function setImagePath($image_path)
    {
        $this->image_path = $image_path;
    }
    // Getters and setters for product attributes
    // (These were included in the previous response)

    // Insert product into the database
    public function insertProduct()
{         
    require_once('config.php');

    $connection = new Connection();
    $pdo = $connection->connect();

    $stmt = $pdo->prepare("INSERT INTO products (nom, description, prix, qte_stock, categorie, image_path) VALUES (:nom, :description, :prix, :qte_stock, :categorie, :image_path)");
    $stmt->bindParam(':nom', $this->nom);
    $stmt->bindParam(':description', $this->description);
    $stmt->bindParam(':prix', $this->prix);
    $stmt->bindParam(':qte_stock', $this->qte_stock);
    $stmt->bindParam(':categorie', $this->categorie);
    // Concatenate the image path properly
    $image_path = 'img/' . $this->image_path;
    $stmt->bindParam(':image_path', $image_path);

    $stmt->execute();
    return $pdo->lastInsertId(); // Return the ID of the inserted product
}

    // Select all products from the database
    public static function selectAllProducts()
    {
        require_once('config.php'); // Assuming this file contains your database connection details
        $connection = new Connection();
        $pdo = $connection->connect();

        $stmt = $pdo->query("SELECT * FROM products");
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $products; // Return array of all products
    }
    public static function selectProductsByCategory($category)
    {
        require_once('config.php'); // Assuming this file contains your database connection details
        $connection = new Connection();
        $pdo = $connection->connect();
    
        // Use prepared statement to prevent SQL injection
        $stmt = $pdo->prepare("SELECT * FROM products WHERE categorie = ?");
        $stmt->execute([$category]);
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $products; // Return array of products in the specified category
    }
    public static function selectProductById($id)
{
    require_once('config.php'); // Assuming this file contains your database connection details
    $connection = new Connection();
    $pdo = $connection->connect();

    // Use prepared statement to prevent SQL injection
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    return $product; // Return the product details
}
public function updateProduct($id)
{
    require_once('config.php');

    $connection = new Connection();
    $pdo = $connection->connect();

    $stmt = $pdo->prepare("UPDATE products SET nom = :nom, description = :description, prix = :prix, qte_stock = :qte_stock, categorie = :categorie, image_path = :image_path WHERE id = :id");
    $stmt->bindParam(':nom', $this->nom);
    $stmt->bindParam(':description', $this->description);
    $stmt->bindParam(':prix', $this->prix);
    $stmt->bindParam(':qte_stock', $this->qte_stock);
    $stmt->bindParam(':categorie', $this->categorie);
    $stmt->bindParam(':image_path', $this->image_path);
    $stmt->bindParam(':id', $id);

    $stmt->execute();
}
   public function decreaseStock($productId, $quantity)
    {
        require_once('config.php');

        $connection = new Connection();
        $pdo = $connection->connect();

        // Retrieve current quantity in stock
        $stmt = $pdo->prepare("SELECT qte_stock FROM products WHERE id = ?");
        $stmt->execute([$productId]);
        $currentStock = $stmt->fetchColumn();

        // Calculate new stock after deduction
        $newStock = $currentStock - $quantity;

        // Update the quantity in the database
        $stmt = $pdo->prepare("UPDATE products SET qte_stock = :newStock WHERE id = :productId");
        $stmt->bindParam(':newStock', $newStock);
        $stmt->bindParam(':productId', $productId);
        $stmt->execute();
    }

}
?>
