<?php
require_once  __DIR__ . "/../app/Controllers/Controller.php";
require_once  __DIR__ . "/../app/Controllers/UserController.php";
require_once __DIR__ . "/../app/Requests/UserRequest.php";

use Controllers\UserController;
use Requests\UserRequest;
function view($path, $data = []) {
        extract($data);
        ob_start();
        require "../views/{$path}.php";
        return ob_get_clean();
}
function redirect($path, $data = []) {
        $query = '';
        foreach($data as $key => $q){
            $query = "&{$key}={$q}";
        }
        header("Location: index.php?action={$path}{$query}");
        exit;
}


$action = $_GET['action'] ?? 'index';
$id = $_GET['id'] ?? '';

$content = "";

switch ($action) {
    case 'user_list':
        $userController = new UserController();
        $content = $userController->index();
    break;
    case 'create_user':
        $userController = new UserController();
        $content = $userController->create();
    break;
    case 'store_user':
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            redirect("users/create_user");
        }

        $name = $_POST['name'] ?? '';
        $phone = $_POST['phone'] ?? '';

        $userRequest = new UserRequest($name, $phone);
        $userController = new UserController();
        $userController->store($userRequest);
    break;
    case 'user_edit':
        $userController = new UserController();
        $content = $userController->edit($id);
    break;
    case 'update_user':
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            redirect("users/user_edit", ['id' => $id]);
        }

        $name = $_POST['name'] ?? '';
        $phone = $_POST['phone'] ?? '';

        $userRequest = new UserRequest($name, $phone);
        $userController = new UserController();
        $userController->update($id, $userRequest);
    break;
    case 'delete_user':
        $userController = new UserController();
        $userController->delete($id);
    break;
    default :
        $content = view("Dashboard");
    break;
}

require "../views/layouts/Layout.php";

?>