<?php 
namespace App\Repositories;

use Core\Database\DatabaseInterface;
use PDO;

abstract class Repository {
    private ?PDO $conn = null;
    public function __construct(DatabaseInterface $db){
        $this->conn = $db->getConnection();
    }
}
?>