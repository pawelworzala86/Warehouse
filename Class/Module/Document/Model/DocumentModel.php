<?php

namespace App\Module\Document\Model;

use App\Model;
use App\Type\UUID;

class DocumentModel extends Model
{
    private $id;
    private $uuid;
    private $name;
    private $contractorId;
    private $date;
    private $description;
    private $net;
    private $tax;
    private $gross;
    private $payDate;
    private $payment;
    private $bankName;
    private $swift;
    private $bankNumber;
    private $issuePlace;
    private $deliveryDate;
    private $payed;
    private $toPay;
    private $kind;
    private $type;
    private $nameFrom;
    private $ownerAddressId;
    private $contractorAddressId;

    public function getContractorAddressId(): ?int
    {
        return $this->contractorAddressId;
    }

    public function setContractorAddressId(int $contractorAddressId = null): DocumentModel
    {
        $this->set('contractor_address_id', $contractorAddressId);
        $this->contractorAddressId = $contractorAddressId;
        return $this;
    }

    public function getOwnerAddressId(): ?int
    {
        return $this->ownerAddressId;
    }

    public function setOwnerAddressId(int $ownerAddressId = null): DocumentModel
    {
        $this->set('owner_address_id', $ownerAddressId);
        $this->ownerAddressId = $ownerAddressId;
        return $this;
    }

    public function getNameFrom(): ?string
    {
        return $this->nameFrom;
    }

    public function setNameFrom(string $nameFrom = null): DocumentModel
    {
        $this->set('name_from', $nameFrom);
        $this->nameFrom = $nameFrom;
        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): DocumentModel
    {
        $this->set('type', $type);
        $this->type = $type;
        return $this;
    }

    public function getKind(): string
    {
        return $this->kind;
    }

    public function setKind(string $kind): DocumentModel
    {
        $this->set('kind', $kind);
        $this->kind = $kind;
        return $this;
    }

    public function getToPay(): ?float
    {
        return $this->toPay;
    }

    public function setToPay(float $toPay = null): DocumentModel
    {
        $this->set('to_pay', $toPay);
        $this->toPay = $toPay;
        return $this;
    }

    public function getPayed(): ?float
    {
        return $this->payed;
    }

    public function setPayed(float $payed = null): DocumentModel
    {
        $this->set('payed', $payed);
        $this->payed = $payed;
        return $this;
    }

    public function getDeliveryDate(): ?string
    {
        return $this->deliveryDate;
    }

    public function setDeliveryDate(string $deliveryDate = null): DocumentModel
    {
        $this->set('delivery_date', $deliveryDate);
        $this->deliveryDate = $deliveryDate;
        return $this;
    }

    public function getIssuePlace(): ?string
    {
        return $this->issuePlace;
    }

    public function setIssuePlace(string $issuePlace = null): DocumentModel
    {
        $this->set('issue_place', $issuePlace);
        $this->issuePlace = $issuePlace;
        return $this;
    }

    public function getBankNumber(): ?string
    {
        return $this->bankNumber;
    }

    public function setBankNumber(string $bankNumber = null): DocumentModel
    {
        $this->set('bank_number', $bankNumber);
        $this->bankNumber = $bankNumber;
        return $this;
    }

    public function getSwift(): ?string
    {
        return $this->swift;
    }

    public function setSwift(string $swift = null): DocumentModel
    {
        $this->set('swift', $swift);
        $this->swift = $swift;
        return $this;
    }

    public function getBankName(): ?string
    {
        return $this->bankName;
    }

    public function setBankName(string $bankName = null): DocumentModel
    {
        $this->set('bank_name', $bankName);
        $this->bankName = $bankName;
        return $this;
    }

    public function getPayment(): ?string
    {
        return $this->payment;
    }

    public function setPayment(string $payment = null): DocumentModel
    {
        $this->set('payment', $payment);
        $this->payment = $payment;
        return $this;
    }

    public function getPayDate(): ?string
    {
        return $this->payDate;
    }

    public function setPayDate(string $payDate = null): DocumentModel
    {
        $this->set('pay_date', $payDate);
        $this->payDate = $payDate;
        return $this;
    }

    public function getGross(): ?float
    {
        return $this->gross;
    }

    public function setGross(float $gross = null): DocumentModel
    {
        $this->set('gross', $gross);
        $this->gross = $gross;
        return $this;
    }

    public function getTax(): ?float
    {
        return $this->tax;
    }

    public function setTax(float $tax = null): DocumentModel
    {
        $this->set('tax', $tax);
        $this->tax = $tax;
        return $this;
    }

    public function getNet(): ?float
    {
        return $this->net;
    }

    public function setNet(float $net = null): DocumentModel
    {
        $this->set('net', $net);
        $this->net = $net;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description = null): DocumentModel
    {
        $this->set('description', $description);
        $this->description = $description;
        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date = null): DocumentModel
    {
        $this->set('date', $date);
        $this->date = $date;
        return $this;
    }

    public function getContractorId(): ?int
    {
        return $this->contractorId;
    }

    public function setContractorId(int $contractorId = null): DocumentModel
    {
        $this->set('contractor_id', $contractorId);
        $this->contractorId = $contractorId;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): DocumentModel
    {
        $this->set('name', $name);
        $this->name = $name;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): DocumentModel
    {
        $this->set('id', $id);
        $this->id = $id;
        return $this;
    }

    public function getUuid(): ?UUID
    {
        return $this->uuid;
    }

    public function setUuid(UUID $uuid): DocumentModel
    {
        $this->set('uuid', hex2bin($uuid));
        $this->uuid = $uuid;
        return $this;
    }
}