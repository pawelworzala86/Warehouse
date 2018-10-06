<?php

namespace App\Module\Catalog\Handler;

use App\Handler;
use App\Module\Catalog\Collection\ProductCollection;
use App\Module\Catalog\Model\FileModel;
use App\Module\Catalog\Model\ProductFilesModel;
use App\Module\Catalog\Response\GetCatalogProductsResponse;
use App\Request\PaginationRequest;
use App\Type\CatalogProduct;
use App\Type\CatalogProducts;
use App\Type\File;
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
                'kind' => new FilterKind('='),
                'value' => 0,
            ]))
            ->load();

        $productsList = new CatalogProducts;

        while ($product = $productsCollection->current()) {
            $productFileModel = (new ProductFilesModel)
                ->where(new Filter([
                    'name' => 'added_by',
                    'kind' => new FilterKind('='),
                    'value' => User::getId(),
                ]))->where(new Filter([
                    'name' => 'deleted',
                    'kind' => new FilterKind('='),
                    'value' => 0,
                ]))->where(new Filter([
                    'name' => 'product_id',
                    'kind' => new FilterKind('='),
                    'value' => $product->getId(),
                ]))
                ->load();
            $fileModel = (new FileModel)
                ->load($productFileModel->getFileId());
            $imageUrl = ($fileModel->getId()&&$fileModel->getSize())?$fileModel->getUrl():null;
            $productsList->add(
                (new CatalogProduct)
                    ->setName($product->getName())
                    ->setId($product->getUuid())
                    ->setSku($product->getSku())
                    ->setImageUrl($imageUrl)
                    ->setDescriptionShort($product->getDescriptionShort())
                    ->setNet($product->getSellNet())
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