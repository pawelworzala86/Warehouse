<?php

namespace App\Module\Stock\Response;

use App\Response\Response;
use App\Container\CatalogProduct;
use App\Container\CatalogProducts;

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