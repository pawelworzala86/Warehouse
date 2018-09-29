<?php

namespace App\Module\Document\Model;

use App\Model;
use App\Type\UUID;

class StockModel extends Model
{
    private $id;
    private $uuid;
    private $productId;
    private $deleted;
    private $addedBy;
    private $count;
    private $documentId;
    private $documentProductId;

    public function getDocumentProductId(): int
    {
        return $this->documentProductId;
    }

    public function setDocumentProductId(int $documentProductId): StockModel
    {
        $this->set('document_product_id', $documentProductId);
        $this->documentProductId = $documentProductId;
        return $this;
    }

    public function getDocumentId(): int
    {
        return $this->documentId;
    }

    public function setDocumentId(int $documentId): StockModel
    {
        $this->set('document_id', $documentId);
        $this->documentId = $documentId;
        return $this;
    }

    public function getCount(): float
    {
        return $this->count;
    }

    public function setCount(float $count): StockModel
    {
        $this->set('count', $count);
        $this->count = $count;
        return $this;
    }

    public function getAddedBy(): int
    {
        return $this->addedBy;
    }

    public function setAddedBy(int $addedBy): StockModel
    {
        $this->set('added_by', $addedBy);
        $this->addedBy = $addedBy;
        return $this;
    }

    public function getDeleted(): int
    {
        return $this->deleted;
    }

    public function setDeleted(int $deleted): StockModel
    {
        $this->set('deleted', $deleted);
        $this->deleted = $deleted;
        return $this;
    }
    
    public function getProductId(): int
    {
        return $this->productId;
    }

    public function setProductId(int $productId): StockModel
    {
        $this->set('product_id', $productId);
        $this->productId = $productId;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): StockModel
    {
        $this->set('id', $id);
        $this->id = $id;
        return $this;
    }

    public function getUuid(): UUID
    {
        return $this->uuid;
    }

    public function setUuid(UUID $uuid): StockModel
    {
        $this->set('uuid', hex2bin($uuid));
        $this->uuid = $uuid;
        return $this;
    }
}