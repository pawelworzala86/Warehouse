<?php

namespace App\Type;

use App\Type;

class EncodedPassword extends Type
{
    private $encodedPassword;

    function setEncodedPassword(string $encodedPassword): EncodedPassword
    {
        $this->encodedPassword = $encodedPassword;
        return $this;
    }

    function getEncodedPassword(): string
    {
        return $this->encodedPassword;
    }

}