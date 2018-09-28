<?php

namespace App\Type;

use App\Type;

class Password extends Type
{
    private $password;

    function setPassword(string $password): Password
    {
        $this->password = $password;
        return $this;
    }

    function getPassword(): string
    {
        return $this->password;
    }

}