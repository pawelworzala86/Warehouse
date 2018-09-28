<?php

namespace App\Module\User\Response;

use App\Response\Response;

class RegisterUserResponse extends Response
{

    private $code;

    function setCode(string $code): RegisterUserResponse
    {
        $this->code = $code;
        return $this;
    }

    function getCode()
    {
        return $this->code;
    }

}