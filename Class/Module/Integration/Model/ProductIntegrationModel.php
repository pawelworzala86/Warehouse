<?php

namespace App\Module\Integration\Model;

use App\Model;
use App\Type\SKU;
use App\Type\UUID;

class ProductIntegrationModel extends Model
{
    private $id;
    private $uuid;
    private $channelId;
    private $productId;
    private $sku;

    public function getSku(): string
    {
        return $this->sku;
    }

    public function setSku(string $sku): ProductIntegrationModel
    {
        $this->set('sku', $sku);
        $this->sku = $sku;
        return $this;
    }

    public function getProductId(): ?int
    {
        return $this->productId;
    }

    public function setProductId(int $productId): ProductIntegrationModel
    {
        $this->set('product_id', $productId);
        $this->productId = $productId;
        return $this;
    }

    public function getChannelId(): ?int
    {
        return $this->channelId;
    }

    public function setChannelId(int $channelId): ProductIntegrationModel
    {
        $this->set('channel_id', $channelId);
        $this->channelId = $channelId;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): ProductIntegrationModel
    {
        $this->set('id', $id);
        $this->id = $id;
        return $this;
    }

    public function getUuid(): UUID
    {
        return $this->uuid;
    }

    public function setUuid(UUID $uuid): ProductIntegrationModel
    {
        $this->set('uuid', hex2bin($uuid));
        $this->uuid = $uuid;
        return $this;
    }
}