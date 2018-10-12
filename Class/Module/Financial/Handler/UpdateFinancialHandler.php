<?php

namespace App\Module\Financial\Handler;

use App\Common;
use App\Handler;
use App\Module\Financial\Model\FinancialModel;
use App\Module\Financial\Request\CreateFinancialRequest;
use App\Module\Financial\Request\UpdateFinancialRequest;
use App\Module\Financial\Response\CreateFinancialResponse;
use App\Response\SuccessResponse;

class UpdateFinancialHandler extends Handler
{
    public function __invoke(UpdateFinancialRequest $request): SuccessResponse
    {
        (new FinancialModel)
            ->setUuid($request->getId())
            ->setDate($request->getDate())
            ->setAmount($request->getAmount())
            ->update();

        return new SuccessResponse;
    }
}