<?php

namespace App\Module\Order\Response;

use App\Response\Response;
use App\Container\DocumentProducts;
use App\Type\UUID;

class GetOrderResponse extends Response
{
    private $id;
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

    public function setSumVat(float $sumVat = null): GetOrderResponse
    {
        $this->sumVat = $sumVat;
        return $this;
    }

    public function getSumGross(): ?float
    {
        return $this->sumGross;
    }

    public function setSumGross(float $sumGross = null): GetOrderResponse
    {
        $this->sumGross = $sumGross;
        return $this;
    }

    public function getSumNet(): ?float
    {
        return $this->sumNet;
    }

    public function setSumNet(float $sumNet = null): GetOrderResponse
    {
        $this->sumNet = $sumNet;
        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date = null): GetOrderResponse
    {
        $this->date = $date;
        return $this;
    }

    function setDocumentNumberId(UUID $documentNumberId = null): GetOrderResponse
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

    public function setProducts(DocumentProducts $products): GetOrderResponse
    {
        $this->products = $products;
        return $this;
    }

    public function getContractorId(): UUID
    {
        return $this->contractorId;
    }

    public function setContractorId(UUID $contractorId): GetOrderResponse
    {
        $this->contractorId = $contractorId;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name = null): GetOrderResponse
    {
        $this->name = $name;
        return $this;
    }

    public function getId(): ?UUID
    {
        return $this->id;
    }

    public function setId(UUID $id = null): GetOrderResponse
    {
        $this->id = $id;
        return $this;
    }
}