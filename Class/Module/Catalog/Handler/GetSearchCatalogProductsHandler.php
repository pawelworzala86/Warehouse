<?php

namespace App\Module\Catalog\Handler;

use App\Handler;
use App\Module\Catalog\Collection\ProductCollection;
use App\Module\Catalog\Response\GetCatalogProductsResponse;
use App\Module\Catalog\Request\GetSearchCatalogProductsRequest;
use App\Module\Catalog\Response\GetSearchCatalogProductsResponse;
use App\Request\PaginationRequest;
use App\Type\CatalogProduct;
use App\Type\CatalogProducts;
use App\Type\Filter;
use App\Type\FilterKind;
use App\Type\Pagination;
use App\User;

class GetSearchCatalogProductsHandler extends Handler
{
    public function __invoke(GetSearchCatalogProductsRequest $request): GetSearchCatalogProductsResponse
    {
        $pagination = new Pagination;
        $pagination->setLimit(5);
        $pagination->setPage(1);

        $productsCollection = (new ProductCollection)
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
            );
            $productsCollection->next();
        }
        $productsCollection->rewind();

        return (new GetSearchCatalogProductsResponse)
            ->setProducts($productsList);
    }
}