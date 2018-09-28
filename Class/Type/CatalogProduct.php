<?php

namespace App\Type;

use App\Type;

class CatalogProduct extends Type
{
    private $id;
    private $name;
    private $sku;

    function setSku(SKU $sku): CatalogProduct
    {
        $this->sku = $sku;
        return $this;
    }

    function getSku(): SKU
    {
        return $this->sku;
    }

    function setId(UUID $id): CatalogProduct
    {
        $this->id = $id;
        return $this;
    }

    function getId(): UUID
    {
        return $this->id;
    }

    function setName(string $name): CatalogProduct
    {
        $this->name = $name;
        return $this;
    }

    function getName(): string
    {
        return $this->name;
    }
}