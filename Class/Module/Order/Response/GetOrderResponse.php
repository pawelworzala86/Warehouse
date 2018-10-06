<?php

namespace App\Module\Order\Response;

use App\Response\Response;
use App\Traits\FiltersTrait;
use App\Traits\PaginationResponseTrait;
use App\Type\DocumentProducts;
use App\Type\FileResponse;
use App\Type\FilesResponse;
use App\Type\OrderPrice;
use App\Type\OrderPrices;
use App\Type\OrderResponse;
use App\Type\OrdersResponse;
use App\Type\UUID;

class GetOrderResponse extends Response
{
    private $id;
    private $name;
    private $contractorId;
    private $products;
    private $documentNumberId;
    private $date;

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

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): GetOrderResponse
    {
        $this->name = $name;
        return $this;
    }

    public function getId(): UUID
    {
        return $this->id;
    }

    public function setId(UUID $id): GetOrderResponse
    {
        $this->id = $id;
        return $this;
    }
}