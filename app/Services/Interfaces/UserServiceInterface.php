<?php
namespace App\Services\Interfaces;

interface UserServiceInterface {
    public function getAll(): array;
    public function find(string $id): array ;
    public function store(array $data): bool;
    public function update(string $id, array $data): bool;
    public function delete(string $id): bool;
}

?>