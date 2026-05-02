<?php
require_once __DIR__ . "/../app/Exceptions/DatabaseException.php";
require_once __DIR__ . "/../app/Exceptions/NotFoundException.php";
require_once __DIR__ . "/../app/Exceptions/ValidationException.php";
require_once __DIR__ . "/../app/Exceptions/ExpiredException.php";

require_once  __DIR__ . "/../app/Controllers/Controller.php";
require_once  __DIR__ . "/../app/Controllers/UserController.php";
require_once __DIR__ . "/../app/Requests/Request.php";
require_once __DIR__ . "/../app/Requests/UserRequest.php";
require_once __DIR__ . "/../app/Services/Service.php";
require_once __DIR__ . "/../app/Services/UserService.php";
require_once __DIR__ . "/../app/Repositories/UserRepo.php";
require_once __DIR__ . "/../app/Models/User.php";

require  __DIR__ . "/../config/Database.php";
require  __DIR__ . "/../config/database/MySQL.php";

require_once  __DIR__ . "/../app/Helpers/GlobalMethods.php";

use Controllers\UserController;
use Models\User;
use Repositories\UserRepo;
use Services\UserService;

// Passing Dependency
$db = new Database(new MySQL());

$userModel = new User();
$userRepo = new UserRepo($userModel, $db);
$userService = new UserService($userRepo);
$userController = new UserController($userService);


require_once __DIR__ ."/../routes/web.php";

?>