<?php

namespace App\Module\Contractor\Handler;

use App\Common;
use App\Handler;
use App\Module\Catalog\Model\FileModel;
use App\Module\Catalog\Model\ProductFilesModel;
use App\Module\Catalog\Model\ProductModel;
use App\Module\Catalog\Request\CreateCatalogProductRequest;
use App\Module\Catalog\Response\CreateCatalogProductResponse;
use App\Module\Contractor\Request\GetSearchContractorsRequest;
use App\Module\Contractor\Response\GetContractorsResponse;
use App\Module\Contractor\Collection\ContractorCollection;
use App\Module\Contractor\Response\GetSearchContractorsResponse;
use App\Request\EmptyRequest;
use App\Request\PaginationRequest;
use App\Response\SuccessResponse;
use App\Type\Contractor;
use App\Type\Contractors;
use App\Type\Filter;
use App\Type\FilterKind;
use App\Type\Filters;
use App\Type\Pagination;
use App\User;

class GetSearchContractorsHandler extends Handler
{
    public function __invoke(GetSearchContractorsRequest $request): GetSearchContractorsResponse
    {
        $pagination = new Pagination;
        $pagination->setLimit(5);
        $pagination->setPage(1);

        $contractors = (new ContractorCollection)
            ->setPagination($pagination)
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
            ->where(new Filter([
                'name' => 'name',
                'kind' => new FilterKind('%'),
                'value' => $request->getSearch(),
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
            );
            $contractors->next();
        }

        return (new GetSearchContractorsResponse)
            ->setContractors($docs);
    }
}