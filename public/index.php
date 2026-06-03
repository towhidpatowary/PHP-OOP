<?php
require_once __DIR__ . "/../vendor/autoload.php";

use App\Controllers\UserController;
use App\Models\User;
use App\Repositories\UserRepo;
use App\Services\UserService;
use Core\Database\Database;
use Core\Helpers\Config;

$databaseConfig = Config::get('database');


// Passing Dependency
$db = new Database($databaseConfig['connections'][$databaseConfig['default']]);

$userModel = new User();
$userRepo = new UserRepo($userModel, $db);
$userService = new UserService($userRepo);
$userController = new UserController($userService);


require_once __DIR__ ."/../routes/web.php";

?>