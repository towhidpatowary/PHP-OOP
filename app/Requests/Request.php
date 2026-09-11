<?php
namespace App\Requests;

use App\Exceptions\ExpiredException;
use App\Exceptions\ValidationException;

class Request {
    protected readonly array $query;
    protected readonly array $body;
    protected ?array $errors = null;
    public function __construct()
    {
        $this->query = $_GET;
        $this->body = $_POST;
    }
    public function query(string $key, mixed $defaultValue = null): mixed
    {
        return $this->query[$key] ?? $defaultValue;
    }
    public function input(string $key, mixed $defaultValue = null): mixed
    {
        return $this->body[$key] ?? $defaultValue;
    }
    public function validate(array $rules)
    {
        $validated = [];

        if (!isset($this->body['csrf_token']) || trim($this->body['csrf_token']) === '' || $_SESSION['CSRF_TOKEN'] !== $this->body['csrf_token']) {
            throw new ExpiredException();
        }

        foreach ($rules as $field => $rule) {
            if (in_array('required', $rule) && (!isset($this->body[$field]) || empty($this->body[$field]))) {
                $this->errors[$field] = "The name {$field} is required.";
            }

            $validated[$field] = $this->body[$field];
        }

        if ($this->errors !== null) {
            throw new ValidationException($this->errors);
        }

        return $validated;
    }
}

?>