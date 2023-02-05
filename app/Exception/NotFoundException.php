<?php

namespace App\Exception;

use Throwable;

class NotFoundException extends AppException
{

    public function __construct(string $message = "", ?Throwable $previous = null)
    {
        parent::__construct($message, 404, $previous);
    }

}