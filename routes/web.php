<?php
use App\Controllers\UserController;
use Core\Router;

Router::get('/', function () {
    view("Dashboard", [], 'Main');
});

Router::get('/user_list', [UserController::class, 'index']);
Router::get('/create_user', [UserController::class, 'create']);
Router::post('/store_user', [UserController::class, 'store']);
Router::get('/user_edit/{id}', [UserController::class, 'edit']);
Router::post('/update_user/{id}', [UserController::class, 'update']);
Router::get('/delete_user/{id}', [UserController::class, 'delete']);

?>