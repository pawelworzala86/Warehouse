<?php

namespace App\Module\Stock\Response;

use App\Response\Response;
use App\Traits\FiltersTrait;
use App\Type\CatalogProduct;
use App\Type\CatalogProducts;
use App\Traits\PaginationResponseTrait;
use App\Type\Document;
use App\Type\Documents;
use App\Type\SKU;
use App\Type\Stock;
use App\Type\Stocks;
use App\Type\UUID;

class GetStockResponse extends Response
{
    private $id;
    private $count;
    private $sku;
    private $name;

    function setName(string $name = null): GetStockResponse
    {
        $this->name = $name;
        return $this;
    }

    function getName(): ?string
    {
        return $this->name;
    }

    function setSku(SKU $sku = null): GetStockResponse
    {
        $this->sku = $sku;
        return $this;
    }

    function getSku(): ?SKU
    {
        return $this->sku;
    }

    function setCount(float $count = null): GetStockResponse
    {
        $this->count = $count;
        return $this;
    }

    function getCount(): ?float
    {
        return $this->count;
    }

    function setId(UUID $id): GetStockResponse
    {
        $this->id = $id;
        return $this;
    }

    function getId(): UUID
    {
        return $this->id;
    }
}