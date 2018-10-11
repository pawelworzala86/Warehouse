<?php

namespace App\Module\Demo\Handler;

use App\Common;
use App\DB;
use App\Handler;
use App\LoremIpsum;
use App\Module\Contractor\Model\AddressModel;
use App\Module\Contractor\Model\ContractorContactModel;
use App\Module\Contractor\Model\ContractorModel;
use App\Request\EmptyRequest;
use App\Response\SuccessResponse;

class ContractorHandler extends Handler
{
    private $db;
    private $lorem;

    public function __construct()
    {
        $this->db(DB::get());
        $this->lorem(new LoremIpsum);
    }

    private function lorem($lorem = null)
    {
        if ($lorem) {
            $this->lorem = $lorem;
            return $this;
        } else {
            return $this->lorem;
        }
    }

    private function db($db = null)
    {
        if ($db) {
            $this->db = $db;
            return $this;
        } else {
            return $this->db;
        }
    }

    public function __invoke(EmptyRequest $request): SuccessResponse
    {
        $firstName = ucfirst($this->lorem()->wordsR(1));
        $lastName = ucfirst($this->lorem()->wordsR(1));
        $name = $firstName . ' ' . $lastName;
        $addressId = (new AddressModel)
            ->setUuid(Common::getUuid())
            ->setName($name)
            ->setStreet($this->lorem()->wordsR(1) . ' ' . rand(0, 99) . ((rand(0, 10) > 5) ? ('/' . rand(1, 99)) : ''))
            ->setPostcode(rand(10, 99) . '-' . rand(100, 999))
            ->setCity(ucfirst($this->lorem()->wordsR(1)))
            ->setFirstName($firstName)
            ->setLastName($lastName)
            ->insert();
        $contactId = (new ContractorContactModel)
            ->setUuid(Common::getUuid())
            ->setPhone(rand(100, 999) . '-' . rand(100, 999) . '-' . rand(100, 999))
            ->setFax(rand(10, 99) . '-' . rand(100, 999) . '-' . rand(10, 99) . '-' . rand(10, 99))
            ->setMail($this->lorem()->wordsR(1) . '@' . $this->lorem()->wordsR(1) . '.pl')
            ->setWww($this->lorem()->wordsR(1) . '.pl')
            ->insert();
        (new ContractorModel)
            ->setUuid(Common::getUuid())
            ->setName($name)
            ->setCode('C' . rand(100, 999))
            ->setAddressId($addressId)
            ->setContactId($contactId)
            ->setSupplier((rand(0, 10) > 7) ? true : false)
            ->insert();

        return new SuccessResponse;
    }
}