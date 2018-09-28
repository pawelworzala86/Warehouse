<?php

namespace App\Module\Catalog\Handler;

use App\Handler;
use App\Module\Catalog\Model\ProductModel;
use App\Request\UuidCollectionRequest;
use App\Response\SuccessResponse;

class DeleteMassCatalogProductHandler extends Handler
{

    public function __invoke(UuidCollectionRequest $request): SuccessResponse
    {
        $ids = $request->getIds();
        while($uuid = $ids->current()){
            $productModel = new ProductModel;
            $productModel->load($uuid, true);
            $productModel->delete();
            $ids->next();
        }
        return new SuccessResponse;
    }

}