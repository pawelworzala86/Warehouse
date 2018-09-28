<?php

namespace App\Type;

use App\Type;

class SESSID extends Type
{
    private $sessid;

    function setSessid(string $sessid): SESSID
    {
        $this->sessid = $sessid;
        return $this;
    }

    function getSessid(): string
    {
        return $this->sessid;
    }

}