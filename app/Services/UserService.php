<?php
declare(strict_types=1);

namespace App\Services;

use App\Repositories\UserRepo;
use App\Requests\UserRequest;
use App\Services\Interfaces\UserServiceInterface;

class UserService extends Service implements UserServiceInterface {
    public function __construct(private UserRepo $userRepo){}
    public function getAll(): array {
        return $this->userRepo->getAll();
    }
    public function find(string $id): array {
        return $this->userRepo->findOrFail($id);
    }
    public function store(UserRequest $request): bool {
        $request->validate($request->request());
        return $this->userRepo->store($request);
    }
    public function update(string $id, UserRequest $request) : bool {
        $request->validate($request->request());
        return $this->userRepo->update($id, $request);
    }
    public function delete(string $id): bool {
        return $this->userRepo->delete($id);
    }
}
?>