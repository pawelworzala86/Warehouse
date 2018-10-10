<?php

namespace App\Module\Order\Response;

use App\Response\Response;

class OrderAddResponse extends Response
{
    private $id;
    private $courier;
    private $courierNumber;
    private $courierPrice;

    public function getCourierPrice(): ?float
    {
        return $this->courierPrice;
    }

    public function setCourierPrice(float $courierPrice = null)
    {;
        $this->courierPrice = $courierPrice;
        return $this;
    }

    public function getCourierNumber(): ?string
    {
        return $this->courierNumber;
    }

    public function setCourierNumber(string $courierNumber = null)
    {
        $this->courierNumber = $courierNumber;
        return $this;
    }

    public function getCourier(): ?string
    {
        return $this->courier;
    }

    public function setCourier(string $courier = null)
    {
        $this->courier = $courier;
        return $this;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id)
    {
        $this->id = $id;
        return $this;
    }
}