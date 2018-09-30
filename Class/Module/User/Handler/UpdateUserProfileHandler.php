<?php

namespace App\Module\User\Handler;

use App\Common;
use App\Handler;
use App\Module\Contractor\Model\AddressModel;
use App\Module\Contractor\Model\ContractorContactModel;
use App\Module\User\Model\UserModel;
use App\Module\User\Request\UpdateUserProfileRequest;
use App\Module\User\Response\GetUserProfileResponse;
use App\Module\User\Response\UserStatusResponse;
use App\Request\EmptyRequest;
use App\Response\SuccessResponse;
use App\User;

class UpdateUserProfileHandler extends Handler
{

    public function __invoke(UpdateUserProfileRequest $request): SuccessResponse
    {
        $contact = $request->getContact();
        $address = $request->getAddress();

        $userModel = (new UserModel)
            ->load(User::getId());

        //$userModel->setUuid($userModel->getUuid());
        //$userModel->setId($userModel->getId());

        $addressId = $userModel->getAddressId();
        $contactId = $userModel->getContactId();

        if($address) {
            $oldAddress =  (new AddressModel)
                ->load($addressId);
            $changed = false;
            if($oldAddress->getName()!==$address->getName()) $changed = true;
            if($oldAddress->getFirstName()!==$address->getFirstName()) $changed = true;
            if($oldAddress->getLastName()!==$address->getLastName()) $changed = true;
            if($oldAddress->getStreet()!==$address->getStreet()) $changed = true;
            if($oldAddress->getPostcode()!==$address->getPostcode()) $changed = true;
            if($oldAddress->getCity()!==$address->getCity()) $changed = true;

            if($changed) {
                $oldAddress
                    ->setUuid($oldAddress->getUuid())
                    ->delete();
                $addressId = (new AddressModel)
                    ->setUuid(Common::getUuid())
                    ->setName($address->getName())
                    ->setFirstName($address->getFirstName())
                    ->setLastName($address->getLastName())
                    ->setStreet($address->getStreet())
                    ->setPostcode($address->getPostcode())
                    ->setCity($address->getCity())
                    ->insert();
                (new UserModel)
                    ->setId(User::getId())
                    ->setAddressId($addressId)
                    ->update();
            }
        }

        if($contact) {
            $oldAddress =  (new ContractorContactModel)
                ->load($contactId);
            $changed = false;
            if($oldAddress->getPhone()!==$contact->getPhone()) $changed = true;
            if($oldAddress->getFax()!==$contact->getFax()) $changed = true;
            if($oldAddress->getMail()!==$contact->getMail()) $changed = true;
            if($oldAddress->getWww()!==$contact->getWww()) $changed = true;

            if($changed) {
                $oldAddress
                    ->setUuid($oldAddress->getUuid())
                    ->delete();
                $contactId = (new ContractorContactModel)
                    ->setUuid(Common::getUuid())
                    ->setPhone($contact->getPhone())
                    ->setFax($contact->getFax())
                    ->setMail($contact->getMail())
                    ->setWww($contact->getWww())
                    //->setContractorId($contractor->getId())
                    ->insert();
                (new UserModel)
                    ->setId(User::getId())
                    ->setContactId($contactId)
                    ->update();
            }
        }

        return (new SuccessResponse);
    }

}