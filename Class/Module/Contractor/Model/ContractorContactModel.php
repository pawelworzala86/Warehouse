<?php

namespace App\Module\Contractor\Model;

use App\Model;
use App\Type\UUID;

class ContractorContactModel extends Model
{
    private $id;
    private $uuid;
    private $phone;
    private $fax;
    private $mail;
    private $www;
    private $contractorId;

    public function getContractorId(): ?int
    {
        return $this->contractorId;
    }

    public function setContractorId (int $contractorId = null): ContractorContactModel
    {
        $this->set('contractor_id', $contractorId);
        $this->contractorId = $contractorId;
        return $this;
    }

    public function getWww(): ?string
    {
        return $this->www;
    }

    public function setWww(string $www = null): ContractorContactModel
    {
        $this->set('www', $www);
        $this->www = $www;
        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail = null): ContractorContactModel
    {
        $this->set('mail', $mail);
        $this->mail = $mail;
        return $this;
    }

    public function getFax(): ?string
    {
        return $this->fax;
    }

    public function setFax(string $fax = null): ContractorContactModel
    {
        $this->set('fax', $fax);
        $this->fax = $fax;
        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone = null): ContractorContactModel
    {
        $this->set('phone', $phone);
        $this->phone = $phone;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): ContractorContactModel
    {
        $this->set('id', $id);
        $this->id = $id;
        return $this;
    }

    public function getUuid(): ?UUID
    {
        return $this->uuid;
    }

    public function setUuid(UUID $uuid = null): ContractorContactModel
    {
        $this->set('uuid', hex2bin($uuid));
        $this->uuid = $uuid;
        return $this;
    }
}