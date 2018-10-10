<?php

namespace App\Module\Integration\Model;

use App\Model;
use App\Type\SKU;
use App\Type\UUID;

class OrderIntegrationModel extends Model
{
    private $id;
    private $uuid;
    private $channelId;
    private $orderId;
    private $prestaId;

    public function getPrestaId(): string
    {
        return $this->prestaId;
    }

    public function setPrestaId(string $prestaId): OrderIntegrationModel
    {
        $this->set('presta_id', $prestaId);
        $this->prestaId = $prestaId;
        return $this;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function setSku(string $sku): OrderIntegrationModel
    {
        $this->set('sku', $sku);
        $this->sku = $sku;
        return $this;
    }

    public function getChannelId(): ?int
    {
        return $this->channelId;
    }

    public function setChannelId(int $channelId): OrderIntegrationModel
    {
        $this->set('channel_id', $channelId);
        $this->channelId = $channelId;
        return $this;
    }

    public function getOrderId(): ?int
    {
        return $this->orderId;
    }

    public function setOrderId(int $orderId): OrderIntegrationModel
    {
        $this->set('order_id', $orderId);
        $this->orderId = $orderId;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): OrderIntegrationModel
    {
        $this->set('id', $id);
        $this->id = $id;
        return $this;
    }

    public function getUuid(): UUID
    {
        return $this->uuid;
    }

    public function setUuid(UUID $uuid): OrderIntegrationModel
    {
        $this->set('uuid', hex2bin($uuid));
        $this->uuid = $uuid;
        return $this;
    }
}