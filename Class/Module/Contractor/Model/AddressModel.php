<?php

namespace App\Module\Contractor\Model;

use App\Model;
use App\Type\UUID;

class AddressModel extends Model
{
    private $id;
    private $uuid;
    private $city;
    private $street;
    private $name;
    private $firstName;
    private $lastName;
    private $postcode;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): AddressModel
    {
        $this->set('id', $id);
        $this->id = $id;
        return $this;
    }

    public function getUuid(): ?UUID
    {
        return $this->uuid;
    }

    public function setUuid(UUID $uuid = null): AddressModel
    {
        $this->set('uuid', hex2bin($uuid));
        $this->uuid = $uuid;
        return $this;
    }

    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    public function setPostcode(string $postcode = null): AddressModel
    {
        $this->set('postcode', $postcode);
        $this->postcode = $postcode;
        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName = null): AddressModel
    {
        $this->set('last_name', $lastName);
        $this->lastName = $lastName;
        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName = null): AddressModel
    {
        $this->set('first_name', $firstName);
        $this->firstName = $firstName;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name = null): AddressModel
    {
        $this->set('name', $name);
        $this->name = $name;
        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city = null): AddressModel
    {
        $this->set('city', $city);
        $this->city = $city;
        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street = null): AddressModel
    {
        $this->set('street', $street);
        $this->street = $street;
        return $this;
    }
}