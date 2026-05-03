<?php
require_once __DIR__ . "/../vendor/autoload.php";

use App\Controllers\UserController;
use App\Models\User;
use App\Repositories\UserRepo;
use App\Services\UserService;
use Core\Database\Database;
use Core\Database\MySQL;

// Passing Dependency
$db = new Database(new MySQL());

$userModel = new User();
$userRepo = new UserRepo($userModel, $db);
$userService = new UserService($userRepo);
$userController = new UserController($userService);


require_once __DIR__ ."/../routes/web.php";

?>