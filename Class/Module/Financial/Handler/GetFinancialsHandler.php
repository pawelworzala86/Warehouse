<?php

namespace App\Module\Financial\Handler;

use App\Container\Financial;
use App\Container\Financials;
use App\Handler;
use App\Module\Financial\Response\GetFinancialsResponse;
use App\Module\Financial\Collection\FinancialCollection;
use App\Request\PaginationRequest;
use App\User;

class GetFinancialsHandler extends Handler
{
    public function __invoke(PaginationRequest $request): GetFinancialsResponse
    {
        $financialsCollection = (new FinancialCollection)
            ->setPagination($request->getPagination())
            ->setFilters($request->getFilters())
            ->where('deleted', '=', 0)
            ->where('added_by', '=', User::getId())
            ->load();

        $financials = new Financials;

        while ($financial = $financialsCollection->current()) {
            $financials->add(
                (new Financial)
                    ->setDate($financial->getDate())
                    ->setAmount($financial->getAmount())
                    ->setId($financial->getUuid())
            );
            $financialsCollection->next();
        }

        return (new GetFinancialsResponse)
            ->setPagination($financialsCollection->getPagination())
            ->setFilters($financialsCollection->getFilters())
            ->setFinancials($financials);
    }
}