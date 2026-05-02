<?php
namespace Repositories\Interfaces;

use Requests\UserRequest;


interface UserRepoInterface {
    public function getAll(): array;
    public function findOrFail(int $id): array ;
    public function store(UserRequest $request): bool;
    public function update(int $id, UserRequest $request): bool;
    public function delete(int $id): bool;
}

?>