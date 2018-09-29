<?php

namespace App\Module\Document\Model;

use App\Model;
use App\Type\UUID;

class DocumentProductModel extends Model
{
    private $id;
    private $uuid;
    private $documentId;
    private $productId;
    private $count;

    public function getCount(): float
    {
        return $this->count;
    }

    public function setCount(float $count): DocumentProductModel
    {
        $this->set('count', $count);
        $this->count = $count;
        return $this;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function setProductId(int $productId): DocumentProductModel
    {
        $this->set('product_id', $productId);
        $this->productId = $productId;
        return $this;
    }
    
    public function getDocumentId(): int
    {
        return $this->documentId;
    }

    public function setDocumentId(int $documentId): DocumentProductModel
    {
        $this->set('document_id', $documentId);
        $this->documentId = $documentId;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): DocumentProductModel
    {
        $this->set('id', $id);
        $this->id = $id;
        return $this;
    }

    public function getUuid(): UUID
    {
        return $this->uuid;
    }

    public function setUuid(UUID $uuid): DocumentProductModel
    {
        $this->set('uuid', hex2bin($uuid));
        $this->uuid = $uuid;
        return $this;
    }
}