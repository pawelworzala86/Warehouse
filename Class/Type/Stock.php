<?php

namespace App\Type;

use App\Type;

class Stock extends Type
{
    private $id;
    private $count;
    private $sku;
    private $name;

    function setName(string $name = null): Stock
    {
        $this->name = $name;
        return $this;
    }

    function getName(): ?string
    {
        return $this->name;
    }

    function setSku(SKU $sku = null): Stock
    {
        $this->sku = $sku;
        return $this;
    }

    function getSku(): ?SKU
    {
        return $this->sku;
    }

    function setCount(float $count = null): Stock
    {
        $this->count = $count;
        return $this;
    }

    function getCount(): ?float
    {
        return $this->count;
    }

    function setId(UUID $id): Stock
    {
        $this->id = $id;
        return $this;
    }

    function getId(): UUID
    {
        return $this->id;
    }
}