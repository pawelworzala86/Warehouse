<?php

namespace App\Module\Production\Handler;

use App\Common;
use App\Handler;
use App\Module\Production\Request\CreateProductionRequest;
use App\Module\Production\Model\ProductionModel;
use App\Module\Production\Request\UpdateProductionRequest;
use App\Module\Production\Response\CreateProductionResponse;
use App\Response\SuccessResponse;

class UpdateProductionHandler extends Handler
{
    public function __invoke(UpdateProductionRequest $request): SuccessResponse
    {
        $productionModel = (new ProductionModel)
            ->load($request->getId(), true);
        (new ProductionModel)
            ->setUuid($productionModel->getUuid())
            ->setName($request->getName())
            ->update();

        return new SuccessResponse;
    }
}