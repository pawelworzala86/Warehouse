<?php

namespace App\Module\Stock\Response;

use App\Response\Response;
use App\Traits\FiltersTrait;
use App\Type\CatalogProduct;
use App\Type\CatalogProducts;
use App\Traits\PaginationResponseTrait;
use App\Type\Document;
use App\Type\Documents;
use App\Type\Stock;
use App\Type\Stocks;

class GetStocksResponse extends Response
{
    public $fieldClass = Stock::class;

    use PaginationResponseTrait;
    use FiltersTrait;

    public $stocks;

    function setStocks(Stocks $stocks): GetStocksResponse
    {
        $this->stocks = $stocks;
        return $this;
    }

    function getStocks(): Stocks
    {
        return $this->stocks;
    }
}