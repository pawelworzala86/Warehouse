<?php

namespace App\Module\Contractor\Handler;

use App\Common;
use App\Handler;
use App\Module\Catalog\Model\FileModel;
use App\Module\Catalog\Model\ProductFilesModel;
use App\Module\Catalog\Model\ProductModel;
use App\Module\Catalog\Request\CreateCatalogProductRequest;
use App\Module\Contractor\Request\DeleteContractorRequest;
use App\Module\Contractor\Request\GetContractorRequest;
use App\Module\Catalog\Response\CreateCatalogProductResponse;
use App\Module\Contractor\Model\ContractorModel;
use App\Module\Contractor\Response\GetContractorResponse;
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

class DeleteContractorHandler extends Handler
{
    public function __invoke(DeleteContractorRequest $request): SuccessResponse
    {
        (new ContractorModel)
            ->setUuid($request->getId())
            ->delete();

        return (new SuccessResponse);
    }
}