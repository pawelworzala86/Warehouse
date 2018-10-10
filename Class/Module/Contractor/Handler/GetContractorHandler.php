<?php

namespace App\Module\Contractor\Handler;

use App\Handler;
use App\Module\Contractor\Model\AddressModel;
use App\Module\Contractor\Model\ContractorContactModel;
use App\Module\Contractor\Request\GetContractorRequest;
use App\Module\Contractor\Model\ContractorModel;
use App\Module\Contractor\Response\GetContractorResponse;
use App\Container\Address;
use App\Container\Contact;

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
            ->setNip($contractor->getNip())
            ->setSupplier($contractor->getSupplier());
    }
}