<?php

namespace App\Module\Cash\Handler;

use App\Handler;
use App\Module\Cash\Model\CashDocumentModel;
use App\Module\Cash\Request\GetCashRequest;
use App\Module\Cash\Response\GetCashResponse;
use App\Module\Cash\Response\GetCashsResponse;
use App\Module\Cash\Collection\CashDocumentViewCollection;
use App\Request\PaginationRequest;
use App\Type\Cash;
use App\Type\Cashs;
use App\Type\Filter;
use App\Type\FilterKind;
use App\User;

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