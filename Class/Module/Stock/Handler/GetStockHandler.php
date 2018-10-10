<?php

namespace App\Module\Stock\Handler;

use App\Handler;
use App\Module\Stock\Model\StockViewModel;
use App\Module\Stock\Request\GetStockRequest;
use App\Module\Stock\Response\GetStockResponse;

class GetStockHandler extends Handler
{
    public function __invoke(GetStockRequest $request): GetStockResponse
    {
        $uuid = $request->getProductId();

        $stock = (new StockViewModel)
            ->load($uuid, true);

        return (new GetStockResponse)
            ->setId($stock->getUuid())
            ->setSku($stock->getSku())
            ->setName($stock->getName())
            ->setCount($stock->getCount());
    }
}