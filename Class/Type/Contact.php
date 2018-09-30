<?php

namespace App\Type;

use App\Type;

class Contact extends Type
{
    private $id;
    private $phone;
    private $fax;
    private $mail;
    private $www;

    public function getWww(): ?string
    {
        return $this->www;
    }

    public function setWww(string $www = null): Contact
    {
        $this->www = $www;
        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail = null): Contact
    {
        $this->mail = $mail;
        return $this;
    }

    public function getFax(): ?string
    {
        return $this->fax;
    }

    public function setFax(string $fax = null): Contact
    {
        $this->fax = $fax;
        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone = null): Contact
    {
        $this->phone = $phone;
        return $this;
    }

    function setId(string $id = null): Contact
    {
        $this->id = $id;
        return $this;
    }

    function getId(): ?string
    {
        return $this->id;
    }
}