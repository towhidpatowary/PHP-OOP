<?php
declare(strict_types=1);

namespace Controllers;

require_once __DIR__ . "/../Services/Interfaces/UserServiceInterface.php";

use Exceptions\DatabaseException;
use Exceptions\ExpiredException;
use Exceptions\NotFoundException;
use Exceptions\ValidationException;
use Services\Interfaces\UserServiceInterface;
use Requests\UserRequest;

class UserController extends Controller {
    private UserServiceInterface $userService;
    public function __construct(UserServiceInterface $SERVICE) {
        $this->userService = $SERVICE;
    }

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
            $this->userService->store($request);
            redirect("user_list");
        }catch (ValidationException $e){
            $errors = $e->getErrors();

            return view("user/createUser", compact('errors'), 'Main');
        }catch (ExpiredException $e){
            return view("errors/Expired");
        }catch (DatabaseException $e){
            return view("errors/DatabaseError");
        }
    }

    public function edit(int $id) {
        try{
            $user = $this->userService->find($id);

            return view("user/editUser", compact('user'), 'Main');
        }catch (DatabaseException $e){
            return view("errors/DatabaseError");
        }catch (NotFoundException $e){
            return view("errors/NotFound");
        }
    }

    public function update(int $id, UserRequest $request) {
        try{
            $this->userService->update($id, $request);

            redirect("user_edit", ['id' => $id]);
        }catch (ValidationException $e){
            $errors = $e->getErrors();

            return view("user/editUser", compact('errors'), 'Main');
        }catch (ExpiredException $e){
            return view("errors/Expired");
        }catch (DatabaseException $e){
            return view("errors/DatabaseError");
        }
    }

    public function delete(int $id) {
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