<?php

namespace App\Module\Stock\Response;

use App\Response\Response;
use App\Traits\FiltersTrait;
use App\Traits\PaginationResponseTrait;
use App\Container\Stock;
use App\Container\Stocks;

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