<?php

namespace App\Module\Cash\Handler;

use App\Handler;
use App\Module\Cash\Collection\CashViewCollection;
use App\Module\Cash\Model\CashViewModel;
use App\Module\Cash\Response\GetCashsResponse;
use App\Module\Cash\Collection\CashDocumentViewCollection;
use App\Request\PaginationRequest;
use App\Type\Cash;
use App\Type\Cashs;
use App\Type\Filter;
use App\Type\FilterKind;
use App\User;

class GetCashsHandler extends Handler
{
    public function __invoke(PaginationRequest $request): GetCashsResponse
    {
        $cashsCollection = (new CashDocumentViewCollection)
            ->setPagination($request->getPagination())
            ->setFilters($request->getFilters())
            ->where(
                (new Filter)
                    ->setName('added_by')
                    ->setKind(new FilterKind('='))
                    ->setValue(User::getId())
            )->load();

        $cashs = new Cashs;

        $cashsCollection->rewind();
        while ($cash = $cashsCollection->current()) {
            $cashs->add(
                (new Cash)
                    ->setId($cash->getUuid())
                    ->setNumber($cash->getNumber())
                    ->setAmount($cash->getAmount())
                    ->setKind($cash->getKind())
                    ->setDate($cash->getDate())
                    ->setHour($cash->getHour())
                    ->setDocumentNumber($cash->getDocumentNumber())
                    ->setDocumentId($cash->getDocumentID())
            );
            $cashsCollection->next();
        }

        $cashBallance = (new CashViewModel)
            ->where(
                (new Filter)
                    ->setName('added_by')
                    ->setKind(new FilterKind('='))
                    ->setValue(User::getId())
            )->order('added_by asc')
            ->load();

        return (new GetCashsResponse)
            ->setCashs($cashs)
            ->setSum(($ballance=$cashBallance->getBallance())?$ballance:0)
            ->setPagination($cashsCollection->getPagination())
            ->setFilters($cashsCollection->getFilters());
    }
}