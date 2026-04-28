<?php

namespace Controllers;

require_once __DIR__ . "/../Services/UserService.php";

use Services\UserService;
use Requests\UserRequest;

class UserController extends Controller {
    public function index() {
        $users = UserService::getAll();

        return view("user/userTable", compact('users'));
    }

    public function create() {
        return view("user/createUser");
    }

    public function store(UserRequest $request) {
        UserService::store($request);

        redirect("user_list");
    }

    public function edit(int $id) {
        $user = UserService::find($id);

        return view("user/editUser", compact('user'));
    }

    public function update(int $id, UserRequest $request) {
        UserService::update($id, $request);

        redirect("user_edit", ['id' => $id]);
    }

    public function delete(int $id) {
        UserService::delete($id);

        redirect("user_list");
    }

}

?>