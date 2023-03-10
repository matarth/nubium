<?php

namespace App\Exception;

use Throwable;

class UnauthorizedException extends AppException
{

    public function __construct(string $message = "", ?Throwable $previous = null)
    {
        parent::__construct($message, 403, $previous);
    }

}