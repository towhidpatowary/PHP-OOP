<?php
namespace Services\Interfaces;

use Requests\UserRequest;

interface UserServiceInterface {
    public function getAll(): array;
    public function find(int $id): array ;
    public function store(UserRequest $request): bool;
    public function update(int $id, UserRequest $request): bool;
    public function delete(int $id): bool;
}

?>