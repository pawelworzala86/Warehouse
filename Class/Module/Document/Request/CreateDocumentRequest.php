<?php

namespace App\Module\Document\Request;

use App\Request\UserRequest;
use App\Type\DocumentProducts;
use App\Type\SKU;
use App\Type\UUID;

class CreateDocumentRequest extends UserRequest
{
    private $name;
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

    public function setBankNumber(string $bankNumber): CreateDocumentRequest
    {
        $this->bankNumber = $bankNumber;
        return $this;
    }

    public function getSwift(): string
    {
        return $this->swift;
    }

    public function setSwift(string $swift): CreateDocumentRequest
    {
        $this->swift = $swift;
        return $this;
    }

    public function getBankName(): string
    {
        return $this->bankName;
    }

    public function setBankName(string $bankName): CreateDocumentRequest
    {
        $this->bankName = $bankName;
        return $this;
    }

    public function getPayment(): string
    {
        return $this->payment;
    }

    public function setPayment(string $payment): CreateDocumentRequest
    {
        $this->payment = $payment;
        return $this;
    }

    public function getPayDate(): string
    {
        return $this->payDate;
    }

    public function setPayDate(string $payDate): CreateDocumentRequest
    {
        $this->payDate = $payDate;
        return $this;
    }

    public function getSumGross(): ?float
    {
        return $this->sumGross;
    }

    public function setSumGross(float $sumGross = null): CreateDocumentRequest
    {
        $this->sumGross = $sumGross;
        return $this;
    }

    public function getSumNet(): ?float
    {
        return $this->sumNet;
    }

    public function setSumNet(float $sumNet = null): CreateDocumentRequest
    {
        $this->sumNet = $sumNet;
        return $this;
    }

    public function getTax(): ?float
    {
        return $this->tax;
    }

    public function setTax(float $tax = null): CreateDocumentRequest
    {
        $this->tax = $tax;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description = null): CreateDocumentRequest
    {
        $this->description = $description;
        return $this;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): CreateDocumentRequest
    {
        $this->date = $date;
        return $this;
    }

    public function getProducts(): DocumentProducts
    {
        return $this->products;
    }

    public function setProducts(DocumentProducts $products): CreateDocumentRequest
    {
        $this->products = $products;
        return $this;
    }

    public function getContractorId(): UUID
    {
        return $this->contractorId;
    }

    public function setContractorId(UUID $contractorId): CreateDocumentRequest
    {
        $this->contractorId = $contractorId;
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