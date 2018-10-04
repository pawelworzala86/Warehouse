<?php

namespace App\Module\Order\Model;

use App\Model;
use App\Type\UUID;

class OrderModel extends Model
{
    private $id;
    private $uuid;
    private $number;

    public function getNumber(): string
    {
        return $this->number;
    }

    public function setNumber(string $number): OrderModel
    {
        $this->set('number', $number);
        $this->number = $number;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id = null): OrderModel
    {
        $this->set('id', $id);
        $this->id = $id;
        return $this;
    }

    public function getUuid(): ?UUID
    {
        return $this->uuid;
    }

    public function setUuid(UUID $uuid = null): OrderModel
    {
        $this->set('uuid', hex2bin($uuid));
        $this->uuid = $uuid;
        return $this;
    }
}