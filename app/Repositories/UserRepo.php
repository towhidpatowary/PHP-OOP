<?php
namespace Repositories;

require_once __DIR__ . "/../Exceptions/DatabaseException.php";
require_once __DIR__ . "/../Exceptions/NotFoundException.php";

use Exceptions\DatabaseException;
use Exceptions\NotFoundException;
use Requests\UserRequest;

class UserRepo extends Repository {
    public function getAll() {
        $sql = "SELECT * FROM users";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll();

        return $users;
    }
    public function findOrFail(int $id) {
        $sql = "SELECT * FROM users where id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        $user = $stmt->fetch();

        if(!$user){
            throw new NotFoundException();
        }

        return $user;
    }
    public function store(UserRequest $request) {
        $sql = "INSERT INTO users (name, phone) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        $store = $stmt->execute([$request->name, $request->phone]);
        
        if(!$store){
            throw new DatabaseException();
        }
    }

    public function update(int $id, UserRequest $request) {
        $this->findOrFail($id);

        $sql = "UPDATE users SET name = ?, phone = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $update = $stmt->execute([$request->name, $request->phone, $id]);

        if(!$update){
            throw new DatabaseException();
        }
    }

    public function delete(int $id) {
        $this->findOrFail($id);

        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $delete = $stmt->execute([$id]);

        if(!$delete){
            throw new DatabaseException();
        }
    }
}

?>