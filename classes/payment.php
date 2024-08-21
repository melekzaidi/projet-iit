<?php
class Payment
{
    public $id;
    public $montant;
    public $cardnumber;
    public $cvc;
    public $expires;
    public $factureid;
    public $username; // Added the username property

    public function __construct() {}

    // Getters and setters...

    public function getId()
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getMontant()
    {
        return $this->montant;
    }

    public function setMontant(float $montant)
    {
        $this->montant = $montant;
    }

    public function getCardnumber()
    {
        return $this->cardnumber;
    }

    public function setCardnumber(string $cardnumber)
    {
        $this->cardnumber = $cardnumber;
    }

    public function getCvc()
    {
        return $this->cvc;
    }

    public function setCvc(string $cvc)
    {
        $this->cvc = $cvc;
    }

    public function getExpires()
    {
        return $this->expires;
    }

    public function setExpires(string $expires)
    {
        $this->expires = $expires;
    }

    public function getFactureid()
    {
        return $this->factureid;
    }

    public function setFactureid(int $factureid)
    {
        $this->factureid = $factureid;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    // Insert a new payment record into the database
    public function insert_payment()
    {
        require_once('config.php');
        $cnx = new Connection();
        $PDO = $cnx->connect();

        $stmt = $PDO->prepare("INSERT INTO payment(montant, cardnumber, cvc, expires, factureid, username) VALUES(:montant, :cardnumber, :cvc, :expires, :factureid, :username)");

        $stmt->bindParam(':montant', $this->montant);
        $stmt->bindParam(':cardnumber', $this->cardnumber);
        $stmt->bindParam(':cvc', $this->cvc);
        $stmt->bindParam(':expires', $this->expires);
        $stmt->bindParam(':factureid', $this->factureid);
        $stmt->bindParam(':username', $this->username); // Bind the username parameter

        $stmt->execute();
        return $PDO->lastInsertId();
    }

    // Select payment records based on a specific condition (e.g., factureid)
    public function select_payment_by_factureid()
    {
        require_once('config.php');
        $cnx = new Connection();
        $PDO = $cnx->connect();

        $stmt = $PDO->prepare("SELECT * FROM payment WHERE factureid = :factureid");
        $stmt->bindParam(':factureid', $this->factureid);

        $stmt->execute(); 
        $res = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $res;
    }
}
?>
