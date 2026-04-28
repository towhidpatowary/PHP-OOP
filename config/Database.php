<?php 

require_once __DIR__ . "/database/DatabaseInterface.php";

class Database {
    private ?PDO $db_connection = null;

    public function __construct(DatabaseInterface $database){
        if($this->db_connection == null){
            $this->db_connection = $database->getConnection();
        }
    }

    public function getConnection(): ?PDO{
        return $this->db_connection;
    }
}
?>