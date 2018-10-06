<?php

namespace App\Module\Order\Request;

use App\Request\UserRequest;
use App\Traits\FiltersTrait;
use App\Traits\PaginationTrait;
use App\Type\DocumentProducts;
use App\Type\UUID;

class CreateOrderRequest extends UserRequest
{
    private $name;
    private $contractorId;
    private $products;
    private $documentNumberId;
    private $date;

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