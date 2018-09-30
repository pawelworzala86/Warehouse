<?php

namespace App\Module\User\Model;

use App\Model;
use App\Type\Mail;
use App\Type\Password;
use App\Type\UUID;

class UserModel extends Model
{
    private $mail;
    private $password;
    private $uuid;
    private $id;
    private $addressId;
    private $contactId;

    public function getContactId(): ?int
    {
        return $this->contactId;
    }

    public function setContactId(int $contactId = null)
    {
        $this->set('contact_id', $contactId);
        $this->contactId = $contactId;
        return $this;
    }

    public function getAddressId(): ?int
    {
        return $this->addressId;
    }

    public function setAddressId(int $addressId = null)
    {
        $this->set('address_id', $addressId);
        $this->addressId = $addressId;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): UserModel
    {
        $this->set('id', $id);
        $this->id = $id;
        return $this;
    }

    public function getUuid(): UUID
    {
        return $this->uuid;
    }

    public function setUuid(UUID $uuid): UserModel
    {
        $this->set('uuid', $uuid);
        $this->uuid = $uuid;
        return $this;
    }

    public function getMail(): Mail
    {
        return $this->mail;
    }

    public function setMail(Mail $mail): UserModel
    {
        $this->set('mail', $mail);
        $this->mail = $mail;
        return $this;
    }

    public function getPassword(): Password
    {
        return $this->password;
    }

    public function setPassword(Password $password): UserModel
    {
        $this->set('password', $password);
        $this->password = $password;
        return $this;
    }


}