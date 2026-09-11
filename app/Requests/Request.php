<?php
namespace App\Requests;

class Request {
    public function __construct(protected readonly array $query, protected readonly array $body){}
    public function query(string $key, mixed $defaultValue = null): mixed
    {
        return $this->query[$key] ?? $defaultValue;
    }
    public function input(string $key, mixed $defaultValue = null): mixed
    {
        return $this->body[$key] ?? $defaultValue;
    }
}

?>