<?php

namespace App\Type;

use App\Type;

class DocumentProduct extends Type
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

    public function getIssuePlace(): ?string
    {
        return $this->issuePlace;
    }

    public function setIssuePlace(string $issuePlace = null): DocumentProduct
    {
        $this->issuePlace = $issuePlace;
        return $this;
    }

    public function getSumGross(): float
    {
        return $this->sumGross;
    }

    public function setSumGross(float $sumGross): DocumentProduct
    {
        $this->sumGross = $sumGross;
        return $this;
    }

    public function getSumNet(): float
    {
        return $this->sumNet;
    }

    public function setSumNet(float $sumNet): DocumentProduct
    {
        $this->sumNet = $sumNet;
        return $this;
    }

    public function getVat(): float
    {
        return $this->vat;
    }

    public function setVat(float $vat): DocumentProduct
    {
        $this->vat = $vat;
        return $this;
    }

    public function getNet(): float
    {
        return $this->net;
    }

    public function setNet(float $net): DocumentProduct
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

    function setCount(float $count): DocumentProduct
    {
        $this->count = $count;
        return $this;
    }

    function getCount(): float
    {
        return $this->count;
    }

    function setSku(SKU $sku): DocumentProduct
    {
        $this->sku = $sku;
        return $this;
    }

    function getSku(): SKU
    {
        return $this->sku;
    }

    function setId(UUID $id): DocumentProduct
    {
        $this->id = $id;
        return $this;
    }

    function getId(): UUID
    {
        return $this->id;
    }

    function setName(string $name): DocumentProduct
    {
        $this->name = $name;
        return $this;
    }

    function getName(): string
    {
        return $this->name;
    }
}