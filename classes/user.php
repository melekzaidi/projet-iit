<?php
class User
{    public $id;

    public $username;
    public $password;
    public $email;

    public function __construct()
    {
    }
    
    public function getEmail()
    {
        return $this->email;
    }
    
    public function getPassword()
    {
        return $this->password;
    }
    
    public function getUsername()
    {
        return $this->username;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setUsername(string $username)
    {
        $this->username = $username;
    }
    
    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function insert_user()
    {
        require_once('config.php');
        $cnx = new Connection();
        $PDO = $cnx->connect();

        // Using prepared statements to prevent SQL injection
        $stmt = $PDO->prepare("INSERT INTO user(username, password, email) VALUES(:username, :password, :email)");
        
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':email', $this->email);

        $stmt->execute();
        return $PDO->lastInsertId();
    }
    public function select_user() {
        $cnx = new Connection();
        $PDO = $cnx->connect();
        $stmt = $PDO->prepare("SELECT * FROM user WHERE username = :username AND password = :password");
        
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password);
        $stmt->execute(); // Execute the prepared statement
        $res = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $res;
    }
    
}
?>