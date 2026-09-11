<?php
namespace App\Repositories\Interfaces;


interface UserRepoInterface {
    public function getAll(): array;
    public function findOrFail(string $id): array ;
    public function store(array $data): bool;
    public function update(string $id, array $data): bool;
    public function delete(string $id): bool;
}

?>