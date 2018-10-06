<?php

namespace App\Module\Production\Handler;

use App\Common;
use App\Handler;
use App\Module\Production\Request\CreateProductionRequest;
use App\Module\Production\Model\ProductionModel;
use App\Module\Production\Response\CreateProductionResponse;

class CreateProductionHandler extends Handler
{
    public function __invoke(CreateProductionRequest $request): CreateProductionResponse
    {
        $uuid = Common::getUuid();
        (new ProductionModel)
            ->setUuid($uuid)
            ->setName($request->getName())
            ->insert();

        return (new CreateProductionResponse)
            ->setId($uuid);
    }
}