<?php
namespace App\Exceptions;

use Exception;

class ExpiredException extends Exception {
    public function __construct(string $message = "This page is expired!", int $code = 419){
        parent::__construct($message, $code);
    }
}

?>