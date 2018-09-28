<?php

namespace App\Module\Catalog\Request;

use App\Request\UserRequest;
use App\Type\SKU;

class CreateCatalogProductRequest extends UserRequest
{

    public $name;
    public $descriptionShort;
    public $descriptionFull;
    public $sku;

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