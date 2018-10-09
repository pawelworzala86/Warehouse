<?php

namespace App\Module\Channel\Model;

use App\Model;
use App\Type\SKU;
use App\Type\UUID;

class ChannelModel extends Model
{
    private $name;
    private $uuid;
    private $id;
    public $host;
    public $key;

    public function getKey(): string
    {
        return $this->key;
    }

    public function setKey(string $key): ChannelModel
    {
        $this->set('key', $key);
        $this->key = $key;
        return $this;
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function setHost(string $host): ChannelModel
    {
        $this->set('host', $host);
        $this->host = $host;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): ChannelModel
    {
        $this->set('id', $id);
        $this->id = $id;
        return $this;
    }

    public function getUuid(): ?UUID
    {
        return $this->uuid;
    }

    public function setUuid(UUID $uuid = null): ChannelModel
    {
        $this->set('uuid', hex2bin($uuid));
        $this->uuid = $uuid;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): ChannelModel
    {
        $this->set('name', $name);
        $this->name = $name;
        return $this;
    }
}