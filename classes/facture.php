<?php

class Order
{
    public $id;
    public $montant;
    public $username;
    public $date;

    public function __construct()
    {
      
    }

    public function setId($id)
    {
        $this->id = $id;
    }
    public function getusername()
    {
        return $this->username;
    }

    public function setMontant($montant)
    {
        $this->montant = $montant;
    }

    public function setusername($username)
    {
        $this->username = $username;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    // Insert order into the database
   // Insert order into the database
public function insertOrder()
{         
  

    require_once('config.php');

    $connection = new Connection();
    $pdo = $connection->connect();

    $stmt = $pdo->prepare("INSERT INTO facture (montant, iduser, date) VALUES (:montant, :username, :date)");
    $stmt->bindParam(':montant', $this->montant);
    $stmt->bindParam(':iduser', $this->username);
    $stmt->bindParam(':date', $this->date);

    $stmt->execute();
    return $pdo->lastInsertId(); // Return the ID of the inserted order
}

    // Select all orders from the database
    public static function selectAllOrders()
    {
        require_once('config.php'); 
        $connection = new Connection();
        $pdo = $connection->connect();

        $stmt = $pdo->query("SELECT * FROM facture");
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $orders; // Return array of all orders
    }
}
?>
