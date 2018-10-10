<?php

namespace App\Module\Contractor\Handler;

use App\Handler;
use App\Module\Contractor\Response\GetContractorsResponse;
use App\Module\Contractor\Collection\ContractorCollection;
use App\Request\PaginationRequest;
use App\Container\Contractor;
use App\Container\Contractors;
use App\Container\Filter;
use App\Type\FilterKind;
use App\User;

class GetContractorsHandler extends Handler
{
    public function __invoke(PaginationRequest $request): GetContractorsResponse
    {
        $contractors = (new ContractorCollection)
            ->setPagination($request->getPagination())
            ->setFilters($request->getFilters())
            ->where(new Filter([
                'name' => 'added_by',
                'kind' => new FilterKind('='),
                'value' => User::getId(),
            ]))
            ->where(new Filter([
                'name' => 'deleted',
                'kind' => new FilterKind('='),
                'value' => 0,
            ]))
            ->load();

        $docs = new Contractors;
        $docs->rewind();
        $contractors->rewind();
        while($contractor = $contractors->current()){
            $docs->add(
                (new Contractor)
                    ->setId($contractor->getUuid())
                    ->setName($contractor->getName())
                    ->setCode($contractor->getCode())
            );
            $contractors->next();
        }

        return (new GetContractorsResponse)
            ->setContractors($docs)
            ->setPagination($contractors->getPagination())
            ->setFilters($contractors->getFilters())
            ->setFiltersNames($contractors->getFiltersNames());
    }
}