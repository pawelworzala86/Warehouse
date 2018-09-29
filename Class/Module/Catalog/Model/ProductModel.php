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
    private $partial;
    private $toSell;
    private $sellNet;
    private $sellGross;
    private $vat;

    public function getVat(): ?float
    {
        return $this->vat;
    }

    public function setVat(float $vat = null): ProductModel
    {
        $this->set('vat', $vat);
        $this->vat = $vat;
        return $this;
    }

    public function getSellGross(): ?float
    {
        return $this->sellGross;
    }

    public function setSellGross(float $sellGross = null): ProductModel
    {
        $this->set('sell_gross', $sellGross);
        $this->sellGross = $sellGross;
        return $this;
    }

    public function getSellNet(): ?float
    {
        return $this->sellNet;
    }

    public function setSellNet(float $sellNet = null): ProductModel
    {
        $this->set('sell_net', $sellNet);
        $this->sellNet = $sellNet;
        return $this;
    }

    public function getToSell(): ?bool
    {
        return $this->toSell;
    }

    public function setToSell(bool $toSell = null): ProductModel
    {
        $this->set('to_sell', $toSell);
        $this->toSell = $toSell;
        return $this;
    }

    public function getPartial(): ?bool
    {
        return $this->partial;
    }

    public function setPartial(bool $partial = null): ProductModel
    {
        $this->set('partial', $partial);
        $this->partial = $partial;
        return $this;
    }

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