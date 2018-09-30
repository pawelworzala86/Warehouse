<?php

namespace App\Module\Catalog\Handler;

use App\Handler;
use App\Module\Catalog\Model\CategoryModel;
use App\Module\Catalog\Model\ProductModel;
use App\Module\Catalog\Request\DeleteCatalogCategoryRequest;
use App\Module\Catalog\Request\DeleteCatalogProductRequest;
use App\Response\SuccessResponse;

class DeleteCatalogProductHandler extends Handler
{

    public function __invoke(DeleteCatalogProductRequest $request): SuccessResponse
    {
        $productModel = new ProductModel;

        $productModel->load($request->getId(), true);
        $productModel->setUuid($productModel->getUuid());

        $productModel->delete();

        return new SuccessResponse;
    }

}