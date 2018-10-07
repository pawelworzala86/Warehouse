<?php

namespace App\Module\Cash\Handler;

use App\Common;
use App\Handler;
use App\Module\Cash\Model\CashDocumentModel;
use App\Module\Cash\Request\UpdateCashRequest;
use App\Module\Cash\Response\CreateCashResponse;
use App\Module\Cash\Request\CreateCashRequest;
use App\Response\SuccessResponse;

class UpdateCashHandler extends Handler
{
    public function __invoke(UpdateCashRequest $request): SuccessResponse
    {
        $cashDocumentModel = (new CashDocumentModel)
            ->load($request->getId(), true);

        (new CashDocumentModel)
            ->setUuid($cashDocumentModel->getUuid())
            ->setNumber($request->getNumber())
            ->setKind($request->getKind())
            ->setAmount($request->getAmount())
            ->update();

        return new SuccessResponse;
    }
}