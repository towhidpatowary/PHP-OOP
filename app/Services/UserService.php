<?php
namespace Services;
require_once  __DIR__ . "/../Repositories/UserRepo.php";
use Exceptions\DatabaseException;
use Exceptions\NotFoundException;
use Repositories\UserRepo;
use Requests\UserRequest;

class UserService extends Service {
    public static function getAll(){
        $userRepo = new UserRepo();
        return $userRepo->getAll();
    }
    public static function find(int $id){
        try{
            $userRepo = new UserRepo();
            return $userRepo->findOrFail($id);
        }catch (NotFoundException $e){
            echo $e->getMessage();
        }
    }
    public static function store(UserRequest $request){
        try{
            $userRepo = new UserRepo();
            $userRepo->store($request);
        }catch (DatabaseException $e){
            echo $e->getMessage();
        }

        return true;
    }
    public static function update(int $id, UserRequest $request){
        try{
            $userRepo = new UserRepo();
            $userRepo->update($id, $request);
        }catch (NotFoundException $e){
            echo $e->getMessage();
        }catch (DatabaseException $e){
            echo $e->getMessage();
        }

        return true;
    }
    public static function delete(int $id){
        try{
            $userRepo = new UserRepo();
            return $userRepo->delete($id);
        }catch (NotFoundException $e){
            echo $e->getMessage();
        }
    }
}
?>