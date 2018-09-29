<?php

namespace App\Type;

use App\Type;

class Contractor extends Type
{
    private $name;
    private $id;

    function setId(UUID $id): Contractor
    {
        $this->id = $id;
        return $this;
    }

    function getId(): UUID
    {
        return $this->id;
    }

    function setName(string $name): Contractor
    {
        $this->name = $name;
        return $this;
    }

    function getName(): string
    {
        return $this->name;
    }
}