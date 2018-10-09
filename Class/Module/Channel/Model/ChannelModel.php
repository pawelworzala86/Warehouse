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