<?php

namespace App\Module\Stock\Handler;

use App\Common;
use App\Handler;
use App\Module\Catalog\Model\FileModel;
use App\Module\Catalog\Model\ProductFilesModel;
use App\Module\Catalog\Model\ProductModel;
use App\Module\Catalog\Request\CreateCatalogProductRequest;
use App\Module\Catalog\Response\CreateCatalogProductResponse;
use App\Module\Contractor\Model\AddressModel;
use App\Module\Contractor\Model\ContractorModel;
use App\Module\Contractor\Request\GetSearchContractorsRequest;
use App\Module\Stock\Request\GetSearchStocksRequest;
use App\Module\Contractor\Response\GetContractorsResponse;
use App\Module\Contractor\Collection\ContractorCollection;
use App\Module\Contractor\Response\GetSearchContractorsResponse;
use App\Module\Stock\Response\GetSearchStocksResponse;
use App\Module\Stock\Collection\StockViewCollection;
use App\Request\EmptyRequest;
use App\Request\PaginationRequest;
use App\Response\SuccessResponse;
use App\Type\Address;
use App\Type\CatalogProduct;
use App\Type\CatalogProducts;
use App\Type\Contractor;
use App\Type\Contractors;
use App\Type\Filter;
use App\Type\FilterKind;
use App\Type\Filters;
use App\Type\Pagination;
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