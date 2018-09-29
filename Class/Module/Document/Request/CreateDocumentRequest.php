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