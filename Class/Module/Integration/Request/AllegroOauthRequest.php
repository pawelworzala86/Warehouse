<?php

namespace App\Module\Integration\Request;

use App\Request\UserRequest;

class AllegroOauthRequest extends UserRequest
{
    private $code;

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code)
    {
        $this->code = $code;
        return $this;
    }
}