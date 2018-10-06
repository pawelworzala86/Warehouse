<?php

namespace App\Module\Order\Model;

use App\Model;
use App\Type\SKU;
use App\Type\UUID;

class OrderProductModel extends Model
{
    private $id;
    private $uuid;
    private $orderId;
    private $productId;
    private $count;
    private $net;
    private $sumNet;
    private $sumGross;
    private $vat;
    private $name;
    private $sku;

    public function getSku(): ?SKU
    {
        return $this->sku;
    }

    public function setSku(SKU $sku = null): OrderProductModel
    {
        $this->set('sku', $sku);
        $this->sku = $sku;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name = null): OrderProductModel
    {
        $this->set('name', $name);
        $this->name = $name;
        return $this;
    }

    public function getVat(): ?string
    {
        return $this->vat;
    }

    public function setVat(string $vat = null): OrderProductModel
    {
        $this->set('vat', $vat);
        $this->vat = $vat;
        return $this;
    }

    public function getSumGross(): ?float
    {
        return $this->sumGross;
    }

    public function setSumGross(float $sumGross = null): OrderProductModel
    {
        $this->set('sum_gross', $sumGross);
        $this->sumGross = $sumGross;
        return $this;
    }

    public function getSumNet(): ?float
    {
        return $this->sumNet;
    }

    public function setSumNet(float $sumNet = null): OrderProductModel
    {
        $this->set('sum_net', $sumNet);
        $this->sumNet = $sumNet;
        return $this;
    }

    public function getNet(): ?float
    {
        return $this->net;
    }

    public function setNet(float $net = null): OrderProductModel
    {
        $this->set('net', $net);
        $this->net = $net;
        return $this;
    }

    public function getCount(): ?float
    {
        return $this->count;
    }

    public function setCount(float $count = null): OrderProductModel
    {
        $this->set('count', $count);
        $this->count = $count;
        return $this;
    }

    public function getProductId(): ?int
    {
        return $this->productId;
    }

    public function setProductId(int $productId = null): OrderProductModel
    {
        $this->set('product_id', $productId);
        $this->productId = $productId;
        return $this;
    }

    public function getOrderId(): ?int
    {
        return $this->orderId;
    }

    public function setOrderId(int $orderId = null): OrderProductModel
    {
        $this->set('order_id', $orderId);
        $this->orderId = $orderId;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id = null): OrderProductModel
    {
        $this->set('id', $id);
        $this->id = $id;
        return $this;
    }

    public function getUuid(): ?UUID
    {
        return $this->uuid;
    }

    public function setUuid(UUID $uuid = null): OrderProductModel
    {
        $this->set('uuid', hex2bin($uuid));
        $this->uuid = $uuid;
        return $this;
    }
}