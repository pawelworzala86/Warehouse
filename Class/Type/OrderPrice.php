<?php

namespace App\Type;

use App\Type;

class OrderPrice extends Type
{
    private $service;
    private $price;

    public function getService(): ?string
    {
        return $this->service;
    }

    public function setService(string $service = null): OrderPrice
    {
        $this->service = $service;
        return $this;
    }

    function setPrice(float $price = null): OrderPrice
    {
        $this->price = $price;
        return $this;
    }

    function getPrice(): ?float
    {
        return $this->price;
    }
}