<?php

namespace App\Type;

use App\Type;

class Address extends Type
{
    private $id;
    private $city;
    private $street;
    private $name;
    private $firstName;
    private $lastName;
    private $postcode;

    function setId(UUID $id)
    {
        $this->id = $id;
        return $this;
    }

    function getId(): UUID
    {
        return $this->id;
    }

    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    public function setPostcode(string $postcode = null)
    {
        $this->postcode = $postcode;
        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName = null)
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName = null)
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name = null)
    {
        $this->name = $name;
        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city = null)
    {
        $this->city = $city;
        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street = null)
    {
        $this->street = $street;
        return $this;
    }

}