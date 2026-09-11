<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Exceptions\DatabaseException;
use App\Exceptions\ExpiredException;
use App\Exceptions\NotFoundException;
use App\Exceptions\ValidationException;
use App\Requests\UserRequest;
use App\Services\UserService;

class UserController extends Controller {
    public function __construct(private UserService $userService) {}

    public function index() {
        try{
            $users = $this->userService->getAll();

            return view("user/userTable", compact('users'), 'Main');
        }catch (DatabaseException $e){
            return view("errors/DatabaseError");
        }catch (NotFoundException $e){
            return view("errors/NotFound");
        }
    }

    public function create() {
        try{
            return view("user/createUser", [], 'Main');
        }catch (NotFoundException $e){
            return view("errors/NotFound");
        }
    }

    public function store(UserRequest $request) {
        try{
            $this->userService->store($request->validated());
            redirect("/user_list");
        }catch (ValidationException $e){
            $errors = $e->getErrors();

            return view("user/createUser", compact('errors'), 'Main');
        }catch (ExpiredException $e){
            return view("errors/Expired");
        }catch (DatabaseException $e){
            return view("errors/DatabaseError");
        }
    }

    public function edit(string $id) {
        try{
            $user = $this->userService->find($id);

            return view("user/editUser", compact('user', 'id'), 'Main');
        }catch (DatabaseException $e){
            return view("errors/DatabaseError");
        }catch (NotFoundException $e){
            return view("errors/NotFound");
        }
    }

    public function update(string $id, UserRequest $request) {
        try{
            $this->userService->update($id, $request->validated());

            redirect("/user_edit/{$id}");
        }catch (ValidationException $e){
            $errors = $e->getErrors();

            return view("user/editUser", compact('errors'), 'Main');
        }catch (ExpiredException $e){
            return view("errors/Expired");
        }catch (DatabaseException $e){
            return view("errors/DatabaseError");
        }
    }

    public function delete(string $id) {
        try{
            $this->userService->delete($id);

            redirect("user_list");
        }catch (DatabaseException $e){
            return view("errors/DatabaseError");
        }catch (NotFoundException $e){
            return view("errors/NotFound");
        }
    }

}

?>