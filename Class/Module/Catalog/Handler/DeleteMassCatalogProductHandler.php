<?php

namespace App\Module\Catalog\Handler;

use App\Handler;
use App\Module\Catalog\Model\ProductModel;
use App\Request\UuidCollectionRequest;
use App\Response\SuccessResponse;
use App\Type\UUID;

class DeleteMassCatalogProductHandler extends Handler
{

    public function __invoke(UuidCollectionRequest $request): SuccessResponse
    {
        $ids = $request->getIds();
        $ids->rewind();
        while($uuid = $ids->current()){
            $productModel = new ProductModel;
            $productModel->setUuid(new UUID($uuid));
            $productModel->delete();
            $ids->next();
        }
        return new SuccessResponse;
    }

}