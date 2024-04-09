<?php

class Connection
{
    public function connect(){
        try {
            $dbc = new PDO('mysql:host=localhost;dbname=tunishop', 'root', '');
            // Set PDO to throw exceptions on error
            $dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $dbc;
        } catch (PDOException $e) {
            // Log the error instead of echoing it
            error_log("Connection to MySQL failed: " . $e->getMessage());
            exit(); // Terminate script execution after logging the error
        }
    }
}
?>
