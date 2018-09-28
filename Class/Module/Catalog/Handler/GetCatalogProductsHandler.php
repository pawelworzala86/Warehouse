<?php

namespace App\Module\Catalog\Handler;

use App\Handler;
use App\Module\Catalog\Collection\ProductCollection;
use App\Module\Catalog\Response\GetCatalogProductsResponse;
use App\Request\PaginationRequest;
use App\Type\CatalogProduct;
use App\Type\CatalogProducts;
use App\Type\Filter;
use App\Type\FilterKind;
use App\User;

class GetCatalogProductsHandler extends Handler
{
    public function __invoke(PaginationRequest $request): GetCatalogProductsResponse
    {
        //print_r([$request->getFilters()]);
        $productsCollection = (new ProductCollection)
            ->setPagination($request->getPagination())
            ->setFilters($request->getFilters())
            ->where(new Filter([
                'name' => 'added_by',
                'kind' => new FilterKind('='),
                'value' => User::getId(),
            ]))
            ->where(new Filter([
                'name' => 'deleted',
                'kind' => new FilterKind('null'),
                'value' => null,
            ]))
            ->load();

        $productsList = new CatalogProducts;

        while ($product = $productsCollection->current()) {
            $productsList->add(
                (new CatalogProduct)
                    ->setName($product->getName())
                    ->setId($product->getUuid())
                    ->setSku($product->getSku())
            );
            $productsCollection->next();
        }
        $productsCollection->rewind();

        return (new GetCatalogProductsResponse)
            ->setProducts($productsList)
            ->setPagination($productsCollection->getPagination())
            ->setFilters($productsCollection->getFilters())
            ->setFiltersNames($productsCollection->getFiltersNames());
    }
}