<?php

namespace App\Module\Production\Handler;

use App\Handler;
use App\Module\Production\Collection\ProductionCollection;
use App\Module\Production\Collection\ProductionViewCollection;
use App\Module\Production\Response\GetProductionsResponse;
use App\Request\PaginationRequest;
use App\Type\Filter;
use App\Type\FilterKind;
use App\Type\Production;
use App\Type\Productions;
use App\User;

class GetProductionsHandler extends Handler
{
    public function __invoke(PaginationRequest $request): GetProductionsResponse
    {
        $productionsCollection = (new ProductionViewCollection)
            ->setPagination($request->getPagination())
            ->setFilters($request->getFilters())
            ->where(
                (new Filter)
                    ->setName('added_by')
                    ->setKind(new FilterKind('='))
                    ->setValue(User::getId())
            )
            ->load();

        $productions = new Productions;

        $productionsCollection->rewind();
        while ($production = $productionsCollection->current()) {
            $productions->add(
                (new Production())
                    ->setId($production->getUuid())
                    ->setName($production->getName())
                    ->setBuyNet($production->getBuyNet())
                    ->setSellNet($production->getSellNet())
            );
            $productionsCollection->next();
        }

        return (new GetProductionsResponse)
            ->setProductions($productions)
            ->setPagination($productionsCollection->getPagination())
            ->setFilters($productionsCollection->getFilters());
    }
}