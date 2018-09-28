<?php

namespace App\Module\Catalog\Handler;

use App\Common;
use App\Handler;
use App\Module\Catalog\Model\ProductModel;
use App\Module\Catalog\Request\CreateCatalogProductRequest;
use App\Module\Catalog\Request\UpdateCatalogProductRequest;
use App\Module\Catalog\Response\CreateCatalogProductResponse;
use App\Module\Catalog\Response\UpdateCatalogProductResponse;
use App\Response\SuccessResponse;

class UpdateCatalogProductHandler extends Handler
{
    public function __invoke(UpdateCatalogProductRequest $request): SuccessResponse
    {
        (new ProductModel)
            ->setUuid($request->getId())
            ->setSku($request->getSku())
            ->setName($request->getName())
            ->setDescriptionShort($request->getDescriptionShort())
            ->setDescriptionFull($request->getDescriptionFull())
            ->update();
        return new SuccessResponse;
    }
}