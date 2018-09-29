<?php

namespace App\Module\Contractor\Handler;

use App\Common;
use App\Handler;
use App\Module\Catalog\Model\FileModel;
use App\Module\Catalog\Model\ProductFilesModel;
use App\Module\Catalog\Model\ProductModel;
use App\Module\Catalog\Request\CreateCatalogProductRequest;
use App\Module\Contractor\Model\AddressModel;
use App\Module\Contractor\Request\GetContractorRequest;
use App\Module\Catalog\Response\CreateCatalogProductResponse;
use App\Module\Contractor\Model\ContractorModel;
use App\Module\Contractor\Response\GetContractorResponse;
use App\Module\Contractor\Response\GetContractorsResponse;
use App\Module\Contractor\Collection\ContractorCollection;
use App\Request\EmptyRequest;
use App\Request\PaginationRequest;
use App\Response\SuccessResponse;
use App\Type\Address;
use App\Type\Contractor;
use App\Type\Contractors;
use App\Type\Filter;
use App\Type\FilterKind;
use App\User;

class GetContractorHandler extends Handler
{
    public function __invoke(GetContractorRequest $request): GetContractorResponse
    {
        $contractor = (new ContractorModel)
            ->load($request->getId(), true);

        $addressModel = (new AddressModel)
            ->load($contractor->getAddressId());

        $address = (new Address)
            ->setName($addressModel->getName())
            ->setFirstName($addressModel->getFirstName())
            ->setLastName($addressModel->getLastName())
            ->setStreet($addressModel->getStreet())
            ->setCity($addressModel->getCity())
            ->setPostcode($addressModel->getPostcode());

        return (new GetContractorResponse)
            ->setId($contractor->getUuid())
            ->setName($contractor->getName())
            ->setAddress($address);
    }
}