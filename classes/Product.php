<?php
    require_once('config.php');

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
        $connection = new Connection();
        $pdo = $connection->connect();

        $stmt = $pdo->prepare("INSERT INTO products (nom, description, prix, qte_stock, categorie, image_path) VALUES (:nom, :description, :prix, :qte_stock, :categorie, :image_path)");
        $stmt->bindParam(':nom', $this->nom);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':prix', $this->prix);
        $stmt->bindParam(':qte_stock', $this->qte_stock);
        $stmt->bindParam(':categorie', $this->categorie);
        $stmt->bindParam(':image_path', $this->image_path);

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
}
?>
