<?php 
namespace Core\Database;

use App\Exceptions\DatabaseException;
use Exception;
use PDO;
class Database implements DatabaseInterface {
    private ?PDO $db_connection = null;

    public function __construct(array $config)
    {
        try {
            match ($config['driver']) {
                'mysql' => $db = new MySQL($config['host'], $config['dbname'], $config['username'], $config['password']),
                default => throw new Exception("Unsupported database driver"),
            };

            $this->db_connection = $db->getConnection() ?? null;
        } catch (DatabaseException $e) {
            die($e->getMessage());
        }
    }

    public function getConnection(): ?PDO{
        return $this->db_connection;
    }
}
?>