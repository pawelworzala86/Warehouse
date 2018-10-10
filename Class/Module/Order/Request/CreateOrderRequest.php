<?php

namespace App\Module\Order\Request;

use App\Request\UserRequest;
use App\Container\DocumentProducts;
use App\Type\UUID;

class CreateOrderRequest extends UserRequest
{
    private $name;
    private $contractorId;
    private $products;
    private $documentNumberId;
    private $date;
    private $sumNet;
    private $sumGross;
    private $sumVat;

    public function getSumVat(): ?float
    {
        return $this->sumVat;
    }

    public function setSumVat(float $sumVat = null): CreateOrderRequest
    {
        $this->sumVat = $sumVat;
        return $this;
    }

    public function getSumGross(): ?float
    {
        return $this->sumGross;
    }

    public function setSumGross(float $sumGross = null): CreateOrderRequest
    {
        $this->sumGross = $sumGross;
        return $this;
    }

    public function getSumNet(): ?float
    {
        return $this->sumNet;
    }

    public function setSumNet(float $sumNet = null): CreateOrderRequest
    {
        $this->sumNet = $sumNet;
        return $this;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): CreateOrderRequest
    {
        $this->date = $date;
        return $this;
    }

    function setDocumentNumberId(UUID $documentNumberId = null): CreateOrderRequest
    {
        $this->documentNumberId = $documentNumberId;
        return $this;
    }

    function getDocumentNumberId(): ?UUID
    {
        return $this->documentNumberId;
    }

    public function getProducts(): DocumentProducts
    {
        return $this->products;
    }

    public function setProducts(DocumentProducts $products): CreateOrderRequest
    {
        $this->products = $products;
        return $this;
    }

    public function getContractorId(): UUID
    {
        return $this->contractorId;
    }

    public function setContractorId(UUID $contractorId): CreateOrderRequest
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