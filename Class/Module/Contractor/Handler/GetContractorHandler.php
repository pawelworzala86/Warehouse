<?php

namespace App\Module\Contractor\Handler;

use App\Common;
use App\Handler;
use App\Module\Catalog\Model\FileModel;
use App\Module\Catalog\Model\ProductFilesModel;
use App\Module\Catalog\Model\ProductModel;
use App\Module\Catalog\Request\CreateCatalogProductRequest;
use App\Module\Contractor\Model\AddressModel;
use App\Module\Contractor\Model\ContractorContactModel;
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
use App\Type\Contact;
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

        $addressModel = new AddressModel;
        if($contractor->getAddressId()) {
            $addressModel
                ->load($contractor->getAddressId());
        }
        $address = null;
        if($addressModel->isLoaded()) {
            $address = (new Address)
                ->setId($addressModel->getUuid())
                ->setName($addressModel->getName())
                ->setFirstName($addressModel->getFirstName())
                ->setLastName($addressModel->getLastName())
                ->setStreet($addressModel->getStreet())
                ->setCity($addressModel->getCity())
                ->setPostcode($addressModel->getPostcode());
        }

        $contactModel = (new ContractorContactModel)
            ->load($contractor->getContactId());
        $contact = null;
        if($contractor->getContactId()) {
            $contact = (new Contact)
                ->setPhone($contactModel->getPhone())
                ->setFax($contactModel->getFax())
                ->setMail($contactModel->getMail())
                ->setWww($contactModel->getWww())
                ->setId($contactModel->getUuid());
        }

        return (new GetContractorResponse)
            ->setId($contractor->getUuid())
            ->setCode($contractor->getCode())
            ->setName($contractor->getName())
            ->setAddress($address)
            ->setContact($contact)
            ->setNip($contractor->getNip());
    }
}