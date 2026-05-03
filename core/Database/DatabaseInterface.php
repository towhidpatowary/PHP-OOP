<?php
namespace Core\Database;

use PDO;
interface DatabaseInterface {
    public function getConnection(): ?PDO;
}

?>