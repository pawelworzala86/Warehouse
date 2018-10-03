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
    private $net;
    private $sumNet;
    private $sumGross;
    private $vat;

    public function getVat(): ?float
    {
        return $this->vat;
    }

    public function setVat(float $vat = null): DocumentProductModel
    {
        $this->set('vat', $vat);
        $this->vat = $vat;
        return $this;
    }

    public function getSumGross(): float
    {
        return $this->sumGross;
    }

    public function setSumGross(float $sumGross): DocumentProductModel
    {
        $this->set('sum_gross', $sumGross);
        $this->sumGross = $sumGross;
        return $this;
    }

    public function getSumNet(): float
    {
        return $this->sumNet;
    }

    public function setSumNet(float $sumNet): DocumentProductModel
    {
        $this->set('sum_net', $sumNet);
        $this->sumNet = $sumNet;
        return $this;
    }

    public function getNet(): float
    {
        return $this->net;
    }

    public function setNet(float $net): DocumentProductModel
    {
        $this->set('net', $net);
        $this->net = $net;
        return $this;
    }

    public function getCount(): ?float
    {
        return $this->count;
    }

    public function setCount(float $count = null): DocumentProductModel
    {
        $this->set('count', $count);
        $this->count = $count;
        return $this;
    }

    public function getProductId(): ?int
    {
        return $this->productId;
    }

    public function setProductId(int $productId = null): DocumentProductModel
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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): DocumentProductModel
    {
        $this->set('id', $id);
        $this->id = $id;
        return $this;
    }

    public function getUuid(): ?UUID
    {
        return $this->uuid;
    }

    public function setUuid(UUID $uuid = null): DocumentProductModel
    {
        $this->set('uuid', hex2bin($uuid));
        $this->uuid = $uuid;
        return $this;
    }
}