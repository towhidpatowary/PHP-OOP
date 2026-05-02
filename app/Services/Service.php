<?php
namespace Services;

require_once  __DIR__ . "/../Repositories/Interfaces/UserRepoInterface.php";

use Repositories\Interfaces\UserRepoInterface;

class Service {
    private UserRepoInterface $userRepo;
    public function __construct(UserRepoInterface $REPO){
        $this->userRepo = $REPO;
    }
}
?>