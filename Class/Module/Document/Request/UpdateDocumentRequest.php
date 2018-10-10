<?php

namespace App\Module\Document\Request;

use App\Request\UserRequest;
use App\Container\DocumentProducts;
use App\Type\UUID;

class UpdateDocumentRequest extends UserRequest
{
    private $name;
    private $id;
    private $contractorId;
    private $products;
    private $date;
    private $description;
    private $tax;
    private $sumNet;
    private $sumGross;
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
    private $nameFrom;
    private $type;

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): UpdateDocumentRequest
    {
        $this->type = $type;
        return $this;
    }

    public function getNameFrom(): ?string
    {
        return $this->nameFrom;
    }

    public function setNameFrom(string $nameFrom = null): UpdateDocumentRequest
    {
        $this->nameFrom = $nameFrom;
        return $this;
    }

    public function getKind(): string
    {
        return $this->kind;
    }

    public function setKind(string $kind): UpdateDocumentRequest
    {
        $this->kind = $kind;
        return $this;
    }

    public function getToPay(): ?float
    {
        return $this->toPay;
    }

    public function setToPay(float $toPay = null): UpdateDocumentRequest
    {
        $this->toPay = $toPay;
        return $this;
    }

    public function getPayed(): ?float
    {
        return $this->payed;
    }

    public function setPayed(float $payed = null): UpdateDocumentRequest
    {
        $this->payed = $payed;
        return $this;
    }

    public function getDeliveryDate(): ?string
    {
        return $this->deliveryDate;
    }

    public function setDeliveryDate(string $deliveryDate = null): UpdateDocumentRequest
    {
        $this->deliveryDate = $deliveryDate;
        return $this;
    }

    public function getIssuePlace(): ?string
    {
        return $this->issuePlace;
    }

    public function setIssuePlace(string $issuePlace = null): UpdateDocumentRequest
    {
        $this->issuePlace = $issuePlace;
        return $this;
    }

    public function getBankNumber(): ?string
    {
        return $this->bankNumber;
    }

    public function setBankNumber(string $bankNumber = null): UpdateDocumentRequest
    {
        $this->bankNumber = $bankNumber;
        return $this;
    }

    public function getSwift(): ?string
    {
        return $this->swift;
    }

    public function setSwift(string $swift = null): UpdateDocumentRequest
    {
        $this->swift = $swift;
        return $this;
    }

    public function getBankName(): ?string
    {
        return $this->bankName;
    }

    public function setBankName(string $bankName = null): UpdateDocumentRequest
    {
        $this->bankName = $bankName;
        return $this;
    }

    public function getPayment(): string
    {
        return $this->payment;
    }

    public function setPayment(string $payment): UpdateDocumentRequest
    {
        $this->payment = $payment;
        return $this;
    }

    public function getPayDate(): string
    {
        return $this->payDate;
    }

    public function setPayDate(string $payDate): UpdateDocumentRequest
    {
        $this->payDate = $payDate;
        return $this;
    }

    public function getSumGross(): ?float
    {
        return $this->sumGross;
    }

    public function setSumGross(float $sumGross = null): UpdateDocumentRequest
    {
        $this->sumGross = $sumGross;
        return $this;
    }

    public function getSumNet(): ?float
    {
        return $this->sumNet;
    }

    public function setSumNet(float $sumNet = null): UpdateDocumentRequest
    {
        $this->sumNet = $sumNet;
        return $this;
    }

    public function getTax(): ?float
    {
        return $this->tax;
    }

    public function setTax(float $tax = null): UpdateDocumentRequest
    {
        $this->tax = $tax;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description = null): UpdateDocumentRequest
    {
        $this->description = $description;
        return $this;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): UpdateDocumentRequest
    {
        $this->date = $date;
        return $this;
    }

    public function getProducts(): DocumentProducts
    {
        return $this->products;
    }

    public function setProducts(DocumentProducts $products): UpdateDocumentRequest
    {
        $this->products = $products;
        return $this;
    }

    public function getContractorId(): string
    {
        return $this->contractorId;
    }

    public function setContractorId(string $contractorId): UpdateDocumentRequest
    {
        $this->contractorId = $contractorId;
        return $this;
    }

    public function getId(): UUID
    {
        return $this->id;
    }

    public function setId(UUID $id)
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }
}