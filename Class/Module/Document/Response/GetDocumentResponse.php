<?php

namespace App\Module\Document\Response;

use App\Response\Response;
use App\Traits\FiltersTrait;
use App\Type\CatalogProduct;
use App\Type\CatalogProducts;
use App\Traits\PaginationResponseTrait;
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