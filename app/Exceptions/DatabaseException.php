<?php
declare(strict_types=1);

namespace Exceptions;

use Exception;

class DatabaseException extends Exception {
    public function __construct(string $message = "There is an error from Database!", int $code = 500){
        parent::__construct($message, $code);
    }
}

?>