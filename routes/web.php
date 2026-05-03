<?php
use App\Requests\UserRequest;
use Core\Helpers\View;

session_start();

if(!isset($_SESSION['CSRF_TOKEN'])){
    $_SESSION['CSRF_TOKEN'] = bin2hex(random_bytes(32)); 
}

$action = $_GET['action'] ?? 'index';
$id = $_GET['id'] ?? '';

switch ($action) {
    case 'user_list':
        $userController->index();
        break;
    case 'create_user':
        $userController->create();
        break;
    case 'store_user':
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            View::render("errors/405");
        }

        $userRequest = new UserRequest($_POST);
        $userController->store($userRequest);
        break;
    case 'user_edit':
        $userController->edit($id);
        break;
    case 'update_user':
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            View::render("errors/405");
        }

        $userRequest = new UserRequest($_POST);
        $userController->update($id, $userRequest);
        break;
    case 'delete_user':
        $userController->delete($id);
        break;
    default:
        View::render("Dashboard", [], 'Main');
        break;
}

?>