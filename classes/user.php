<?php
class User
{
    public $id;
    public $username;
    public $password;
    public $email;
    public $cardnumber;
    public $placeholdercarder; // Keep this for backward compatibility if needed
    public $cvc;
    public $expires;

    public function __construct() {}

    // Getters and setters...

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getCardnumber()
    {
        return $this->cardnumber;
    }

    public function setCardnumber(string $cardnumber)
    {
        $this->cardnumber = $cardnumber;
    }

    public function getPlaceholdercarder()
    {
        return $this->placeholdercarder;
    }

    public function setPlaceholdercarder(string $placeholdercarder)
    {
        $this->placeholdercarder = $placeholdercarder;
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

    public function insert_user()
    {
        require_once('config.php');
        $cnx = new Connection();
        $PDO = $cnx->connect();

        $stmt = $PDO->prepare("INSERT INTO user(username, password, email, cardnumber, placeholdercarder, cvc, expires) VALUES(:username, :password, :email, :cardnumber, :placeholdercarder, :cvc, :expires)");

        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':cardnumber', $this->cardnumber);
        $stmt->bindParam(':placeholdercarder', $this->placeholdercarder);
        $stmt->bindParam(':cvc', $this->cvc);
        $stmt->bindParam(':expires', $this->expires);

        $stmt->execute();
        return $PDO->lastInsertId();
    }

    public function select_user()
    {
        $cnx = new Connection();
        $PDO = $cnx->connect();
        $stmt = $PDO->prepare("SELECT * FROM user WHERE username = :username AND password = :password");
    
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password);
    
        $stmt->execute(); 
        $res = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $res;
    }
}
?>
