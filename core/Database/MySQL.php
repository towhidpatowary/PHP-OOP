<?php
namespace Core\Database;

use App\Exceptions\DatabaseException;
use PDO;

class MySQL implements DatabaseInterface {
    private ?PDO $conn = null;
    private string $host;
    private string $dbname;
    private string $username;
    private string $password;
    public function __construct(){
        $this->host = "localhost";
        $this->dbname = "php_oop";
        $this->username = "root";
        $this->password = "";

        if($this->conn == null){
            $this->conn = $this->connectDB();
        }
    }

    private function connectDB(): PDO{
        try{
            $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4";

            return new PDO($dsn, $this->username, $this->password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        }catch (PDOException $e){
            throw new DatabaseException("Database connection failed: ". $e->getMessage());
        }
    }

    public function getConnection(): ?PDO{
        return $this->conn;
    }
}
?>