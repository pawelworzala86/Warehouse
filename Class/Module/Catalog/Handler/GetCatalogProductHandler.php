<?php

namespace App\Module\Catalog\Handler;

use App\Handler;
use App\Module\Catalog\Collection\ProductCollection;
use App\Module\Catalog\Model\ProductModel;
use App\Module\Catalog\Request\GetCatalogProductRequest;
use App\Module\Catalog\Response\GetCatalogProductResponse;
use App\Module\Catalog\Response\GetDocumentsResponse;
use App\Request\EmptyRequest;
use App\Type\CatalogCategory;
use App\Type\CatalogProduct;
use App\Type\CatalogProducts;
use App\User;

class GetCatalogProductHandler extends Handler
{
    public function __invoke(GetCatalogProductRequest $request): GetCatalogProductResponse
    {
        $productModel = new ProductModel;
        $productModel->load($request->getId(), true);

        return (new GetCatalogProductResponse)
            ->setId($productModel->getUuid())
            ->setName($productModel->getName())
            ->setSku($productModel->getSku())
            ->setDescriptionShort($productModel->getDescriptionShort())
            ->setDescriptionFull($productModel->getDescriptionFull())
            ->setPartial($productModel->getPartial())
            ->setToSell($productModel->getToSell())
            ->setSellNet($productModel->getSellNet())
            ->setSellGross($productModel->getSellGross())
            ->setVat($productModel->getVat());
    }
}