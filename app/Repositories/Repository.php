<?php 
namespace Repositories;
require  __DIR__ . "/../../config/Database.php";
require  __DIR__ . "/../../config/database/MySQL.php";

use Database;
use MySQL;
use PDO;
abstract class Repository {
    protected ?PDO $conn = null;
    public function __construct(){
        $db = new Database(new MySQL());
        $this->conn = $db->getConnection();
    }
}

?>