<?php

namespace App\Module\Catalog\Handler;

use App\Common;
use App\Handler;
use App\Module\Catalog\Model\FileModel;
use App\Module\Catalog\Model\ProductFilesModel;
use App\Module\Catalog\Model\ProductModel;
use App\Module\Catalog\Request\AddImageToCatalogProductRequest;
use App\Module\Catalog\Request\CreateCatalogProductRequest;
use App\Module\Catalog\Response\CreateCatalogProductResponse;
use App\Request\EmptyRequest;
use App\Response\SuccessResponse;

class AddImageToCatalogProductHandler extends Handler
{
    public function __invoke(AddImageToCatalogProductRequest $request): SuccessResponse
    {
        $productModel = new ProductModel;
        $productModel->load($request->getId(), true);

        $fileModel = new FileModel;
        $fileModel->load($request->getImageId(), true);

        $productsFilesModel = new ProductFilesModel;
        $productsFilesModel->setUuid(Common::getUuid());
        $productsFilesModel->setProductId($productModel->getId());
        $productsFilesModel->setFileId($fileModel->getId());
        $productsFilesModel->insert();

        return new SuccessResponse;
    }
}