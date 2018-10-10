<?php

namespace App\Type;

use App\Type;

class UUID extends Type
{
    private $uuid;

    function setUuid(string $uuid): UUID
    {
        if(strlen($uuid)!==32){
            throw new \Exception('UUID must have 32 characters lenght!');
        }
        $this->uuid = $uuid;
        return $this;
    }

    function getUuid(): string
    {
        return $this->uuid;
    }

}