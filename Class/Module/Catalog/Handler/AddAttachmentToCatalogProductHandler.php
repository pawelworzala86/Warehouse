<?php

namespace App\Module\Catalog\Handler;

use App\Common;
use App\Handler;
use App\Module\Catalog\Model\FileModel;
use App\Module\Catalog\Model\ProductAttachmentModel;
use App\Module\Catalog\Model\ProductModel;
use App\Module\Catalog\Request\AddAttachmentToCatalogProductRequest;
use App\Response\SuccessResponse;

class AddAttachmentToCatalogProductHandler extends Handler
{
    public function __invoke(AddAttachmentToCatalogProductRequest $request): SuccessResponse
    {
        $productModel = new ProductModel;
        $productModel->load($request->getId(), true);

        $fileModel = new FileModel;
        $fileModel->load($request->getFileId(), true);

        $productsFilesModel = new ProductAttachmentModel;
        $productsFilesModel->setUuid(Common::getUuid());
        $productsFilesModel->setProductId($productModel->getId());
        $productsFilesModel->setFileId($fileModel->getId());
        $productsFilesModel->insert();

        return new SuccessResponse;
    }
}