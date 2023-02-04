<?php

namespace App\Exception;

use Codeception\Util\HttpCode;

class UnauthorizedException extends AppException
{

    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, HttpCode::UNAUTHORIZED, $previous);
    }

}