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
    private $contractorId;
    private $addressId;
    private $documentId;
    private $courierNumberSecond;
    private $pickup;
    private $prestaId;
    private $date;

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date = null): OrderModel
    {
        $this->set('date', $date);
        $this->date = $date;
        return $this;
    }

    public function getPrestaId(): ?string
    {
        return $this->prestaId;
    }

    public function setPrestaId(string $prestaId = null): OrderModel
    {
        $this->set('presta_id', $prestaId);
        $this->prestaId = $prestaId;
        return $this;
    }

    public function getPickup(): ?string
    {
        return $this->pickup;
    }

    public function setPickup(string $pickup = null): OrderModel
    {
        $this->set('pickup', $pickup);
        $this->pickup = $pickup;
        return $this;
    }

    public function getCourierNumberSecond(): ?string
    {
        return $this->courierNumberSecond;
    }

    public function setCourierNumberSecond(string $courierNumberSecond = null): OrderModel
    {
        $this->set('courier_number_second', $courierNumberSecond);
        $this->courierNumberSecond = $courierNumberSecond;
        return $this;
    }

    public function getDocumentId(): ?int
    {
        return $this->documentId;
    }

    public function setDocumentId(int $documentId = null): OrderModel
    {
        $this->set('document_id', $documentId);
        $this->documentId = $documentId;
        return $this;
    }

    public function getAddressId(): ?int
    {
        return $this->addressId;
    }

    public function setAddressId(int $addressId = null): OrderModel
    {
        $this->set('address_id', $addressId);
        $this->addressId = $addressId;
        return $this;
    }

    public function getContractorId(): ?int
    {
        return $this->contractorId;
    }

    public function setContractorId(int $contractorId = null): OrderModel
    {
        $this->set('contractor_id', $contractorId);
        $this->contractorId = $contractorId;
        return $this;
    }

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