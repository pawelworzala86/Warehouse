<?php

namespace App\Type;

use App\Type;

class CatalogProduct extends Type
{
    private $id;
    private $name;
    private $sku;
    private $net;
    private $vat;
    private $count;

    function setCount(float $count = null): CatalogProduct
    {
        $this->count = $count;
        return $this;
    }

    function getCount(): ?float
    {
        return $this->count;
    }

    function setVat(float $vat = null): CatalogProduct
    {
        $this->vat = $vat;
        return $this;
    }

    function getVat(): ?float
    {
        return $this->vat;
    }

    function setNet(float $net = null): CatalogProduct
    {
        $this->net = $net;
        return $this;
    }

    function getNet(): ?float
    {
        return $this->net;
    }

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