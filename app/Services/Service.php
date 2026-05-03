<?php
namespace App\Services;

use App\Repositories\Interfaces\UserRepoInterface;

class Service {
    private UserRepoInterface $userRepo;
    public function __construct(UserRepoInterface $REPO){
        $this->userRepo = $REPO;
    }
}
?>