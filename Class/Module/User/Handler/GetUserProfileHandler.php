<?php

namespace App\Module\User\Handler;

use App\Handler;
use App\Module\Contractor\Model\AddressModel;
use App\Module\Contractor\Model\ContractorContactModel;
use App\Module\User\Model\UserModel;
use App\Module\User\Response\GetUserProfileResponse;
use App\Request\EmptyRequest;
use App\Container\Address;
use App\Container\Contact;
use App\Container\ProfileInvoice;
use App\User;

class GetUserProfileHandler extends Handler
{

    public function __invoke(EmptyRequest $request): GetUserProfileResponse
    {
        $userModel = (new UserModel)
            ->load(User::getId());

        $address = null;
        if ($userModel->getAddressId()) {
            $addressModel = (new AddressModel)
                ->load($userModel->getAddressId());
            if ($addressModel->isLoaded()) {
                $address = (new Address)
                    ->setId($addressModel->getUuid())
                    ->setName($addressModel->getName())
                    ->setFirstName($addressModel->getFirstName())
                    ->setLastName($addressModel->getLastName())
                    ->setStreet($addressModel->getStreet())
                    ->setPostcode($addressModel->getPostcode())
                    ->setCity($addressModel->getCity());
            }
        }

        $contact = null;
        if ($userModel->getContactId()) {
            $contactModel = (new ContractorContactModel)
                ->load($userModel->getContactId());
            if ($contactModel->isLoaded()) {
                $contact = (new Contact)
                    ->setId($contactModel->getUuid())
                    ->setPhone($contactModel->getPhone())
                    ->setFax($contactModel->getFax())
                    ->setMail($contactModel->getMail())
                    ->setWww($contactModel->getWww());
            }
        }

        $invoice = null;
        $userModel = (new UserModel)
            ->load(User::getId());
        if ($userModel->getId()) {
            $invoice = (new ProfileInvoice)
                ->setBankName($userModel->getBankName())
                ->setBankSwift($userModel->getBankSwift())
                ->setBankNumber($userModel->getBankNumber())
                ->setIssuePlace($userModel->getIssuePlace());
        }

        return (new GetUserProfileResponse)
            ->setAddress($address)
            ->setContact($contact)
            ->setInvoice($invoice);
    }

}