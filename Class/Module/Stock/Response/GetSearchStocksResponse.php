<?php

namespace App\Module\Stock\Response;

use App\Response\Response;
use App\Traits\FiltersTrait;
use App\Type\CatalogProduct;
use App\Type\CatalogProducts;
use App\Traits\PaginationResponseTrait;
use App\Type\Contractor;
use App\Type\Contractors;
use App\Type\UUID;

class GetSearchStocksResponse extends Response
{
    public $fieldClass = CatalogProduct::class;

    public $stocks;

    function setStocks(CatalogProducts $stocks): GetSearchStocksResponse
    {
        $this->stocks = $stocks;
        return $this;
    }

    function getStocks(): CatalogProducts
    {
        return $this->stocks;
    }
}