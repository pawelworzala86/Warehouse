<?php

namespace App\Module\Catalog\Request;

use App\Request\UserRequest;
use App\Type\SKU;
use App\Type\UUID;

class UpdateCatalogProductRequest extends UserRequest
{

    public $id;
    public $name;
    public $descriptionShort;
    public $descriptionFull;
    public $sku;
    private $partial;
    private $toSell;
    private $sellNet;
    private $sellGross;
    private $vat;

    public function getVat(): ?float
    {
        return $this->vat;
    }

    public function setVat(float $vat = null)
    {
        $this->vat = $vat;
        return $this;
    }

    public function getSellGross(): ?float
    {
        return $this->sellGross;
    }

    public function setSellGross(float $sellGross = null)
    {
        $this->sellGross = $sellGross;
        return $this;
    }

    public function getSellNet(): ?float
    {
        return $this->sellNet;
    }

    public function setSellNet(float $sellNet = null)
    {
        $this->sellNet = $sellNet;
        return $this;
    }

    public function getToSell(): ?bool
    {
        return $this->toSell;
    }

    public function setToSell(bool $toSell = null)
    {
        $this->toSell = $toSell;
        return $this;
    }

    public function getPartial(): ?bool
    {
        return $this->partial;
    }

    public function setPartial(bool $partial = null)
    {
        $this->partial = $partial;
        return $this;
    }

    public function getId(): UUID
    {
        return $this->id;
    }

    public function setId(UUID $id)
    {
        $this->id = $id;
        return $this;
    }

    public function getSku(): SKU
    {
        return $this->sku;
    }

    public function setSku(SKU $sku)
    {
        $this->sku = $sku;
        return $this;
    }

    public function getDescriptionFull(): ?string
    {
        return $this->descriptionFull;
    }

    public function setDescriptionFull(string $descriptionFull = null)
    {
        $this->descriptionFull = $descriptionFull;
        return $this;
    }

    public function getDescriptionShort(): ?string
    {
        return $this->descriptionShort;
    }

    public function setDescriptionShort(string $descriptionShort = null)
    {
        $this->descriptionShort = $descriptionShort;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }
}