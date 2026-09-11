<?php
namespace App\Services\Interfaces;

use App\Requests\UserRequest;

interface UserServiceInterface {
    public function getAll(): array;
    public function find(string $id): array ;
    public function store(UserRequest $request): bool;
    public function update(string $id, UserRequest $request): bool;
    public function delete(string $id): bool;
}

?>