<?php

namespace App\Module\Catalog\Model;

use App\Model;
use App\Type\SKU;
use App\Type\UUID;

class ProductModel extends Model
{
    private $name;
    private $uuid;
    private $id;
    private $descriptionShort;
    private $descriptionFull;
    private $sku;

    public function getSku(): SKU
    {
        return $this->sku;
    }

    public function setSku(SKU $sku): ProductModel
    {
        $this->set('sku', $sku);
        $this->sku = $sku;
        return $this;
    }

    public function getDescriptionFull(): ?string
    {
        return $this->descriptionFull;
    }

    public function setDescriptionFull(string $descriptionFull = null): ProductModel
    {
        $this->set('description_full', $descriptionFull);
        $this->descriptionFull = $descriptionFull;
        return $this;
    }

    public function getDescriptionShort(): ?string
    {
        return $this->descriptionShort;
    }

    public function setDescriptionShort(string $descriptionShort = null): ProductModel
    {
        $this->set('description_short', $descriptionShort);
        $this->descriptionShort = $descriptionShort;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): ProductModel
    {
        $this->set('id', $id);
        $this->id = $id;
        return $this;
    }

    public function getUuid(): UUID
    {
        return $this->uuid;
    }

    public function setUuid(UUID $uuid): ProductModel
    {
        $this->set('uuid', hex2bin($uuid));
        $this->uuid = $uuid;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): ProductModel
    {
        $this->set('name', $name);
        $this->name = $name;
        return $this;
    }
}