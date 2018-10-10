<?php

namespace App\Container;

use App\Container;
use App\Type\UUID;

class Order extends Container
{
    private $id;
    private $number;

    public function getNumber(): string
    {
        return $this->number;
    }

    public function setNumber(string $number): Order
    {
        $this->number = $number;
        return $this;
    }

    function setId(UUID $id = null): Order
    {
        $this->id = $id;
        return $this;
    }

    function getId(): ?UUID
    {
        return $this->id;
    }
}