<?php

namespace App\Module\Catalog\Handler;

use App\Handler;
use App\Module\Catalog\Model\FileModel;
use App\Module\Catalog\Model\ProductFilesModel;
use App\Module\Catalog\Model\ProductModel;
use App\Module\Catalog\Request\DeleteImageFromCatalogProductRequest;
use App\Response\SuccessResponse;
use App\Container\Filter;
use App\Type\FilterKind;

class DeleteImageFromCatalogProductHandler extends Handler
{
    public function __invoke(DeleteImageFromCatalogProductRequest $request): SuccessResponse
    {
        $productModel = new ProductModel;
        $productModel->load($request->getId(), true);
        $productId = $productModel->getId();

        $fileModel = new FileModel;
        $fileModel->load($request->getImageId(), true);
        $imageId = $fileModel->getId();

        $productFiles = new ProductFilesModel;

        $productFiles
            ->where(new Filter([
                'name' => 'deleted',
                'kind' => new FilterKind('='),
                'value' => 0,
            ]))
            ->where(new Filter([
                'name' => 'product_id',
                'kind' => new FilterKind('='),
                'value' => $productId,
            ]))
            ->where(new Filter([
                'name' => 'file_id',
                'kind' => new FilterKind('='),
                'value' => $imageId,
            ]))
            ->load();

        $productFiles->setUuid($productFiles->getUuid());
        $productFiles->delete();
        /*$productModel = new ProductModel;
        $productModel->load($request->getId(), true);

        $fileModel = new FileModel;
        $fileModel->load($request->getImageId(), true);

        $productsFilesModel = new ProductFilesModel;
        $productsFilesModel->setUuid(Common::getUuid());
        $productsFilesModel->setProductId($productModel->getId());
        $productsFilesModel->setFileId($fileModel->getId());
        $productsFilesModel->insert();*/

        return new SuccessResponse;
    }
}