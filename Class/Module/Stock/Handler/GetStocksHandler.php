<?php

namespace App\Module\Stock\Handler;

use App\Handler;
use App\Module\Stock\Response\GetStocksResponse;
use App\Module\Stock\Collection\StockViewCollection;
use App\Request\PaginationRequest;
use App\Container\Documents;
use App\Container\Filter;
use App\Type\FilterKind;
use App\Container\Stock;
use App\Container\Stocks;
use App\User;

class GetStocksHandler extends Handler
{
    public function __invoke(PaginationRequest $request): GetStocksResponse
    {
        $stocks = (new StockViewCollection)
            ->setPagination($request->getPagination())
            ->setFilters($request->getFilters())
            ->where(new Filter([
                'name' => 'added_by',
                'kind' => new FilterKind('='),
                'value' => User::getId(),
            ]))
            ->where(new Filter([
                'name' => 'deleted',
                'kind' => new FilterKind('='),
                'value' => 0,
            ]))
            ->load();

        $docs = new Documents;
        $sts = new Stocks;
        $stocks->rewind();
        while($stock = $stocks->current()){
            $sts->add(
                (new Stock)
                    ->setId($stock->getUuid())
                    ->setCount($stock->getCount())
                    ->setSku($stock->getSku())
                    ->setName($stock->getName())
            );
            $stocks->next();
        }

        return (new GetStocksResponse)
            ->setStocks($sts)
            ->setPagination($stocks->getPagination())
            ->setFilters($stocks->getFilters());
    }
}