<?php

namespace App\Module\Document\Response;

use App\Response\Response;
use App\Traits\FiltersTrait;
use App\Type\CatalogProduct;
use App\Type\CatalogProducts;
use App\Traits\PaginationResponseTrait;
use App\Type\Contractor;
use App\Type\Document;
use App\Type\DocumentProducts;
use App\Type\Documents;
use App\Type\UUID;

class GetDocumentResponse extends Response
{
    private $name;
    private $id;
    private $contractorId;
    private $products;
    private $date;
    private $description;
    private $contractor;
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

    public function getKind(): string
    {
        return $this->kind;
    }

    public function setKind(string $kind): GetDocumentResponse
    {
        $this->kind = $kind;
        return $this;
    }

    public function getToPay(): ?float
    {
        return $this->toPay;
    }

    public function setToPay(float $toPay = null): GetDocumentResponse
    {
        $this->toPay = $toPay;
        return $this;
    }

    public function getPayed(): ?float
    {
        return $this->payed;
    }

    public function setPayed(float $payed = null): GetDocumentResponse
    {
        $this->payed = $payed;
        return $this;
    }

    public function getDeliveryDate(): ?string
    {
        return $this->deliveryDate;
    }

    public function setDeliveryDate(string $deliveryDate = null): GetDocumentResponse
    {
        $this->deliveryDate = $deliveryDate;
        return $this;
    }

    public function getIssuePlace(): ?string
    {
        return $this->issuePlace;
    }

    public function setIssuePlace(string $issuePlace = null): GetDocumentResponse
    {
        $this->issuePlace = $issuePlace;
        return $this;
    }

    public function getBankNumber(): ?string
    {
        return $this->bankNumber;
    }

    public function setBankNumber(string $bankNumber = null): GetDocumentResponse
    {
        $this->bankNumber = $bankNumber;
        return $this;
    }

    public function getSwift(): ?string
    {
        return $this->swift;
    }

    public function setSwift(string $swift = null): GetDocumentResponse
    {
        $this->swift = $swift;
        return $this;
    }

    public function getBankName(): ?string
    {
        return $this->bankName;
    }

    public function setBankName(string $bankName = null): GetDocumentResponse
    {
        $this->bankName = $bankName;
        return $this;
    }

    public function getPayment(): string
    {
        return $this->payment;
    }

    public function setPayment(string $payment): GetDocumentResponse
    {
        $this->payment = $payment;
        return $this;
    }

    public function getPayDate(): string
    {
        return $this->payDate;
    }

    public function setPayDate(string $payDate): GetDocumentResponse
    {
        $this->payDate = $payDate;
        return $this;
    }

    public function getGross(): ?float
    {
        return $this->gross;
    }

    public function setGross(float $gross = null): GetDocumentResponse
    {
        $this->gross = $gross;
        return $this;
    }

    public function getTax(): ?float
    {
        return $this->tax;
    }

    public function setTax(float $tax = null): GetDocumentResponse
    {
        $this->tax = $tax;
        return $this;
    }

    public function getNet(): ?float
    {
        return $this->net;
    }

    public function setNet(float $net = null): GetDocumentResponse
    {
        $this->net = $net;
        return $this;
    }

    public function getContractor(): ?Contractor
    {
        return $this->contractor;
    }

    public function setContractor(Contractor $contractor = null): GetDocumentResponse
    {
        $this->contractor = $contractor;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description = null): GetDocumentResponse
    {
        $this->description = $description;
        return $this;
    }

    function setDate(string $date = null): GetDocumentResponse
    {
        $this->date = $date;
        return $this;
    }

    function getDate(): ?string
    {
        return $this->date;
    }

    public function getProducts(): DocumentProducts
    {
        return $this->products;
    }

    public function setProducts(DocumentProducts $products): GetDocumentResponse
    {
        $this->products = $products;
        return $this;
    }

    public function getContractorId(): UUID
    {
        return $this->contractorId;
    }

    public function setContractorId(UUID $contractorId): GetDocumentResponse
    {
        $this->contractorId = $contractorId;
        return $this;
    }

    function setId(UUID $id): GetDocumentResponse
    {
        $this->id = $id;
        return $this;
    }

    function getId(): UUID
    {
        return $this->id;
    }

    function setName(string $name): GetDocumentResponse
    {
        $this->name = $name;
        return $this;
    }

    function getName(): string
    {
        return $this->name;
    }
}