<?php

namespace App\Module\Contractor\Handler;

use App\Common;
use App\Handler;
use App\Module\Catalog\Model\FileModel;
use App\Module\Catalog\Model\ProductFilesModel;
use App\Module\Catalog\Model\ProductModel;
use App\Module\Catalog\Request\CreateCatalogProductRequest;
use App\Module\Contractor\Request\CreateContractorRequest;
use App\Module\Contractor\Request\UpdateContractorRequest;
use App\Module\Catalog\Response\CreateCatalogProductResponse;
use App\Module\Contractor\Model\ContractorModel;
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

class UpdateContractorHandler extends Handler
{
    public function __invoke(UpdateContractorRequest $request): SuccessResponse
    {
        $Contractor = (new ContractorModel)
            ->load($request->getId(), true);

        (new ContractorModel)
            ->setId($Contractor->getId())
            ->setUuid($Contractor->getUuid())
            ->setName($request->getName())
            ->update();

        return (new SuccessResponse);
    }
}