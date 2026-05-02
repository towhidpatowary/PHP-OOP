<?php
declare(strict_types=1);

namespace Requests;

use Exceptions\ExpiredException;
use Exceptions\ValidationException;

class UserRequest extends Request {
    private array $fields = [];

    private array $errors = [];

    public function __construct(array $request)
    {
       $this->fields = $request;
    }

    public function validate(array $request): void
    {
        if(!isset($request['csrf_token']) || trim($request['csrf_token']) === '' || $_SESSION['CSRF_TOKEN'] !== $request['csrf_token']){
            throw new ExpiredException();
       }

       if(!isset($request['name']) || trim($request['name']) === ''){
            $this->errors['name'] = 'The name field is required.';
       }

        if(!isset($request['phone']) || trim($request['phone']) === ''){
            $this->errors['phone'] = 'The phone field is required.';
       }

       if(count($this->errors) > 0 ){
            throw new ValidationException($this->errors);
       }
    }

    public function __get($name)
    {
        return $this->fields[$name] ?? null;
    }

    public function request(): array {
        return $this->fields;
    }
}

?>