<?php

namespace App\Module\Document\Request;

use App\Request\UserRequest;
use App\Type\DocumentProducts;
use App\Type\SKU;
use App\Type\UUID;

class UpdateDocumentRequest extends UserRequest
{
    public $name;
    public $id;
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

    public function getBankNumber(): string
    {
        return $this->bankNumber;
    }

    public function setBankNumber(string $bankNumber): UpdateDocumentRequest
    {
        $this->bankNumber = $bankNumber;
        return $this;
    }

    public function getSwift(): string
    {
        return $this->swift;
    }

    public function setSwift(string $swift): UpdateDocumentRequest
    {
        $this->swift = $swift;
        return $this;
    }

    public function getBankName(): string
    {
        return $this->bankName;
    }

    public function setBankName(string $bankName): UpdateDocumentRequest
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