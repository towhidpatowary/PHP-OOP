<?php 

require_once __DIR__ . "/DatabaseInterface.php";

class Database implements DatabaseInterface {
    private ?PDO $db_connection = null;

    public function __construct(DatabaseInterface $database){
        $this->db_connection = $database->getConnection();
    }

    public function getConnection(): ?PDO{
        return $this->db_connection;
    }
}
?>