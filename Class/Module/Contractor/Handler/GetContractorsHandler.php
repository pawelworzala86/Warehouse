<?php

namespace App\Module\Contractor\Handler;

use App\Common;
use App\Handler;
use App\Module\Catalog\Model\FileModel;
use App\Module\Catalog\Model\ProductFilesModel;
use App\Module\Catalog\Model\ProductModel;
use App\Module\Catalog\Request\CreateCatalogProductRequest;
use App\Module\Catalog\Response\CreateCatalogProductResponse;
use App\Module\Contractor\Response\GetContractorsResponse;
use App\Module\Contractor\Collection\ContractorCollection;
use App\Request\EmptyRequest;
use App\Request\PaginationRequest;
use App\Response\SuccessResponse;
use App\Type\Contractor;
use App\Type\Contractors;
use App\Type\Filter;
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