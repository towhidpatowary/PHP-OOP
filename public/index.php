<?php
require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../config/Database.php";
require_once __DIR__ . "/../config/database/MySQL.php";

require_once __DIR__ . "/../app/Helpers/GlobalMethods.php";

use App\Controllers\UserController;
use App\Models\User;
use App\Repositories\UserRepo;
use App\Services\UserService;

// Passing Dependency
$db = new Database(new MySQL());

$userModel = new User();
$userRepo = new UserRepo($userModel, $db);
$userService = new UserService($userRepo);
$userController = new UserController($userService);


require_once __DIR__ ."/../routes/web.php";

?>