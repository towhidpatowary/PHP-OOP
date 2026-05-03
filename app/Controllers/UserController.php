<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Exceptions\DatabaseException;
use App\Exceptions\ExpiredException;
use App\Exceptions\NotFoundException;
use App\Exceptions\ValidationException;
use App\Services\Interfaces\UserServiceInterface;
use App\Requests\UserRequest;
use Core\Helpers\View;

class UserController extends Controller {
    private UserServiceInterface $userService;
    public function __construct(UserServiceInterface $SERVICE) {
        $this->userService = $SERVICE;
    }

    public function index() {
        try{
            $users = $this->userService->getAll();

            return View::render("user/userTable", compact('users'), 'Main');
        }catch (DatabaseException $e){
            return View::render("errors/DatabaseError");
        }catch (NotFoundException $e){
            return View::render("errors/NotFound");
        }
    }

    public function create() {
        try{
            return View::render("user/createUser", [], 'Main');
        }catch (NotFoundException $e){
            return View::render("errors/NotFound");
        }
    }

    public function store(UserRequest $request) {
        try{
            $this->userService->store($request);
            $this->redirect("user_list");
        }catch (ValidationException $e){
            $errors = $e->getErrors();

            return View::render("user/createUser", compact('errors'), 'Main');
        }catch (ExpiredException $e){
            return View::render("errors/Expired");
        }catch (DatabaseException $e){
            return View::render("errors/DatabaseError");
        }
    }

    public function edit(int $id) {
        try{
            $user = $this->userService->find($id);

            return View::render("user/editUser", compact('user'), 'Main');
        }catch (DatabaseException $e){
            return View::render("errors/DatabaseError");
        }catch (NotFoundException $e){
            return View::render("errors/NotFound");
        }
    }

    public function update(int $id, UserRequest $request) {
        try{
            $this->userService->update($id, $request);

            $this->redirect("user_edit", ['id' => $id]);
        }catch (ValidationException $e){
            $errors = $e->getErrors();

            return View::render("user/editUser", compact('errors'), 'Main');
        }catch (ExpiredException $e){
            return View::render("errors/Expired");
        }catch (DatabaseException $e){
            return View::render("errors/DatabaseError");
        }
    }

    public function delete(int $id) {
        try{
            $this->userService->delete($id);

            $this->redirect("user_list");
        }catch (DatabaseException $e){
            return View::render("errors/DatabaseError");
        }catch (NotFoundException $e){
            return View::render("errors/NotFound");
        }
    }

}

?>