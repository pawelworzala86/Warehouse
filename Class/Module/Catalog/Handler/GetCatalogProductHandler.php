<?php

namespace App\Module\Catalog\Handler;

use App\Handler;
use App\Module\Catalog\Model\FileModel;
use App\Module\Catalog\Model\ProductFilesModel;
use App\Module\Catalog\Model\ProductModel;
use App\Module\Catalog\Request\GetCatalogProductRequest;
use App\Module\Catalog\Response\GetCatalogProductResponse;
use App\Container\Filter;
use App\Type\FilterKind;
use App\User;

class GetCatalogProductHandler extends Handler
{
    public function __invoke(GetCatalogProductRequest $request): GetCatalogProductResponse
    {
        $productModel = new ProductModel;
        $productModel->load($request->getId(), true);

        $productFile = (new ProductFilesModel)
            ->where(
                (new Filter)
                ->setName('added_by')
                ->setKind(new FilterKind('='))
                ->setValue(User::getId())
            )->where(
                (new Filter)
                ->setName('deleted')
                ->setKind(new FilterKind('='))
                ->setValue(0)
            )->where(
                (new Filter)
                ->setName('product_id')
                ->setKind(new FilterKind('='))
                ->setValue($productModel->getId())
            )->load();

        $fileModel = (new FileModel)
            ->load($productFile->getFileId());

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
            ->setVat($productModel->getVat())
            ->setImageSrc($fileModel->getUrl());
    }
}