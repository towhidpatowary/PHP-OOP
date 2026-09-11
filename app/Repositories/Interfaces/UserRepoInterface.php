<?php
namespace App\Repositories\Interfaces;

use App\Requests\UserRequest;


interface UserRepoInterface {
    public function getAll(): array;
    public function findOrFail(string $id): array ;
    public function store(UserRequest $request): bool;
    public function update(string $id, UserRequest $request): bool;
    public function delete(string $id): bool;
}

?>