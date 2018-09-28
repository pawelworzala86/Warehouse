<?php

namespace App\Module\Catalog\Handler;

use App\Common;
use App\Handler;
use App\Module\Catalog\Model\ProductModel;
use App\Module\Catalog\Request\CreateCatalogProductRequest;
use App\Module\Catalog\Response\CreateCatalogProductResponse;

class CreateCatalogProductHandler extends Handler
{
    public function __invoke(CreateCatalogProductRequest $request): CreateCatalogProductResponse
    {
        $uuid = Common::getUuid();
        (new ProductModel)
            ->setUuid($uuid)
            ->setSku($request->getSku())
            ->setName($request->getName())
            ->setDescriptionShort($request->getDescriptionShort())
            ->setDescriptionFull($request->getDescriptionFull())
            ->insert();
        return (new CreateCatalogProductResponse)
            ->setId($uuid);
    }
}