<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class AccountNotActivatedException extends Exception
{
    protected $code = Response::HTTP_FORBIDDEN;
}
