<?php
declare(strict_types=1);

namespace App\Services;

use App\Repositories\UserRepo;
use App\Services\Interfaces\UserServiceInterface;

class UserService extends Service implements UserServiceInterface {
    public function __construct(private UserRepo $userRepo){}
    public function getAll(): array {
        return $this->userRepo->getAll();
    }
    public function find(string $id): array {
        return $this->userRepo->findOrFail($id);
    }
    public function store(array $data): bool {
        return $this->userRepo->store($data);
    }
    public function update(string $id, array $data) : bool {
        return $this->userRepo->update($id, $data);
    }
    public function delete(string $id): bool {
        return $this->userRepo->delete($id);
    }
}
?>