<?php

namespace App\Module\Contractor\Model;

use App\Model;
use App\Type\UUID;

class ContractorModel extends Model
{
    private $id;
    private $uuid;
    private $name;
    private $addressId;
    private $contactId;
    private $code;
    private $nip;
    private $supplier;
    private $prestaId;

    public function getPrestaId(): ?string
    {
        return $this->prestaId;
    }

    public function setPrestaId(string $prestaId = null): ContractorModel
    {
        $this->set('presta_id', $prestaId);
        $this->prestaId = $prestaId;
        return $this;
    }

    public function getSupplier(): ?bool
    {
        return $this->supplier;
    }

    public function setSupplier(bool $supplier = false): ContractorModel
    {
        $this->set('supplier', $supplier);
        $this->supplier = $supplier;
        return $this;
    }

    public function getNip(): ?string
    {
        return $this->nip;
    }

    public function setNip(string $nip = null): ContractorModel
    {
        $this->set('nip', $nip);
        $this->nip = $nip;
        return $this;
    }

    public function getContactId(): ?int
    {
        return $this->contactId;
    }

    public function setContactId(int $contactId = null): ContractorModel
    {
        $this->set('contact_id', $contactId);
        $this->contactId = $contactId;
        return $this;
    }

    function setCode(string $code = null): ContractorModel
    {
        $this->set('code', $code);
        $this->code = $code;
        return $this;
    }

    function getCode(): ?string
    {
        return $this->code;
    }

    public function getAddressId(): ?int
    {
        return $this->addressId;
    }

    public function setAddressId(int $addressId = null): ContractorModel
    {
        $this->set('address_id', $addressId);
        $this->addressId = $addressId;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): ContractorModel
    {
        $this->set('name', $name);
        $this->name = $name;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): ContractorModel
    {
        $this->set('id', $id);
        $this->id = $id;
        return $this;
    }

    public function getUuid(): UUID
    {
        return $this->uuid;
    }

    public function setUuid(UUID $uuid): ContractorModel
    {
        $this->set('uuid', hex2bin($uuid));
        $this->uuid = $uuid;
        return $this;
    }
}