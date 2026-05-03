<?php
declare(strict_types=1);

namespace App\Services;

use App\Repositories\Interfaces\UserRepoInterface;
use App\Requests\UserRequest;
use App\Services\Interfaces\UserServiceInterface;

class UserService extends Service implements UserServiceInterface {
    private UserRepoInterface $userRepo;
    public function __construct(UserRepoInterface $REPO){
        $this->userRepo = $REPO;
    }
    public function getAll(): array {
        return $this->userRepo->getAll();
    }
    public function find(int $id): array {
        return $this->userRepo->findOrFail($id);
    }
    public function store(UserRequest $request): bool {
        $request->validate($request->request());
        return $this->userRepo->store($request);
    }
    public function update(int $id, UserRequest $request) : bool {
        $request->validate($request->request());
        return $this->userRepo->update($id, $request);
    }
    public function delete(int $id): bool {
        return $this->userRepo->delete($id);
    }
}
?>