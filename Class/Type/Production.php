<?php

namespace App\Type;

use App\Common;
use App\DB;
use App\IP;
use App\Type;
use App\User;

class Production extends Type
{
    private $id;
    private $name;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Production
    {
        $this->name = $name;
        return $this;
    }

    function setId(UUID $id): Production
    {
        $this->id = $id;
        return $this;
    }

    function getId(): UUID
    {
        return $this->id;
    }
}