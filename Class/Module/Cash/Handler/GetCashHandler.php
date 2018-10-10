<?php

namespace App\Module\Cash\Handler;

use App\Handler;
use App\Module\Cash\Model\CashDocumentModel;
use App\Module\Cash\Request\GetCashRequest;
use App\Module\Cash\Response\GetCashResponse;

class GetCashHandler extends Handler
{
    public function __invoke(GetCashRequest $request): GetCashResponse
    {
        $cashDocumentModel = (new CashDocumentModel)
            ->load($request->getId(), true);

        return (new GetCashResponse)
            ->setId($cashDocumentModel->getUuid())
            ->setKind($cashDocumentModel->getKind())
            ->setNumber($cashDocumentModel->getNumber())
            ->setAmount($cashDocumentModel->getAmount());
    }
}