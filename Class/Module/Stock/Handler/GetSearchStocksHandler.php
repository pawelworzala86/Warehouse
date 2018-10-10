<?php

namespace App\Module\Stock\Handler;

use App\Handler;
use App\Module\Stock\Request\GetSearchStocksRequest;
use App\Module\Stock\Response\GetSearchStocksResponse;
use App\Module\Stock\Collection\StockViewCollection;
use App\Container\CatalogProduct;
use App\Container\CatalogProducts;
use App\Container\Filter;
use App\Type\FilterKind;
use App\Container\Pagination;
use App\User;

class GetSearchStocksHandler extends Handler
{
    public function __invoke(GetSearchStocksRequest $request): GetSearchStocksResponse
    {
        $pagination = new Pagination;
        $pagination->setLimit(5);
        $pagination->setPage(1);

        $productsCollection = (new StockViewCollection)
            ->setPagination($pagination)
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
            ->where(new Filter([
                'name' => 'name',
                'kind' => new FilterKind('%'),
                'value' => $request->getSearch(),
            ]))
            ->load();

        $productsList = new CatalogProducts;

        while ($product = $productsCollection->current()) {
            $productsList->add(
                (new CatalogProduct)
                    ->setName($product->getName())
                    ->setId($product->getUuid())
                    ->setSku($product->getSku())
                    ->setNet($product->getNet())
                    ->setVat($product->getVat())
                    ->setCount($product->getCount())
            );
            $productsCollection->next();
        }
        $productsCollection->rewind();

        return (new GetSearchStocksResponse)
            ->setStocks($productsList);
    }
}