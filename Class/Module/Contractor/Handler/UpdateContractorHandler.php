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
        $contractor = (new ContractorModel)
            ->load($request->getId(), true);
        
        $address = $request->getAddress();
        $addressId = null;
        
        if($address) {
            $oldAddress =  (new AddressModel)
                ->load($contractor->getAddressId());
            $changed = false;
            if($oldAddress->getName()!==$address->getName()) $changed = true;
            if($oldAddress->getFirstName()!==$address->getFirstName()) $changed = true;
            if($oldAddress->getLastName()!==$address->getLastName()) $changed = true;
            if($oldAddress->getStreet()!==$address->getStreet()) $changed = true;
            if($oldAddress->getPostcode()!==$address->getPostcode()) $changed = true;
            if($oldAddress->getCity()!==$address->getCity()) $changed = true;
            
            if($changed) {
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
        }

        (new ContractorModel)
            ->setId($contractor->getId())
            ->setUuid($contractor->getUuid())
            ->setName($request->getName())
            ->setAddressId($addressId)
            ->setCode($request->getCode())
            ->update();

        return (new SuccessResponse);
    }
}