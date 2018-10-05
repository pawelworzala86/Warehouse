<?php

namespace App\Module\Order\Model;

use App\Model;
use App\Type\UUID;

class OrderModel extends Model
{
    private $id;
    private $uuid;
    private $number;
    private $courier;
    private $courierNumber;
    private $courierPrice;

    public function getCourierPrice(): ?float
    {
        return $this->courierPrice;
    }

    public function setCourierPrice(float $courierPrice = null): OrderModel
    {
        $this->set('courier_price', $courierPrice);
        $this->courierPrice = $courierPrice;
        return $this;
    }

    public function getCourierNumber(): ?string
    {
        return $this->courierNumber;
    }

    public function setCourierNumber(string $courierNumber = null): OrderModel
    {
        $this->set('courier_number', $courierNumber);
        $this->courierNumber = $courierNumber;
        return $this;
    }

    public function getCourier(): ?string
    {
        return $this->courier;
    }

    public function setCourier(string $courier = null): OrderModel
    {
        $this->set('courier', $courier);
        $this->courier = $courier;
        return $this;
    }

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