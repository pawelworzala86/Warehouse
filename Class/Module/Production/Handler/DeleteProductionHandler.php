<?php

namespace App\Module\Production\Handler;

use App\Handler;
use App\Module\Production\Collection\ProductionCollection;
use App\Module\Production\Model\ProductionModel;
use App\Module\Production\Request\DeleteProductionRequest;
use App\Module\Production\Request\GetProductionRequest;
use App\Module\Production\Response\GetProductionResponse;
use App\Response\SuccessResponse;
use App\Type\Filter;
use App\Type\FilterKind;
use App\Type\Production;
use App\Type\Productions;
use App\User;

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