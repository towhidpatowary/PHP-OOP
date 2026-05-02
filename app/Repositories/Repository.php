<?php 
namespace Repositories;

require_once __DIR__ . "/../../config/DatabaseInterface.php";

use DatabaseInterface;
use PDO;
use PDOStatement;

abstract class Repository {
    private ?PDO $conn = null;
    public function __construct(DatabaseInterface $db){
        $this->conn = $db->getConnection();
    }
}
?>