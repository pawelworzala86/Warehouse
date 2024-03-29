<?php

namespace App\Module\Catalog\Response;

use App\Response\Response;
use App\Type\UUID;

class GetCatalogProductResponse extends Response
{
    private $id;
    private $name;
    private $sku;
    public $descriptionShort;
    public $descriptionFull;
    private $partial;
    private $toSell;
    private $sellNet;
    private $sellGross;
    private $vat;
    private $imageSrc;

    public function getImageSrc(): ?string
    {
        return $this->imageSrc;
    }

    public function setImageSrc(string $imageSrc = null): GetCatalogProductResponse
    {
        $this->imageSrc = $imageSrc;
        return $this;
    }

    public function getVat(): ?float
    {
        return $this->vat;
    }

    public function setVat(float $vat = null): GetCatalogProductResponse
    {
        $this->vat = $vat;
        return $this;
    }

    public function getSellGross(): ?float
    {
        return $this->sellGross;
    }

    public function setSellGross(float $sellGross = null): GetCatalogProductResponse
    {
        $this->sellGross = $sellGross;
        return $this;
    }

    public function getSellNet(): ?float
    {
        return $this->sellNet;
    }

    public function setSellNet(float $sellNet = null): GetCatalogProductResponse
    {
        $this->sellNet = $sellNet;
        return $this;
    }

    public function getToSell(): ?bool
    {
        return $this->toSell;
    }

    public function setToSell(bool $toSell = null): GetCatalogProductResponse
    {
        $this->toSell = $toSell;
        return $this;
    }

    public function getPartial(): ?bool
    {
        return $this->partial;
    }

    public function setPartial(bool $partial = null): GetCatalogProductResponse
    {
        $this->partial = $partial;
        return $this;
    }

    public function getDescriptionFull(): ?string
    {
        return $this->descriptionFull;
    }

    public function setDescriptionFull(string $descriptionFull = null): GetCatalogProductResponse
    {
        $this->descriptionFull = $descriptionFull;
        return $this;
    }

    public function getDescriptionShort(): ?string
    {
        return $this->descriptionShort;
    }

    public function setDescriptionShort(string $descriptionShort = null): GetCatalogProductResponse
    {
        $this->descriptionShort = $descriptionShort;
        return $this;
    }

    function setSku(string $sku): GetCatalogProductResponse
    {
        $this->sku = $sku;
        return $this;
    }

    function getSku(): string
    {
        return $this->sku;
    }

    function setId(UUID $id): GetCatalogProductResponse
    {
        $this->id = $id;
        return $this;
    }

    function getId(): UUID
    {
        return $this->id;
    }

    function setName(string $name): GetCatalogProductResponse
    {
        $this->name = $name;
        return $this;
    }

    function getName(): string
    {
        return $this->name;
    }
}