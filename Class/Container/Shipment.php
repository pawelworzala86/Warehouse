<?php

namespace App\Container;

use App\Type;

class Shipment extends Type
{
    private $id;
    private $name;

    function setName(string $name): Shipment
    {
        $this->name = $name;
        return $this;
    }

    function getName(): string
    {
        return $this->name;
    }

    function setId(string $id): Shipment
    {
        $this->id = $id;
        return $this;
    }

    function getId(): string
    {
        return $this->id;
    }
}