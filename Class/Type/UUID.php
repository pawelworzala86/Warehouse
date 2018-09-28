<?php

namespace App\Type;

use App\Type;

class UUID extends Type
{
    private $uuid;

    function setUuid(string $uuid): UUID
    {
        $this->uuid = $uuid;
        return $this;
    }

    function getUuid(): string
    {
        return $this->uuid;
    }

}