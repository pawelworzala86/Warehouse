<?php

namespace App\Container;

use App\Container;
use App\Type\UUID;

class OrderResponse extends Container
{
    private $id;
    private $number;
    private $courier;
    private $courierNumber;
    private $courierPrice;
    private $invoiceNumber;
    private $documentId;
    private $pickup;
    private $products;
    private $date;
    private $sumNet;
    private $sumGross;
    private $sumVat;
    private $totalPaid;

    public function getTotalPaid(): ?float
    {
        return $this->totalPaid;
    }

    public function setTotalPaid(float $totalPaid = null): OrderResponse
    {
        $this->totalPaid = $totalPaid;
        return $this;
    }

    public function getSumVat(): ?float
    {
        return $this->sumVat;
    }

    public function setSumVat(float $sumVat = null): OrderResponse
    {
        $this->sumVat = $sumVat;
        return $this;
    }

    public function getSumGross(): ?float
    {
        return $this->sumGross;
    }

    public function setSumGross(float $sumGross = null): OrderResponse
    {
        $this->sumGross = $sumGross;
        return $this;
    }

    public function getSumNet(): ?float
    {
        return $this->sumNet;
    }

    public function setSumNet(float $sumNet = null): OrderResponse
    {
        $this->sumNet = $sumNet;
        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date = null): OrderResponse
    {
        $this->date = $date;
        return $this;
    }

    public function getProducts(): DocumentProducts
    {
        return $this->products;
    }

    public function setProducts(DocumentProducts $products): OrderResponse
    {
        $this->products = $products;
        return $this;
    }

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