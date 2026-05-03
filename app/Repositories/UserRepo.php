<?php
declare(strict_types=1);

namespace App\Repositories;

require_once __DIR__ . "/../../config/DatabaseInterface.php";

use DatabaseInterface;
use App\Exceptions\DatabaseException;
use App\Exceptions\NotFoundException;
use App\Models\Model;
use PDO;
use App\Repositories\Interfaces\UserRepoInterface;
use App\Requests\UserRequest;
use App\Repositories\Repository;

class UserRepo extends Repository implements UserRepoInterface {
    private Model $model;
    private ?PDO $conn = null;
    public function __construct(Model $model, DatabaseInterface $db){
        $this->model = $model;

        $this->conn = $db->getConnection();
    }
    public function getAll(): array {
        $sql = "SELECT * FROM {$this->model->tableName()}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll();

        return $users;
    }
    public function findOrFail(int $id): array {
        $sql = "SELECT * FROM {$this->model->tableName()} where id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        $user = $stmt->fetch();

        if(!$user){
            throw new NotFoundException();
        }

        return $user;
    }
    public function store(UserRequest $request): bool {
        $fillable = $this->model->fillable();
        $columns = implode(', ', $fillable);
        $placeholder = implode(', ' , array_fill(0, count($fillable), '?'));

        $values = array_map(fn($field) => $request->$field ?? null, $fillable);

        $sql = "INSERT INTO {$this->model->tableName()} ({$columns}) VALUES ({$placeholder})";
        $stmt = $this->conn->prepare($sql);
        $store = $stmt->execute($values);
        
        if(!$store){
            throw new DatabaseException();
        }

        return $store;
    }
    public function update(int $id, UserRequest $request): bool {
        $this->findOrFail($id);

        $fillable = $this->model->fillable();

        $placeholder = array_map(fn($field) => "{$field} = ?" , $fillable);
        $columns = implode(', ', $placeholder);

        $values = array_map(fn($field) => $request->$field ?? null , $fillable);
        $values[] = $id;

        $sql = "UPDATE {$this->model->tableName()} SET {$columns} WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $update = $stmt->execute($values);

        if(!$update){
            throw new DatabaseException();
        }

        return $update;
    }
    public function delete(int $id): bool {
        $this->findOrFail($id);

        $sql = "DELETE FROM {$this->model->tableName()} WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $delete = $stmt->execute([$id]);

        if(!$delete){
            throw new DatabaseException();
        }

        return $delete;
    }
}

?>