<?php

namespace App\Module\Stock\Model;

use App\Model;
use App\Type\SKU;
use App\Type\UUID;

class StockViewModel extends Model
{
    private $id;
    private $uuid;
    private $productId;
    private $count;
    private $addedBy;
    private $deleted;
    private $sku;
    private $name;

    function setName(string $name = null): StockViewModel
    {
        $this->set('name', $name);
        $this->name = $name;
        return $this;
    }

    function getName(): ?string
    {
        return $this->name;
    }

    function setSku(SKU $sku = null): StockViewModel
    {
        $this->set('sku', $sku);
        $this->sku = $sku;
        return $this;
    }

    function getSku(): ?SKU
    {
        return $this->sku;
    }

    public function getDeleted(): int
    {
        return $this->deleted;
    }

    public function setDeleted(int $deleted): StockViewModel
    {
        $this->set('deleted', $deleted);
        $this->deleted = $deleted;
        return $this;
    }
    
    public function getAddedBy(): int
    {
        return $this->addedBy;
    }

    public function setAddedBy(int $addedBy): StockViewModel
    {
        $this->set('added_by', $addedBy);
        $this->addedBy = $addedBy;
        return $this;
    }

    public function getCount(): float
    {
        return $this->count;
    }

    public function setCount(float $count): StockViewModel
    {
        $this->set('count', $count);
        $this->count = $count;
        return $this;
    }
    
    public function getProductId(): int
    {
        return $this->productId;
    }

    public function setProductId(int $productId): StockViewModel
    {
        $this->set('product_id', $productId);
        $this->productId = $productId;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): StockViewModel
    {
        $this->set('id', $id);
        $this->id = $id;
        return $this;
    }

    public function getUuid(): UUID
    {
        return $this->uuid;
    }

    public function setUuid(UUID $uuid): StockViewModel
    {
        $this->set('uuid', hex2bin($uuid));
        $this->uuid = $uuid;
        return $this;
    }
}