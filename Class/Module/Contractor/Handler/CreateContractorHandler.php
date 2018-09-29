<?php

namespace App\Module\Contractor\Handler;

use App\Common;
use App\Handler;
use App\Module\Catalog\Model\FileModel;
use App\Module\Catalog\Model\ProductFilesModel;
use App\Module\Catalog\Model\ProductModel;
use App\Module\Catalog\Request\CreateCatalogProductRequest;
use App\Module\Contractor\Model\AddressModel;
use App\Module\Contractor\Request\CreateContractorRequest;
use App\Module\Catalog\Response\CreateCatalogProductResponse;
use App\Module\Contractor\Model\ContractorModel;
use App\Module\Contractor\Response\CreateContractorResponse;
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

class CreateContractorHandler extends Handler
{
    public function __invoke(CreateContractorRequest $request): CreateContractorResponse
    {
        $uuid = Common::getUuid();

        $address = $request->getAddress();
        $addressId = null;
        if($address) {
            $addressId = (new AddressModel)
                ->setUuid(Common::getUuid())
                ->setName($address->getName())
                ->setFirstName($address->getFirstName())
                ->setLastName($address->getLastName())
                ->setStreet($address->getStreet())
                ->setPostcode($address->getPostcode())
                ->setCity($address->getCity())
                ->insert();
        }

        (new ContractorModel)
            ->setUuid($uuid)
            ->setName($request->getName())
            ->setAddressId($addressId)
            ->insert();

        return (new CreateContractorResponse)
            ->setId($uuid);
    }
}