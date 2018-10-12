<?php

namespace App\Module\Financial\Handler;

use App\Common;
use App\Handler;
use App\Module\Financial\Model\FinancialModel;
use App\Module\Financial\Request\CreateFinancialRequest;
use App\Module\Financial\Request\DeleteFinancialRequest;
use App\Module\Financial\Request\UpdateFinancialRequest;
use App\Module\Financial\Response\CreateFinancialResponse;
use App\Response\SuccessResponse;

class DeleteFinancialHandler extends Handler
{
    public function __invoke(DeleteFinancialRequest $request): SuccessResponse
    {
        (new FinancialModel)
            ->setUuid($request->getId())
            ->delete();

        return new SuccessResponse;
    }
}