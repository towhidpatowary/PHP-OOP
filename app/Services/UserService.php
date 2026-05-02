<?php
declare(strict_types=1);

namespace Services;
require_once  __DIR__ . "/../Repositories/Interfaces/UserRepoInterface.php";
require_once __DIR__ . "/Interfaces/UserServiceInterface.php";

use Repositories\Interfaces\UserRepoInterface;
use Requests\UserRequest;
use Services\Interfaces\UserServiceInterface;

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