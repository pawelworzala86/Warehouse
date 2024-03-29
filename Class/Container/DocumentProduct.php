<?php

namespace App\Container;

use App\Container;
use App\Type\SKU;
use App\Type\UUID;

class DocumentProduct extends Container
{
    private $id;
    private $name;
    private $sku;
    private $count;
    private $deleted;
    private $net;
    private $vat;
    private $sumNet;
    private $sumGross;
    private $issuePlace;
    private $productId;
    private $imageUrl;

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(string $imageUrl = null): DocumentProduct
    {
        $this->imageUrl = $imageUrl;
        return $this;
    }

    public function getProductId(): ?UUID
    {
        return $this->productId;
    }

    public function setProductId(UUID $productId = null): DocumentProduct
    {
        $this->productId = $productId;
        return $this;
    }

    public function getIssuePlace(): ?string
    {
        return $this->issuePlace;
    }

    public function setIssuePlace(string $issuePlace = null): DocumentProduct
    {
        $this->issuePlace = $issuePlace;
        return $this;
    }

    public function getSumGross(): ?float
    {
        return $this->sumGross;
    }

    public function setSumGross(float $sumGross = null): DocumentProduct
    {
        $this->sumGross = $sumGross;
        return $this;
    }

    public function getSumNet(): ?float
    {
        return $this->sumNet;
    }

    public function setSumNet(float $sumNet = null): DocumentProduct
    {
        $this->sumNet = $sumNet;
        return $this;
    }

    public function getVat(): ?float
    {
        return $this->vat;
    }

    public function setVat(float $vat = null): DocumentProduct
    {
        $this->vat = $vat;
        return $this;
    }

    public function getNet(): ?float
    {
        return $this->net;
    }

    public function setNet(float $net = null): DocumentProduct
    {
        $this->net = $net;
        return $this;
    }

    function setDeleted(bool $deleted = false): DocumentProduct
    {
        $this->deleted = $deleted;
        return $this;
    }

    function getDeleted(): ?bool
    {
        return $this->deleted;
    }

    function setCount(float $count = null): DocumentProduct
    {
        $this->count = $count;
        return $this;
    }

    function getCount(): ?float
    {
        return $this->count;
    }

    function setSku(SKU $sku = null): DocumentProduct
    {
        $this->sku = $sku;
        return $this;
    }

    function getSku(): ?SKU
    {
        return $this->sku;
    }

    function setId(UUID $id = null): DocumentProduct
    {
        $this->id = $id;
        return $this;
    }

    function getId(): ?UUID
    {
        return $this->id;
    }

    function setName(string $name = null): DocumentProduct
    {
        $this->name = $name;
        return $this;
    }

    function getName(): ?string
    {
        return $this->name;
    }
}