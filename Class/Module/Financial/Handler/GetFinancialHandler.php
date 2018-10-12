<?php

namespace App\Module\Financial\Handler;

use App\Handler;
use App\Module\Financial\Model\FinancialModel;
use App\Module\Financial\Request\GetFinancialRequest;
use App\Module\Financial\Response\GetFinancialResponse;

class GetFinancialHandler extends Handler
{
    public function __invoke(GetFinancialRequest $request): GetFinancialResponse
    {
        $financial = (new FinancialModel)
            ->load($request->getId(), true);

        return (new GetFinancialResponse)
            ->setId($financial->getUuid())
            ->setDate($financial->getDate())
            ->setAmount($financial->getAmount());
    }
}