<?php

namespace App\Module\Order\Request;

use App\Request\UserRequest;
use App\Container\DocumentProducts;
use App\Type\UUID;

class UpdateOrderRequest extends UserRequest
{
    private $name;
    private $contractorId;
    private $products;
    private $documentNumberId;
    private $date;
    private $id;
    private $orderId;
    private $sumNet;
    private $sumGross;
    private $sumVat;

    public function getSumVat(): ?float
    {
        return $this->sumVat;
    }

    public function setSumVat(float $sumVat = null): UpdateOrderRequest
    {
        $this->sumVat = $sumVat;
        return $this;
    }

    public function getSumGross(): ?float
    {
        return $this->sumGross;
    }

    public function setSumGross(float $sumGross = null): UpdateOrderRequest
    {
        $this->sumGross = $sumGross;
        return $this;
    }

    public function getSumNet(): ?float
    {
        return $this->sumNet;
    }

    public function setSumNet(float $sumNet = null): UpdateOrderRequest
    {
        $this->sumNet = $sumNet;
        return $this;
    }

    public function getOrderId(): UUID
    {
        return $this->orderId;
    }

    public function setOrderId(UUID $orderId): UpdateOrderRequest
    {
        $this->orderId = $orderId;
        return $this;
    }

    public function getId(): UUID
    {
        return $this->id;
    }

    public function setId(UUID $id): UpdateOrderRequest
    {
        $this->id = $id;
        return $this;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): UpdateOrderRequest
    {
        $this->date = $date;
        return $this;
    }

    function setDocumentNumberId(UUID $documentNumberId = null): UpdateOrderRequest
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

    public function setProducts(DocumentProducts $products): UpdateOrderRequest
    {
        $this->products = $products;
        return $this;
    }

    public function getContractorId(): UUID
    {
        return $this->contractorId;
    }

    public function setContractorId(UUID $contractorId): UpdateOrderRequest
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