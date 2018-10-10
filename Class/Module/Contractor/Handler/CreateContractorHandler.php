<?php

namespace App\Module\Contractor\Handler;

use App\Common;
use App\Handler;
use App\Module\Contractor\Model\AddressModel;
use App\Module\Contractor\Model\ContractorContactModel;
use App\Module\Contractor\Request\CreateContractorRequest;
use App\Module\Contractor\Model\ContractorModel;
use App\Module\Contractor\Response\CreateContractorResponse;

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

        $contractorId = (new ContractorModel)
            ->setUuid($uuid)
            ->setName($request->getName())
            ->setAddressId($addressId)
            ->setCode($request->getCode())
            ->setNip($request->getNip())
            ->setSupplier($request->getSupplier())
            ->insert();

        $contactId = null;
        $contact = $request->getContact();
        if($contact) {
            $contactId = (new ContractorContactModel)
                ->setUuid(Common::getUuid())
                ->setPhone($contact->getPhone())
                ->setFax($contact->getFax())
                ->setMail($contact->getMail())
                ->setWww($contact->getWww())
                ->setContractorId($contractorId)
                ->insert();
        }

        $contractorModel = (new ContractorModel)
            ->load($contractorId);
        $contractorModel
            ->setUuid($contractorModel->getUuid())
            ->setContactId($contactId)
            ->update();

        return (new CreateContractorResponse)
            ->setId($uuid);
    }
}