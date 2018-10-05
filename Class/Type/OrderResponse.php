<?php

namespace App\Type;

use App\Common;
use App\DB;
use App\IP;
use App\Type;
use App\User;

class OrderResponse extends Type
{
    private $id;
    private $number;
    private $courier;
    private $courierNumber;
    private $courierPrice;
    private $invoiceNumber;
    private $documentId;
    private $pickup;

    public function getPickup(): ?string
    {
        return $this->pickup;
    }

    public function setPickup(string $pickup = null): OrderResponse
    {
        $this->pickup = $pickup;
        return $this;
    }

    public function getDocumentId(): ?UUID
    {
        return $this->documentId;
    }

    public function setDocumentId(UUID $documentId = null): OrderResponse
    {
        $this->documentId = $documentId;
        return $this;
    }

    public function getInvoiceNumber(): ?string
    {
        return $this->invoiceNumber;
    }

    public function setInvoiceNumber(string $invoiceNumber = null): OrderResponse
    {
        $this->invoiceNumber = $invoiceNumber;
        return $this;
    }

    public function getCourierPrice(): ?float
    {
        return $this->courierPrice;
    }

    public function setCourierPrice(float $courierPrice = null): OrderResponse
    {
        $this->courierPrice = $courierPrice;
        return $this;
    }

    public function getCourierNumber(): ?string
    {
        return $this->courierNumber;
    }

    public function setCourierNumber(string $courierNumber = null): OrderResponse
    {
        $this->courierNumber = $courierNumber;
        return $this;
    }

    public function getCourier(): ?string
    {
        return $this->courier;
    }

    public function setCourier(string $courier = null): OrderResponse
    {
        $this->courier = $courier;
        return $this;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function setNumber(string $number): OrderResponse
    {
        $this->number = $number;
        return $this;
    }

    function setId(UUID $id): OrderResponse
    {
        $this->id = $id;
        return $this;
    }

    function getId(): UUID
    {
        return $this->id;
    }
}