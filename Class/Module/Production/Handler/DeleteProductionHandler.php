<?php

namespace App\Module\Production\Handler;

use App\Handler;
use App\Module\Production\Model\ProductionModel;
use App\Module\Production\Request\DeleteProductionRequest;
use App\Response\SuccessResponse;

class DeleteProductionHandler extends Handler
{
    public function __invoke(DeleteProductionRequest $request): SuccessResponse
    {
        $productionModel = (new ProductionModel)
            ->load($request->getId(), true);

        (new ProductionModel)
            ->setUuid($productionModel->getUuid())
            ->delete();

        return new SuccessResponse;
    }
}