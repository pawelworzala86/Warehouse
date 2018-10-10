<?php

namespace App\Module\Integration\Model;

use App\Model;
use App\Type\UUID;

class ContractorIntegrationModel extends Model
{
    private $id;
    private $uuid;
    private $channelId;
    private $contractorId;
    private $prestaId;

    public function getPrestaId(): string
    {
        return $this->prestaId;
    }

    public function setPrestaId(string $prestaId): ContractorIntegrationModel
    {
        $this->set('presta_id', $prestaId);
        $this->prestaId = $prestaId;
        return $this;
    }

    public function getProductId(): ?int
    {
        return $this->productId;
    }

    public function setContractorId(int $contractorId = null): ContractorIntegrationModel
    {
        $this->set('contractor_id', $contractorId);
        $this->contractorId = $contractorId;
        return $this;
    }

    public function getContractorId(): ?int
    {
        return $this->contractorId;
    }

    public function setChannelId(int $channelId): ContractorIntegrationModel
    {
        $this->set('channel_id', $channelId);
        $this->channelId = $channelId;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): ContractorIntegrationModel
    {
        $this->set('id', $id);
        $this->id = $id;
        return $this;
    }

    public function getUuid(): UUID
    {
        return $this->uuid;
    }

    public function setUuid(UUID $uuid): ContractorIntegrationModel
    {
        $this->set('uuid', hex2bin($uuid));
        $this->uuid = $uuid;
        return $this;
    }
}