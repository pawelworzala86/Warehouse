<?php

namespace App\Module\Production\Handler;

use App\Handler;
use App\Module\Production\Collection\ProductionCollection;
use App\Module\Production\Model\ProductionModel;
use App\Module\Production\Request\GetProductionRequest;
use App\Module\Production\Response\GetProductionResponse;
use App\Type\Filter;
use App\Type\FilterKind;
use App\Type\Production;
use App\Type\Productions;
use App\User;

class GetProductionHandler extends Handler
{
    public function __invoke(GetProductionRequest $request): GetProductionResponse
    {
        $productionModel = (new ProductionModel)
            ->load($request->getId(), true);

        return (new GetProductionResponse)
            ->setId($productionModel->getUuid())
            ->setName($productionModel->getName());
    }
}